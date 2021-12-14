<?php

namespace App\Controller;

use App\Entity\User;

use App\Form\RegistrationFormType;
use App\Form\UserDeleteFormType;

use App\Repository\UserRepository;

use App\Security\EmailVerifier;

use Symfony\Bridge\Twig\Mime\TemplatedEmail;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Mime\Address;

use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

use Symfony\Component\Routing\Annotation\Route;

use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;

use App\Service\FileService;

use Psr\Log\LoggerInterface;

class RegistrationController extends AbstractController
{
    private EmailVerifier $emailVerifier;

    public function __construct(EmailVerifier $emailVerifier)
    {
        $this->emailVerifier = $emailVerifier;
    }

    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasherInterface, FileService $uploader, LoggerInterface $appUserInfoLogger): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $userPasswordHasherInterface->hashPassword(
                        $user,
                        $form->get('plainPassword')->getData()
                    )
            );

            $uploader->targetDirectory = $this->getParameter('app.users_pics_root');

            //$file = $request->files->get('registration_form')['imagen'];
            $file = $form->get('imagen')->getData();

            if($file) {
                $user->setImagen($uploader->upload($file));
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            // generate a signed url and email it to the user
            $this->emailVerifier->sendEmailConfirmation('app_verify_email', $user,
                (new TemplatedEmail())
                    ->from(new Address('no-reply@symfofilms.kevinlarriega.com', 'Registro de usuarios'))
                    ->to($user->getEmail())
                    ->subject('Por favor, confirma tu e-mail')
                    ->htmlTemplate('registration/confirmation_email.html.twig')
            );
            // do anything else you need here, like send an email
            $mensaje = 'Usuario '.$user->getDisplayname().' ha sido dado de alta. Falta verificar el e-mail.';
            $this->addFlash('success', $mensaje);
            $appUserInfoLogger->info($mensaje);
            //$this->addFlash('success', 'Operación realizada, revisa tu e-mail y haz clic en el enlace para completar la operación de registro.');

            return $this->redirectToRoute('portada');
        }

        return $this->renderForm('registration/register.html.twig', [
            'registrationForm' => $form]);
    }

    #[Route('/verify/email', name: 'app_verify_email')]
    public function verifyUserEmail(Request $request, UserRepository $userRepository, LoggerInterface $appUserInfoLogger): Response
    {
        $id = $request->get('id');

        if (null === $id) {
            return $this->redirectToRoute('app_register');
        }

        $user = $userRepository->find($id);

        if (null === $user) {
            return $this->redirectToRoute('app_register');
        }

        // validate email confirmation link, sets User::isVerified=true and persists
        try {
            $this->emailVerifier->handleEmailConfirmation($request, $user);
        } catch (VerifyEmailExceptionInterface $exception) {
            $this->addFlash('verify_email_error', $exception->getReason());

            return $this->redirectToRoute('app_register');
        }

        // @TODO Change the redirect on success and handle or remove the flash message in your templates
        //$this->addFlash('success', 'Tu e-mail ha sido verificado.');
        $mensaje = 'Tu e-mail ha sido verificado.';
        $this->addFlash('success', $mensaje);
        $appUserInfoLogger->info($mensaje);

        return $this->redirectToRoute('home');
    }

    #[Route('/resendverificationemail', name: 'resend_verification', methods: ['GET'])]
    public function resendVerificationEmail(Request $request): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $user = $this->getUser();

        $this->emailVerifier->sendEmailConfirmation('app_verify_email', $user,
                (new TemplatedEmail())
                    ->from(new Address('no-reply@symfofilms.kevinlarriega.com', 'Registro de usuarios'))
                    ->to($user->getEmail())
                    ->subject('Por favor, confirma tu e-mail')
                    ->htmlTemplate('registration/confirmation_email.html.twig')
            );

        $mensaje = 'Operación realizada, revisa tu e-mail y haz clic en el enlace para completar la operación de registro. El mensaje de advertencia desaparecerá tras completar el proceso.';
        $this->addFlash('success', $mensaje);
        //$this->addFlash('success', 'Operación realizada, revisa tu e-mail y haz clic en el enlace para completar la operación de registro.');

        return $this->redirectToRoute('portada');

        return $this->renderForm('registration/register.html.twig', [
            'registrationForm' => $form]);
    }

    #[Route('/unsubscribe', name: 'unsubscribe', methods: ['GET', 'POST'])]
    public function unsubscribe(Request $request, LoggerInterface $appUserInfoLogger, FileService $uploader): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $usuario = $this->getUser();

        $formulario = $this->createForm(UserDeleteFormType::class, $usuario);
        $formulario->handleRequest($request);

        if($formulario->isSubmitted() && $formulario->isValid()) {
            foreach($usuario->getPeliculas() as $pelicula) {
                $usuario->removePelicula($pelicula);
            }

            $uploader->targetDirectory = $this->getParameter('app.users_pics_root');

            if($usuario->getImagen()) {
                $uploader->delete($usuario->getImagen());
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($usuario);
            $entityManager->flush();

            $this->container->get('security.token_storage')->setToken(null);
            $this->container->get('session')->invalidate();

            $mensaje = 'Usuario '.$usuario->getDisplayname().' ha sido eliminado correctamente.';
            $this->addFlash('success', $mensaje);

            $mensaje = 'Usuario '.$usuario->getDisplayname().' ha sido dado de baja.';
            $appUserInfoLogger->warning($mensaje);

            return $this->redirectToRoute('portada');
        }

        return $this->renderForm('user/delete.html.twig', [
            'formulario' => $formulario,
            'usuario' => $usuario
        ]);
    }
}
