<?php

namespace App\Controller;

use App\Entity\Actor;

use App\Repository\ActorRepository;

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

#[Route('/api', name: 'api_actor')]
class ApiActorController extends AbstractController {
    private $actorRepository;
    private $serializer;

    private $cabeceras = [
        "json" => "application/json",
        "xml" => "text/xml"
    ];

    public function __construct(ActorRepository $repositorio) {
        $this->actorRepository = $repositorio;

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

    #[Route('/actores/{formato}', name: 'api_actor_list', requirements: ['formato' => 'json|xml'], defaults: ['formato' => 'json'], methods: ['GET'])]
    public function actores(string $formato):Response {
        $actores = $this->actorRepository->findAll();

        $contenido = $this->serializer->serialize([
                "status" => "OK",
                "data" => $actores
            ], $formato,
            [ObjectNormalizer::IGNORED_ATTRIBUTES =>['user', 'actores']]
        );

        return $this->sendResponse($contenido, $formato);
    }

    #[Route('/actor/{id<\d+>}/{formato}', name: 'api_actor_show', requirements: ['formato' => 'json|xml'], defaults: ['formato' => 'json'], methods: ['GET'])]
    public function actor(int $id, string $formato):Response {
        $actor = $this->actorRepository->find($id);

        $contenido = $this->serializer->serialize(
                $actor ? ["status" => "OK", "data" => $actor] : ["status" => "ERROR", "message" => "No se ha encontrado al actor con id $id."],
            $formato,
            [ObjectNormalizer::IGNORED_ATTRIBUTES =>['user', 'actores']]
        );

        return $this->sendResponse($contenido, $formato, $actor ? Response::HTTP_OK : Response::HTTP_NOT_FOUND);
    }

    #[Route('/actor/search/{campo}/{valor}/{formato}', name: 'api_actor_search', requirements: ['formato' => 'json|xml'], defaults: ['campo' => 'titulo', 'valor' => '%', 'formato' => 'json'], methods: ['GET'])]
    public function search(string $campo, string $valor, string $formato, SimpleSearchService $searchService):Response {
        $searchService->campo = $campo;
        $searchService->valor = $valor;
        $actores = $searchService->search('\App\Entity\Actor');

        $contenido = $this->serializer->serialize([
                "status" => "OK",
                "data" => $actores
            ], $formato,
            [ObjectNormalizer::IGNORED_ATTRIBUTES =>['user', 'actores']]
        );

        return $this->sendResponse($contenido, $formato);
    }

    #[Route('/actor/{formato}', name: 'api_actor_create', requirements: ['formato' => 'json|xml'], defaults: ['formato' => 'json'], methods: ['POST'])]
    public function create(string $formato, Request $request, ValidatorInterface $validator):Response {
        try {
            $actor = $this->serializer->deserialize(
                $request->getContent(),
                'App\Entity\Actor',
                $formato
            );
        } catch(NotEncodableValueException $e) {
            $contenido = $this->serializer->serialize([
                "status" => "ERROR",
                "message" => "Error en el $formato. RECIBIDO: ". $request->getContent()
            ], $formato);

            return $this->sendResponse($contenido, $formato, Response::HTTP_BAD_REQUEST);
        }

        $errors = $validator->validate($actor);

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
            $entityManager->persist($actor);
            $entityManager->flush();

            $contenido = $this->serializer->serialize([
                    "status" => "OK",
                    "message" => "Guardada con id ". $actor->getId()
                ], $formato
            );

            return $this->sendResponse($contenido, $formato, Response::HTTP_CREATED);
        }
    }

    #[Route('/actor/{id<\d+>}/{formato}', name: 'api_actor_edit', requirements: ['formato' => 'json|xml'], defaults: ['formato' => 'json'], methods: ['PUT', 'PATCH'])]
    public function edit(int $id, string $formato, Request $request, ValidatorInterface $validator):Response {
        $actor = $this->actorRepository->find($id);

        if(!$actor) {
            $contenido = $this->serializer->serialize([
                "status" => "ERROR",
                "message" => "No se ha encontrado al actor con id $id."
            ], $formato);

            return $this->sendResponse($contenido, $formato, Response::HTTP_NOT_FOUND);
        }
        
        try {
            $actor = $this->serializer->deserialize(
                $request->getContent(),
                'App\Entity\Actor', $formato,
                ['object_to_populate' => $actor]
            );
        } catch(NotEncodableValueException $e) {
            $contenido = $this->serializer->serialize([
                "status" => "ERROR",
                "message" => "Error en el $formato. RECIBIDO: ". $request->getContent()
            ], $formato);

            return $this->sendResponse($contenido, $formato, Response::HTTP_BAD_REQUEST);
        }

        $errors = $validator->validate($actor);

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
                    "message" => "Actor actualizado correctamente"
                ], $formato
            );

            return $this->sendResponse($contenido, $formato);
        }
    }

    #[Route('/actor/{id<\d+>}/{formato}', name: 'api_actor_delete', requirements: ['formato' => 'json|xml'], defaults: ['formato' => 'json'], methods: ['DELETE'])]
    public function delete(int $id, string $formato):Response {
        $actor = $this->actorRepository->find($id);

        if($actor) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($actor);
            $entityManager->flush();

            $contenido = $this->serializer->serialize([
                "status" => "OK",
                "message" => "Actor con id $id eliminado correctamente"
            ], $formato);

            return $this->sendResponse($contenido, $formato);
        }
        
        $contenido = $this->serializer->serialize([
            "status" => "ERROR",
            "message" => "No se ha encontrado al actor con id $id."
        ], $formato);

        return $this->sendResponse($contenido, $formato, Response::HTTP_NOT_FOUND);
    }
}
