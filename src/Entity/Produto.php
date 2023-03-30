<?php

namespace Webjump\Doctrine\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\ManyToMany;

#[Entity]
class Produto
{
    #[Id]
    #[GeneratedValue]
    #[Column]
    private int $id;

    #[Column]
    private string $nome;
    
    #[Column(unique:true)]
    private string $sku;

    #[Column]
    private float $preco;

    #[Column]
    private string $descricao;

    #[Column]
    private int $quantidade;

    #[ManyToMany(Categoria::class, mappedBy: "produtos")]
    private Collection $categorias;

    public function __construct()
    {
        $this->categorias = new ArrayCollection();
    }

    public function categorias(): Collection {
        return $this->categorias;
    }
   
    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function setNome(string $nome): void
    {
        $this->nome = $nome;
    }

    public function getSku(): string
    {
        return $this->sku;
    }

    public function setSku(string $sku): void
    {
        $this->sku = $sku;
    }

    public function getPreco(): float
    {
        return $this->preco;
    }

    public function setPreco(float $preco): void
    {
        $this->preco = $preco;
    }
    public function getDescricao(): string
    {
        return $this->descricao;
    }

    public function setDescricao(string $descricao): void
    {
        $this->descricao = $descricao;
    }

    public function getQuantidade(): int
    {
        return $this->quantidade;
    }

    public function setQuantidade(int $quantidade): void
    {
        $this->quantidade = $quantidade;
    }

    public function inserindoEmCategoria(Categoria $categoria): void
    {
        if($this->categorias->contains($categoria)){
            return;
        }
        $this->categorias->add($categoria);
        $categoria->inserindoEmProduto($this);
    }
}


