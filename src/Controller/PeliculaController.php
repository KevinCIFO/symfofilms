<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Pelicula;
use App\Entity\Actor;

use App\Form\PeliculaFormType;
use App\Form\PeliculaDeleteFormType;
use App\Form\PeliculaAddActorFormType;
use App\Form\SearchFormType;

use Symfony\Component\HttpFoundation\File\UploadedFile;

use Psr\Log\LoggerInterface;

use App\Service\FileService;
use App\Service\PaginatorService;
use App\Service\SimpleSearchService;

use Doctrine\ORM\EntityManagerInterface;

class PeliculaController extends AbstractController
{
    #[Route('/peliculas/{pagina}', name: 'peliculas', defaults: ['pagina' => 1])]
    public function index(int $pagina, PaginatorService $paginator): Response
    {
        $paginator->setEntityType('App\Entity\Pelicula');
        $paginator->setLimit($this->getParameter('app.movielist_results'));

        $peliculas = $paginator->findAllEntities($pagina);

        // $formulario = $this->createForm(SearchFormType::class, $busqueda, [
        //     'field_choices' => [
        //         'Título' => 'titulo',
        //         'Director' => 'director',
        //         'Género' => 'genero',
        //         'Sinopsis' => 'sinopsis'
        //     ],
        //     'order_choices' => [
        //         'ID' => 'id',
        //         'Título' => 'titulo',
        //         'Director' => 'director',
        //         'Género' => 'genero'
        //     ]
        // ]);


        // $formulario->get('campo')->setData($busqueda->campo);
        // $formulario->get('orden')->setData($busqueda->orden);

        // $formulario->handleRequest($request);

        // $peliculasSearch = $busqueda->search('App\Entity\Pelicula');
        
        return $this->render('pelicula/list.html.twig', ['peliculas' => $peliculas, 'paginator' => $paginator]);
    }

    #[Route('/pelicula/duration/{min<\d*>}/{max<\d*>}', name: 'pelicula_duration', defaults: ['min' => 0, 'max' => 99999])]
    public function duration(int $min, int $max): Response
    {
        $repositorio = $this->getDoctrine()->getRepository(Pelicula::class);
        $peliculas = $repositorio->findAllByDuration($min, $max);
        
        return $this->renderForm('pelicula/list.html.twig', ['peliculas' => $peliculas]);
    }

    #[Route('/pelicula/create', name: 'pelicula_create')]
    public function create(Request $request, LoggerInterface $appInfoLogger, FileService $uploader): Response
    {
        $pelicula = new Pelicula();

        $this->denyAccessUnlessGranted('create', $pelicula);

        $formulario = $this->createForm(PeliculaFormType::class, $pelicula);

        $formulario->handleRequest($request);

        if($formulario->isSubmitted() && $formulario->isValid()){
            $file = $formulario->get('imagen')->getData();

            if($file){
                // $extension = $file->guessExtension();
                // $directorio = $this->getParameter('app.covers_root');
                // $fichero = uniqid()."$extension";

                // $file->move($directorio, $fichero);
                // $pelicula->setImagen($fichero);
                //$uploader = new FileService($this->getParameter('app.covers.root'));

                $uploader->targetDirectory = $this->getParameter('app.covers_root');
                $pelicula->setImagen($uploader->upload($file));
            }

            $pelicula->setUser($this->getUser());

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($pelicula);
            $entityManager->flush();

            $mensaje = 'Película ' .$pelicula->getTitulo(). ' guardada con id ' .$pelicula->getId();
            $this->addFlash('success', $mensaje);
            $appInfoLogger->info($mensaje);

            return $this->redirectToRoute('pelicula_show', ['id' => $pelicula->getId()]);
        }

        return $this->render('pelicula/create.html.twig', ['formulario' =>$formulario->createView()]);
    }

    #[Route('/pelicula/{id<\d+>}', name: 'pelicula_show')]
    public function show(Pelicula $pelicula): Response
    {
        // $pelicula = $this->getDoctrine()->getRepository(Pelicula::class)->find($id);

        // if(!$pelicula){
        //     throw $this->createNotFoundException("No se encontró la película con ID $id");
        // }

        return $this->render('pelicula/show.html.twig', ['pelicula' => $pelicula]);
    }

    #[Route('/pelicula/search', name: 'pelicula_search', methods: ['GET', 'POST'])]
    public function search(Request $request, SimpleSearchService $busqueda): Response
    {
        $formulario = $this->createForm(SearchFormType::class, $busqueda, [
            'field_choices' => [
                'Título' => 'titulo',
                'Director' => 'director',
                'Género' => 'genero',
                'Sinopsis' => 'sinopsis',
                'Año' => 'estreno'
            ],
            'order_choices' => [
                'ID' => 'id',
                'Título' => 'titulo',
                'Director' => 'director',
                'Género' => 'genero',
                'Año' => 'estreno'
            ]
        ]);


        $formulario->get('campo')->setData($busqueda->campo);
        $formulario->get('orden')->setData($busqueda->orden);

        $formulario->handleRequest($request);

        $peliculas = $busqueda->search('App\Entity\Pelicula');

        return $this->renderForm('pelicula/buscar.html.twig', [
            'formulario' => $formulario,
            'peliculas' => $peliculas
        ]);

    }

