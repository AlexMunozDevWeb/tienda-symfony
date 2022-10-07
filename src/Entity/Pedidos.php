<?php

namespace App\Entity;

use App\Repository\PedidosRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PedidosRepository::class)
 */
class Pedidos
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $fecha;

    /**
     * @ORM\Column(type="boolean")
     */
    private $enviado;

    /**
     * @ORM\ManyToOne(targetEntity=Usuarios::class, inversedBy="pedidos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idUsuario;

    /**
     * @ORM\OneToMany(targetEntity=ProductosPedidos::class, mappedBy="codPedido", orphanRemoval=true)
     */
    private $idProPedidos;

    public function __construct()
    {
        $this->idProPedidos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->fecha;
    }

    public function setFecha(\DateTimeInterface $fecha): self
    {
        $this->fecha = $fecha;

        return $this;
    }

    public function isEnviado(): ?bool
    {
        return $this->enviado;
    }

    public function setEnviado(bool $enviado): self
    {
        $this->enviado = $enviado;

        return $this;
    }

    public function getIdUsuario(): ?Usuarios
    {
        return $this->idUsuario;
    }

    public function setIdUsuario(?Usuarios $idUsuario): self
    {
        $this->idUsuario = $idUsuario;

        return $this;
    }

    /**
     * @return Collection<int, ProductosPedidos>
     */
    public function getIdProPedidos(): Collection
    {
        return $this->idProPedidos;
    }

    public function addIdProPedido(ProductosPedidos $idProPedido): self
    {
        if (!$this->idProPedidos->contains($idProPedido)) {
            $this->idProPedidos[] = $idProPedido;
            $idProPedido->setCodPedido($this);
        }

        return $this;
    }

    public function removeIdProPedido(ProductosPedidos $idProPedido): self
    {
        if ($this->idProPedidos->removeElement($idProPedido)) {
            // set the owning side to null (unless already changed)
            if ($idProPedido->getCodPedido() === $this) {
                $idProPedido->setCodPedido(null);
            }
        }

        return $this;
    }
}
