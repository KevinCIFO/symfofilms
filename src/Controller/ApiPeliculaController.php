<?php

namespace App\Controller;

use App\Entity\Pelicula;

use App\Repository\PeliculaRepository;

use App\Service\SimpleSearchService;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;

use Symfony\Component\Serializer\Exception\NotEncodableValueException;

use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

use Symfony\Component\Serializer\Serializer;

use Symfony\Component\Validator\Validator\ValidatorInterface;

#[Route('/api', name: 'api_pelicula')]
class ApiPeliculaController extends AbstractController {
    private $peliculaRepository;
    private $serializer;

    private $cabeceras = [
        "json" => "application/json",
        "xml" => "text/xml"
    ];

    public function __construct(PeliculaRepository $repositorio) {
        $this->peliculaRepository = $repositorio;

        $this->serializer = new Serializer(
            [new ObjectNormalizer()],
            [new JsonEncoder(), new XmlEncoder()]
        );
    }

    public function sendResponse(
        string $contenido = '',
        string $formato = 'json',
        int $codigo = Response::HTTP_OK
    ) {
        $response = new Response($contenido, $codigo);
        $response->headers->set('Content-type', $this->cabeceras[strtolower($formato)]);
        return $response;
    }

    #[Route('/peliculas/{formato}', name: 'api_pelicula_list', requirements: ['formato' => 'json|xml'], defaults: ['formato' => 'json'], methods: ['GET'])]
    public function peliculas(string $formato):Response {
        $peliculas = $this->peliculaRepository->findAll();

        $contenido = $this->serializer->serialize([
                "status" => "OK",
                "data" => $peliculas
            ], $formato,
            //Sin actores
            //[ObjectNormalizer::IGNORED_ATTRIBUTES =>['user', 'actores']]
            //Con actores
            [ObjectNormalizer::IGNORED_ATTRIBUTES =>['user', 'peliculas', 'fechaNacimiento']]
        );

        return $this->sendResponse($contenido, $formato);
    }

    #[Route('/pelicula/{id<\d+>}/{formato}', name: 'api_pelicula_show', requirements: ['formato' => 'json|xml'], defaults: ['formato' => 'json'], methods: ['GET'])]
    public function pelicula(int $id, string $formato):Response {
        $pelicula = $this->peliculaRepository->find($id);

        $contenido = $this->serializer->serialize(
                $pelicula ? ["status" => "OK", "data" => $pelicula] : ["status" => "ERROR", "message" => "No se ha encontrado la película con id $id."],
            $formato,
            [ObjectNormalizer::IGNORED_ATTRIBUTES =>['user', 'peliculas', 'fechaNacimiento']]
        );

        return $this->sendResponse($contenido, $formato, $pelicula ? Response::HTTP_OK : Response::HTTP_NOT_FOUND);
    }

    #[Route('/pelicula/search/{campo}/{valor}/{formato}', name: 'api_pelicula_search', requirements: ['formato' => 'json|xml'], defaults: ['campo' => 'titulo', 'valor' => '%', 'formato' => 'json'], methods: ['GET'])]
    public function search(string $campo, string $valor, string $formato, SimpleSearchService $searchService):Response {
        $searchService->campo = $campo;
        $searchService->valor = $valor;
        $peliculas = $searchService->search('\App\Entity\Pelicula');

        $contenido = $this->serializer->serialize([
                "status" => "OK",
                "data" => $peliculas
            ], $formato,
            [ObjectNormalizer::IGNORED_ATTRIBUTES =>['user', 'peliculas', 'fechaNacimiento']]
        );

        return $this->sendResponse($contenido, $formato);
    }

