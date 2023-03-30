<?php

use Webjump\Doctrine\Controller\AdicionarCategoriaController;
use Webjump\Doctrine\Controller\AdicionarProdutoController;
use Webjump\Doctrine\Controller\CategoriasController;
use Webjump\Doctrine\Controller\DashboardController;
use Webjump\Doctrine\Controller\EditarCategoriaController;
use Webjump\Doctrine\Controller\EditarProdutoController;
use Webjump\Doctrine\Controller\ExclusaoCategoriaController;
use Webjump\Doctrine\Controller\ExclusaoProdutoController;
use Webjump\Doctrine\Controller\PersistirCategoriaController;
use Webjump\Doctrine\Controller\PersistirProdutoController;
use Webjump\Doctrine\Controller\ProdutosController;

$rotas = [
    '/dashboard' => DashboardController::class,  /// Utiliza ::class para obter o nome completo da classe
    '/adicionarProduto' => AdicionarProdutoController::class,
    '/salvarProduto' => PersistirProdutoController::class,
    '/adicionarCategoria' => AdicionarCategoriaController::class,
    '/salvarCategoria' => PersistirCategoriaController::class,
    '/categorias' => CategoriasController::class,
    '/produtos' => ProdutosController::class,
    '/excluirCategoria' => ExclusaoCategoriaController::class,
    '/editarCategoria' => EditarCategoriaController::class,
    '/excluirProduto' => ExclusaoProdutoController::class,
    '/editarProduto' => EditarProdutoController::class
];

return $rotas;