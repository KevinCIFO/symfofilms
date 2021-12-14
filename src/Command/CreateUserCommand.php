<?php

namespace App\Command;

use App\Entity\User;

use App\Repository\UserRepository;

use Doctrine\ORM\Entity\ManagerInterface;

use Symfony\Component\Console\Attribute\AsCommand;

use Symfony\Component\Console\Command\Command;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;

use Symfony\Component\Console\Output\OutputInterface;

use Symfony\Component\Console\Style\SymfonyStyle;

use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

use Doctrine\ORM\EntityManagerInterface;

#[AsCommand(
    name: 'app:create-user',
    description: 'Este comando nos permite crear usuarios',
)]
class CreateUserCommand extends Command
{
    private $entityManager;
    private $userRepository;
    private $userPasswordHasher;

    public function __construct(EntityManagerInterface $em, UserRepository $userRepository, UserPasswordHasherInterface $passwordHasher)
    {
        parent::__construct();
        $this->entityManager = $em;
        $this->userRepository = $userRepository;
        $this->passwordHasher = $passwordHasher;
    }

    protected function configure(): void
    {
        $this
            ->setHelp('Los parámetros son e-mail y password')
            ->addArgument('email', InputArgument::REQUIRED, 'E-mail')
            ->addArgument('displayname', InputArgument::REQUIRED, 'Nombre para mostrar')
            ->addArgument('password', InputArgument::REQUIRED, 'Contraseña')
            ->addArgument('is_verified', InputArgument::OPTIONAL, 'Verificado')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $output->writeln('<fg=white;bg=black>Creando usuario</>');
        $email = $input->getArgument('email');
        $displayname = $input->getArgument('displayname');
        $password = $input->getArgument('password');
        $is_verified = $input->getArgument('is_verified') ? 1:0;

        if($this->userRepository->findOneBy(['email' => $email])) {
            $output->writeln('<error>El usuario con e-mail '.$email.' ya ha sido registrado anteriormente</error>');
            return Command::FAILURE;
        }

        $user = new User();
        $user->setEmail($email);
        $user->setDisplayname($displayname);
        $hashedPassword = $this->passwordHasher->hashPassword($user, $password);
        $user->setPassword($hashedPassword);
        $user->setIsVerified($is_verified);

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        $output->writeln("<fg=white;bg=green>Usuario $displayname con e-mail $email creado correctamente</>");

        return Command::SUCCESS;
    }
}
