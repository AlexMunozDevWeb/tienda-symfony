<?php

namespace App\Entity;

use App\Repository\ProductosPedidosRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductosPedidosRepository::class)
 */
class ProductosPedidos
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Productos::class, inversedBy="idProPedidos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $codProducto;

    /**
     * @ORM\ManyToOne(targetEntity=Pedidos::class, inversedBy="idProPedidos")
     * @ORM\JoinColumn(nullable=false)
     */
    private $codPedido;

    /**
     * @ORM\Column(type="integer")
     */
    private $unidades;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodProducto(): ?Productos
    {
        return $this->codProducto;
    }

    public function setCodProducto(?Productos $codProducto): self
    {
        $this->codProducto = $codProducto;

        return $this;
    }

    public function getCodPedido(): ?Pedidos
    {
        return $this->codPedido;
    }

    public function setCodPedido(?Pedidos $codPedido): self
    {
        $this->codPedido = $codPedido;

        return $this;
    }

    public function getUnidades(): ?int
    {
        return $this->unidades;
    }

    public function setUnidades(int $unidades): self
    {
        $this->unidades = $unidades;

        return $this;
    }
}
