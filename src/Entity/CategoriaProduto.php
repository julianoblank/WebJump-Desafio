<?php

namespace Webjump\Doctrine\Entity;

use Webjump\Doctrine\DB\EntityManagerCreator;

class CategoriaProduto
{
    private $entityManager;

    public function __construct()
    {
        $this->entityManager = EntityManagerCreator::createEntityManager();
    }

    // Método que adiciona categoria em produto
    public function adicionarCategoriaEmProduto(int $produtoId, array $categoriasId): void{
        try{
            $produto = $this->entityManager->find(Produto::class, $produtoId);
            foreach ($categoriasId as $categoriaId) {
                $categoria = $this->entityManager->find(Categoria::class, htmlspecialchars($categoriaId));
                $produto->inserindoEmCategoria($categoria);
            }
            $this->entityManager->flush();
        }catch (Exception $e){
            echo 'Houve uma exceção: '.$e->getMessage();
        }
    }
}