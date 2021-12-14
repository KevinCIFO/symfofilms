<?php

namespace App\Command;

use App\Entity\Pelicula;

use Symfony\Component\Console\Attribute\AsCommand;

use Symfony\Component\Console\Command\Command;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;

use Symfony\Component\Console\Output\OutputInterface;

use Symfony\Component\Console\Style\SymfonyStyle;

use Doctrine\ORM\EntityManagerInterface;

#[AsCommand(
    name: 'app:create-movie',
    description: 'Este comando nos permite crear películas',
)]
class CreateMovieCommand extends Command
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
            ->addArgument('titulo', InputArgument::REQUIRED, 'Título')
            ->addArgument('duracion', InputArgument::OPTIONAL, 'Duración')
            ->addArgument('director', InputArgument::OPTIONAL, 'Director')
            ->addArgument('genero', InputArgument::OPTIONAL, 'Género')
            ->addArgument('imagen', InputArgument::OPTIONAL, 'Imagen')
            ->addArgument('sinopsis', InputArgument::OPTIONAL, 'Sinopsis')
            ->addArgument('estreno', InputArgument::OPTIONAL, 'Estreno')
            ->addArgument('valoracion', InputArgument::OPTIONAL, 'Valoración')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $output->writeln('<fg=white;bg=black>Creando película</>');
        $titulo = $input->getArgument('titulo');
        $duracion = $input->getArgument('duracion');
        $director = $input->getArgument('director');
        $genero = $input->getArgument('genero');
        $imagen = $input->getArgument('imagen');
        $sinopsis = $input->getArgument('sinopsis');
        $estreno = $input->getArgument('estreno');
        $valoracion = $input->getArgument('valoracion');

        $pelicula = new Pelicula();
        $pelicula->setTitulo($titulo);
        $pelicula->setDuracion($duracion);
        $pelicula->setDirector($director);
        $pelicula->setGenero($genero);
        $pelicula->setImagen($imagen);
        $pelicula->setSinopsis($sinopsis);
        $pelicula->setEstreno($estreno);
        $pelicula->setValoracion($valoracion);

        $this->entityManager->persist($pelicula);
        $this->entityManager->flush();

        $output->writeln("<fg=white;bg=green>Película $titulo creada correctamente</>");

        return Command::SUCCESS;
    }
}