    #[Route('/pelicula/{formato}', name: 'api_pelicula_create', requirements: ['formato' => 'json|xml'], defaults: ['formato' => 'json'], methods: ['POST'])]
    public function create(string $formato, Request $request, ValidatorInterface $validator):Response {
        try {
            $pelicula = $this->serializer->deserialize(
                $request->getContent(),
                'App\Entity\Pelicula',
                $formato
            );
        } catch(NotEncodableValueException $e) {
            $contenido = $this->serializer->serialize([
                "status" => "ERROR",
                "message" => "Error en el $formato. RECIBIDO: ". $request->getContent()
            ], $formato);

            return $this->sendResponse($contenido, $formato, Response::HTTP_BAD_REQUEST);
        }

        $errors = $validator->validate($pelicula);

        if(count($errors) > 0) {
            $errores = [];

            foreach($errors as $error) {
                $errores[$error->getPropertyPath()] = $error->getMessage();
            }

            $contenido = $this->serializer->serialize([
                    "status" => "ERROR",
                    "message" => "Error de validación",
                    "errors" => $errores
                ], $formato
            );

            return $this->sendResponse($contenido, $formato, Response::HTTP_UNPROCESSABLE_ENTITY);
        } else {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($pelicula);
            $entityManager->flush();

            $contenido = $this->serializer->serialize([
                    "status" => "OK",
                    "message" => "Guardada con id ". $pelicula->getId()
                ], $formato
            );

            return $this->sendResponse($contenido, $formato, Response::HTTP_CREATED);
        }
    }

    #[Route('/pelicula/{id<\d+>}/{formato}', name: 'api_pelicula_edit', requirements: ['formato' => 'json|xml'], defaults: ['formato' => 'json'], methods: ['PUT', 'PATCH'])]
    public function edit(int $id, string $formato, Request $request, ValidatorInterface $validator):Response {
        $pelicula = $this->peliculaRepository->find($id);

        if(!$pelicula) {
            $contenido = $this->serializer->serialize([
                "status" => "ERROR",
                "message" => "No se ha encontrado la película con id $id."
            ], $formato);

            return $this->sendResponse($contenido, $formato, Response::HTTP_NOT_FOUND);
        }
        
        try {
            $pelicula = $this->serializer->deserialize(
                $request->getContent(),
                'App\Entity\Pelicula', $formato,
                ['object_to_populate' => $pelicula]
            );
        } catch(NotEncodableValueException $e) {
            $contenido = $this->serializer->serialize([
                "status" => "ERROR",
                "message" => "Error en el $formato. RECIBIDO: ". $request->getContent()
            ], $formato);

            return $this->sendResponse($contenido, $formato, Response::HTTP_BAD_REQUEST);
        }

        $errors = $validator->validate($pelicula);

        if(count($errors) > 0) {
            $errores = [];

            foreach($errors as $error) {
                $errores[$error->getPropertyPath()] = $error->getMessage();
            }

            $contenido = $this->serializer->serialize([
                    "status" => "ERROR",
                    "message" => "Error de validación",
                    "errors" => $errores
                ], $formato
            );

            return $this->sendResponse($contenido, $formato, Response::HTTP_UNPROCESSABLE_ENTITY);
        } else {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();

            $contenido = $this->serializer->serialize([
                    "status" => "OK",
                    "message" => "Película actualizada correctamente"
                ], $formato
            );

            return $this->sendResponse($contenido, $formato);
        }
    }

    #[Route('/pelicula/{id<\d+>}/{formato}', name: 'api_pelicula_delete', requirements: ['formato' => 'json|xml'], defaults: ['formato' => 'json'], methods: ['DELETE'])]
    public function delete(int $id, string $formato):Response {
        $pelicula = $this->peliculaRepository->find($id);

        if($pelicula) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($pelicula);
            $entityManager->flush();

            $contenido = $this->serializer->serialize([
                "status" => "OK",
                "message" => "Película con id $id eliminada correctamente"
            ], $formato);

            return $this->sendResponse($contenido, $formato);
        }
        
        $contenido = $this->serializer->serialize([
            "status" => "ERROR",
            "message" => "No se ha encontrado la película con id $id."
        ], $formato);

        return $this->sendResponse($contenido, $formato, Response::HTTP_NOT_FOUND);
    }
}
