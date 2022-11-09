<?php

namespace App\Entity;

use App\Repository\CancionesRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CancionesRepository::class)]
class Canciones
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 30)]
    private ?string $nombre = null;

    #[ORM\Column]
    private ?int $duracion = null;

    #[ORM\Column(length: 30)]
    private ?string $artista = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $fechaPublicacion = null;

    #[ORM\Column]
    private ?int $album = null;

    #[ORM\Column(length: 255)]
    private ?string $urlCancion = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getDuracion(): ?int
    {
        return $this->duracion;
    }

    public function setDuracion(int $duracion): self
    {
        $this->duracion = $duracion;

        return $this;
    }

    public function getArtista(): ?string
    {
        return $this->artista;
    }

    public function setArtista(string $artista): self
    {
        $this->artista = $artista;

        return $this;
    }

    public function getFechaPublicacion(): ?\DateTimeInterface
    {
        return $this->fechaPublicacion;
    }

    public function setFechaPublicacion(\DateTimeInterface $fechaPublicacion): self
    {
        $this->fechaPublicacion = $fechaPublicacion;

        return $this;
    }

    public function getAlbum(): ?int
    {
        return $this->album;
    }

    public function setAlbum(int $album): self
    {
        $this->album = $album;

        return $this;
    }

    public function getUrlCancion(): ?string
    {
        return $this->urlCancion;
    }

    public function setUrlCancion(string $urlCancion): self
    {
        $this->urlCancion = $urlCancion;

        return $this;
    }
}
