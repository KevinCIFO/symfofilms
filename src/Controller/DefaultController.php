<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Mailer\MailerInterface;

use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Address;

use Symfony\Bridge\Twig\Mime\TemplatedEmail;

use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Pelicula;

use App\Kernel;

use App\Form\ContactoFormType;

use App\Service\FrasesService;
use App\Service\PaginatorService;

class DefaultController extends AbstractController
{
    #[Route('/{pagina<\d+>}', name: 'portada', defaults: ['pagina' => 1])]
    public function index(int $pagina, PaginatorService $paginator, FrasesService $frases): Response
    {
        $paginator->setEntityType('App\Entity\Pelicula');

        $peliculas = $paginator->findAllEntities($pagina);

        return $this->render('portada.html.twig', ['frases' => $frases->getFraseAleatoria(), 'peliculas' => $peliculas, 'paginator' => $paginator]);
    }

    #[Route('/brochure', name: 'brochure')]
    public function brochure(Kernel $kernel): Response
    {
        $raiz = $kernel->getProjectDir();

        $response = new BinaryFileResponse($raiz. '/pdf/brochure.pdf');
        $response->headers->set('Content-Type', 'application/pdf');
        $response->setContentDisposition(
            ResponseHeaderBag::DISPOSITION_ATTACHMENT, 'pdfdownloaded.pdf' 
        );
        
        return $response;
    }

    #[Route('/contacto', name: 'contacto')]
    public function contacto(Request $request, MailerInterface $mailer): Response
    {
        $formulario = $this->createForm(ContactoFormType::class);
        $formulario->handleRequest($request);

        if($formulario->isSubmitted() && $formulario->isValid()){
            $nombre = $request->request->get('contacto_form')['nombre'];
            $asunto = $request->request->get('contacto_form')['asunto'];
            $mensaje = $request->request->get('contacto_form')['mensaje'];
            $de = $request->request->get('contacto_form')['email'];

            $email = (new TemplatedEmail())
                ->from(new Address($de, $nombre))
                ->to($this->getParameter('app.admin_email'))
                ->subject($asunto)
                ->htmlTemplate('email/contact.html.twig')
                ->context([
                    'de' => $de,
                    'nombre' => $nombre,
                    'asunto' => $asunto,
                    'mensaje' => $mensaje
                ]);
            
            $mailer->send($email);

            $this->addFlash('success', 'Mensaje enviado correctamente');

            return $this->redirectToRoute('portada');
        }

        return $this->render('contacto.html.twig', ['formulario'=>$formulario->createView()]);
    }
}