<?php

namespace Webjump\Doctrine\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\ManyToMany;

#[Entity]
class Categoria
{
    #[Id]
    #[GeneratedValue]
    #[Column]
    private int $id;

    #[Column(unique: true)]
    private int $codigo;

    #[Column]
    private string $nome;

    #[ManyToMany(targetEntity:Produto::class, inversedBy:"categorias")]
    private Collection $produtos;

    public function __construct()
    {
        $this->produtos = new ArrayCollection();
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

    public function getCodigo(): int
    {
        return $this->codigo;
    }

    public function setCodigo(int $codigo): void
    {
        $this->codigo = $codigo;
    }

    public function produtos(): Collection{
        return $this->produtos();
    }
    public function inserindoEmProduto(Produto $produto): void
    {
        if($this->produtos->contains($produto)){
            return;
        }
        $this->produtos->add($produto);
        $produto->inserindoEmCategoria($this);
    }
}