    #[Route('/pelicula/update/{id}', name: 'pelicula_update')]
    public function update(Pelicula $pelicula, Request $request, LoggerInterface $appInfoLogger, FileService $uploader): Response
    {
        $this->denyAccessUnlessGranted('edit', $pelicula);
        // $usuarioIdentificado = $this->getUser();

        // if($pelicula->getUser() !== $usuarioIdentificado && !$this->isGranted('ROLE_EDITOR', $usuarioIdentificado)) {
        //     throw $this->createAccessDeniedException();
        // }

        $fichero = $pelicula->getImagen();

        $formulario = $this->createForm(PeliculaFormType::class, $pelicula);
        $formulario->handleRequest($request);

        if($formulario->isSubmitted() && $formulario->isValid()){
            $file = $formulario->get('imagen')->getData();

            if($file){
                // $directorio = $this->getParameter('app.covers_root');

                // if($fichero){
                //     $filesystem = new Filesystem();
                //     $filesystem->remove("$directorio/$fichero");
                // }

                // $extension = $file->guessExtension();
                // $fichero = uniqid().".$extension";

                // $file->move($directorio, $fichero);
                $uploader->targetDirectory = $this->getParameter('app.covers_root');
                $fichero = $uploader->replace($file, $fichero);
            }
            
            $pelicula->setImagen($fichero);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            //$this->addFlash('success', 'Película actualizada correctamente');

            $mensaje = 'Película ' .$pelicula->getTitulo(). ' con id ' .$pelicula->getId(). ' actualizada correctamente';
            $this->addFlash('success', $mensaje);
            $appInfoLogger->info($mensaje);

            return $this->redirectToRoute('pelicula_show', ['id' => $pelicula->getId()]);
        }

        $formularioAddActor = $this->createForm(PeliculaAddActorFormType::class, NULL, [
            'action' => $this->generateUrl('pelicula_add_actor', ['id' => $pelicula->getId()])
        ]);

        return $this->renderForm('pelicula/edit.html.twig', [
            'formulario' => $formulario,
            'formularioAddActor' => $formularioAddActor, 
            'pelicula' => $pelicula
        ]);
    }

    #[Route('/pelicula/addactor/{id<\d+>}', name: 'pelicula_add_actor', methods: ['POST'])]
    public function addActor(Pelicula $pelicula, Request $request, LoggerInterface $appInfoLogger, EntityManagerInterface $em)
    {
        $this->denyAccessUnlessGranted('edit', $pelicula);
        
        $formularioAddActor = $this->createForm(PeliculaAddActorFormType::class);
        $formularioAddActor->handleRequest($request);
        $datos = $formularioAddActor->getData();

        if(empty($datos['actor'])){
            $this->addFlash('addActorError', 'No se indicó un actor válido.');
        }
        else{
            $actor = $datos['actor'];
            $pelicula->addActore($actor);
            $em->flush();
    
            $mensaje = 'Actor ' .$actor->getNombre(). ' añadido a ' .$pelicula->getTitulo(). ' correctamente.';
            $this->addFlash('success', $mensaje);
            $appInfoLogger->info($mensaje);
        }

        return $this->redirectToRoute('pelicula_update', ['id' => $pelicula->getId()]);
    }

    #[Route('/pelicula/removeactor/{pelicula<\d+>}/{actor<\d+>}', name: 'pelicula_remove_actor', methods: ['GET'])]
    public function removeActor(Pelicula $pelicula, Actor $actor, LoggerInterface $appInfoLogger, EntityManagerInterface $em)
    {
        $this->denyAccessUnlessGranted('edit', $pelicula);

        $pelicula->removeActore($actor);
        $em->flush();

        $mensaje = 'Actor ' .$actor->getNombre(). ' eliminado de ' .$pelicula->getTitulo(). ' correctamente.';
        $this->addFlash('success', $mensaje);
        $appInfoLogger->info($mensaje);

        return $this->redirectToRoute('pelicula_update', ['id' => $pelicula->getId()]);
    }

    #[Route('/pelicula/delete/{id}', name: 'pelicula_delete')]
    public function delete(Pelicula $pelicula, Request $request, LoggerInterface $appInfoLogger, FileService $uploader): Response
    {
        $formulario = $this->createForm(PeliculaDeleteFormType::class, $pelicula);
        $formulario->handleRequest($request);

        if($formulario->isSubmitted() && $formulario->isValid()){
            if($pelicula->getImagen()){
                // $filesystem = new Filesystem();
                // $directorio = $this->getParameter('app.covers_root');
                // $filesystem->remove($directorio.'/'.$pelicula->getImagen());
                $uploader->delete($pelicula->getImagen());
            }
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($pelicula);
            $entityManager->flush();

            //$this->addFlash('success', 'Película eliminada correctamente');
            $mensaje = 'Película ' .$pelicula->getTitulo(). ' eliminada correctamente';
            $this->addFlash('success', $mensaje);
            $appInfoLogger->info($mensaje);

            return $this->redirectToRoute('peliculas');
        }

        return $this->render('pelicula/delete.html.twig', [
            'formulario' => $formulario->createView(), 
            'pelicula' => $pelicula
        ]);
    }
}