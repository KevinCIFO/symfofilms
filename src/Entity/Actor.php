<?php

namespace App\Entity;

use App\Repository\ActorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ActorRepository::class)
 */
class Actor
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=128, nullable=true)
     */
    private $nombre;

    /**
     * @ORM\Column(type="string", length=128, nullable=true)
     */
    private $fechaNacimiento;

    /**
     * @ORM\Column(type="string", length=128, nullable=true)
     */
    private $nacionalidad;

    /**
     * @ORM\Column(type="string", length=4096)
     */
    private $biografia;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $imagen;

    /**
     * @ORM\ManyToMany(targetEntity=Pelicula::class, mappedBy="actores")
     */
    private $peliculas;

    public function __construct()
    {
        $this->peliculas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(?string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getFechaNacimiento(): ?string
    {
        return $this->fechaNacimiento;
    }

    public function setFechaNacimiento(?string $fechaNacimiento): self
    {
        $this->fechaNacimiento = $fechaNacimiento;

        return $this;
    }

    public function getNacionalidad(): ?string
    {
        return $this->nacionalidad;
    }

    public function setNacionalidad(?string $nacionalidad): self
    {
        $this->nacionalidad = $nacionalidad;

        return $this;
    }

    public function getBiografia(): ?string
    {
        return $this->biografia;
    }

    public function setBiografia(string $biografia): self
    {
        $this->biografia = $biografia;

        return $this;
    }

    public function getImagen(): ?string
    {
        return $this->imagen;
    }

    public function setImagen(?string $imagen): self
    {
        $this->imagen = $imagen;

        return $this;
    }

    public function __toString() {
        return "ID: $this->id - $this->nombre ($this->nacionalidad),
        nacido el ".$this->fechaNacimiento;
    }

    /**
     * @return Collection|Pelicula[]
     */
    public function getPeliculas(): Collection
    {
        return $this->peliculas;
    }

    public function addPelicula(Pelicula $pelicula): self
    {
        if (!$this->peliculas->contains($pelicula)) {
            $this->peliculas[] = $pelicula;
            $pelicula->addActore($this);
        }

        return $this;
    }

    public function removePelicula(Pelicula $pelicula): self
    {
        if ($this->peliculas->removeElement($pelicula)) {
            $pelicula->removeActore($this);
        }

        return $this;
    }
}
