<?php

namespace App\Entity;

use App\Repository\AlbumRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AlbumRepository::class)]
class Album
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $nombre = null;

    #[ORM\Column]
    private ?int $cantidadCanciones = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $fechaEdicion = null;

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

    public function getCantidadCanciones(): ?int
    {
        return $this->cantidadCanciones;
    }

    public function setCantidadCanciones(int $cantidadCanciones): self
    {
        $this->cantidadCanciones = $cantidadCanciones;

        return $this;
    }

    public function getFechaEdicion(): ?\DateTimeInterface
    {
        return $this->fechaEdicion;
    }

    public function setFechaEdicion(?\DateTimeInterface $fechaEdicion): self
    {
        $this->fechaEdicion = $fechaEdicion;

        return $this;
    }
}
