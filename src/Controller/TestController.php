<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class TestController extends AbstractController
{
    #[Route('/test', name: 'test')]
    public function index(): Response
    {
        // $this->addFlash('success', 'Así se flashea info a la sesión');
        // $session->getFlashBag()->add('success', 'Así también');

        // $session->set('nombre', 'Kevin');

        // dd($session);
        // // dd($request);

        // return new Response('Test');
        // if($id == 1){
        //     throw new HttpException(500, 'Lanzando una excepción (500)');
        // }
        // if($id == 2){
        //     throw new NotFoundHttpException('No se ha encontrado (404)');
        // }
        // if($id == 3){
        //     throw $this->createNotFoundException('Not found (404)');
        // }

        // return new Response('No se lanzó ninguna excepción');
        $ruta = $this->generateUrl('pelicula_show', ['id'=>3]);

        return new Response("Ejemplo de ruta generada: $ruta");
        //return $this->redirect('/peliculas');
        //return $this->redirectToRoute('pelicula_show', ['id' => 1]);
    }
}
