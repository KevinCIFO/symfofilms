<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Actor;

use App\Form\ActorFormType;
use App\Form\ActorDeleteFormType;
use App\Form\SearchFormType;

use Symfony\Component\HttpFoundation\File\UploadedFile;

use Psr\Log\LoggerInterface;

use App\Service\FileService;
use App\Service\PaginatorService;
use App\Service\SimpleSearchService;

class ActorController extends AbstractController
{
    #[Route('/actores/{pagina}', name: 'actores', defaults: ['pagina' => 1])]
    public function index(int $pagina, PaginatorService $paginator): Response
    {
        $paginator->setEntityType('App\Entity\Actor');
        $paginator->setLimit($this->getParameter('app.actorlist_results'));

        // $repositorio = $this->getDoctrine()->getRepository(Actor::class);
        // $edadActores = $repositorio->findAgeActors();

        $actores = $paginator->findAllEntities($pagina);
        
        return $this->render('actor/list.html.twig', ['actores' => $actores, 'paginator' => $paginator]);
    }

    #[Route('/actor/create', name: 'actor_create')]
    public function create(Request $request, LoggerInterface $appInfoLogger, FileService $uploader): Response
    {
        $actor = new Actor();

        $this->denyAccessUnlessGranted('create', $actor);

        $formulario = $this->createForm(ActorFormType::class, $actor);

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
                $actor->setImagen($uploader->upload($file));
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($actor);
            $entityManager->flush();

            $mensaje = 'Actor ' .$actor->getNombre(). ' guardado con id ' .$actor->getId();
            $this->addFlash('success', $mensaje);
            $appInfoLogger->info($mensaje);

            return $this->redirectToRoute('actor_show', ['id' => $actor->getId()]);
        }

        return $this->render('actor/create.html.twig', ['formulario' =>$formulario->createView()]);
    }

    #[Route('/actor/{id<\d+>}', name: 'actor_show')]
    public function show(Actor $actor): Response
    {
        // $actor = $this->getDoctrine()->getRepository(Actor::class)->find($id);

        // if(!$actor){
        //     throw $this->createNotFoundException("No se encontró al actor con ID $id");
        // }

        return $this->render('actor/show.html.twig', ['actor' => $actor]);
    }

    #[Route('/actor/search', name: 'actor_search', methods: ['GET', 'POST'])]
    public function search(Request $request, SimpleSearchService $busqueda): Response
    {
        $formulario = $this->createForm(SearchFormType::class, $busqueda, [
            'field_choices' => [
                'Nombre y apellidos' => 'nombre',
                'Nacionalidad' => 'nacionalidad',
                'Fecha de nacimiento' => 'fechaNacimiento',
                'Biografía' => 'biografia',
            ],
            'order_choices' => [
                'ID' => 'id',
                'Nombre y apellidos' => 'nombre',
                'Nacionalidad' => 'nacionalidad',
                'Fecha de nacimiento' => 'fechaNacimiento'
            ]
        ]);


        $formulario->get('campo')->setData($busqueda->campo);
        $formulario->get('orden')->setData($busqueda->orden);

        $formulario->handleRequest($request);

        $actores = $busqueda->search('App\Entity\Actor');

        return $this->renderForm('actor/buscar.html.twig', [
            'formulario' => $formulario,
            'actores' => $actores
        ]);

    }

    #[Route('/actor/update/{id}', name: 'actor_update')]
    public function update(Actor $actor, Request $request, LoggerInterface $appInfoLogger, FileService $uploader): Response
    {
        $this->denyAccessUnlessGranted('edit', $actor);

        $fichero = $actor->getImagen();

        $formulario = $this->createForm(ActorFormType::class, $actor);
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
            
            $actor->setImagen($fichero);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            //$this->addFlash('success', 'Película actualizada correctamente');

            $mensaje = 'Actor ' .$actor->getNombre(). ' con id ' .$actor->getId(). ' actualizado correctamente';
            $this->addFlash('success', $mensaje);
            $appInfoLogger->info($mensaje);

            return $this->redirectToRoute('actor_show', ['id' => $actor->getId()]);
        }

        return $this->render('actor/edit.html.twig', [
            'formulario' => $formulario->createView(), 
            'actor' => $actor
        ]);
    }

    #[Route('/actor/delete/{id}', name: 'actor_delete')]
    public function delete(Actor $actor, Request $request, LoggerInterface $appInfoLogger, FileService $uploader): Response
    {
        $formulario = $this->createForm(ActorDeleteFormType::class, $actor);
        $formulario->handleRequest($request);

        if($formulario->isSubmitted() && $formulario->isValid()){
            if($actor->getImagen()){
                // $filesystem = new Filesystem();
                // $directorio = $this->getParameter('app.covers_root');
                // $filesystem->remove($directorio.'/'.$pelicula->getImagen());
                $uploader->delete($actor->getImagen());
            }
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($actor);
            $entityManager->flush();

            //$this->addFlash('success', 'Película eliminada correctamente');
            $mensaje = 'Actor ' .$actor->getNombre(). ' eliminado correctamente';
            $this->addFlash('success', $mensaje);
            $appInfoLogger->info($mensaje);

            return $this->redirectToRoute('actores');
        }

        return $this->render('actor/delete.html.twig', [
            'formulario' => $formulario->createView(), 
            'actor' => $actor
        ]);
    }
}