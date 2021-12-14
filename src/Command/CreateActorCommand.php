<?php

namespace App\Command;

use App\Entity\Actor;

use Symfony\Component\Console\Attribute\AsCommand;

use Symfony\Component\Console\Command\Command;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;

use Symfony\Component\Console\Output\OutputInterface;

use Symfony\Component\Console\Style\SymfonyStyle;

use Doctrine\ORM\EntityManagerInterface;

#[AsCommand(
    name: 'app:create-actor',
    description: 'Este comando nos permite crear actores',
)]
class CreateActorCommand extends Command
{
    private $entityManager;

    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct();
        $this->entityManager = $em;
    }

    protected function configure(): void
    {
        $this
            ->addArgument('nombre', InputArgument::REQUIRED, 'Nombre')
            ->addArgument('fecha_nacimiento', InputArgument::OPTIONAL, 'Fecha de nacimiento')
            ->addArgument('nacionalidad', InputArgument::OPTIONAL, 'Nacionalidad')
            ->addArgument('biografia', InputArgument::OPTIONAL, 'Biografía')
            ->addArgument('imagen', InputArgument::OPTIONAL, 'Imagen')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $output->writeln('<fg=white;bg=black>Creando actor</>');
        $nombre = $input->getArgument('nombre');
        $fecha_nacimiento = $input->getArgument('fecha_nacimiento');
        $nacionalidad = $input->getArgument('nacionalidad');
        $biografia = $input->getArgument('biografia');
        $imagen = $input->getArgument('imagen');

        $actor = new Actor();
        $actor->setNombre($nombre);
        $actor->setFechaNacimiento($fecha_nacimiento);
        $actor->setNacionalidad($nacionalidad);
        $actor->setBiografia($biografia);
        $actor->setImagen($imagen);

        $this->entityManager->persist($actor);
        $this->entityManager->flush();

        $output->writeln("<fg=white;bg=green>Actor/actriz $nombre creado/a correctamente</>");

        return Command::SUCCESS;
    }
}
