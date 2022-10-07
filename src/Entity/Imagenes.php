<?php

namespace App\Entity;

use App\Repository\ImagenesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ImagenesRepository::class)
 */
class Imagenes
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=500)
     */
    private $url;

    /**
     * @ORM\ManyToOne(targetEntity=Productos::class, inversedBy="imagenes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idProducto;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getIdProducto(): ?Productos
    {
        return $this->idProducto;
    }

    public function setIdProducto(?Productos $idProducto): self
    {
        $this->idProducto = $idProducto;

        return $this;
    }
}
