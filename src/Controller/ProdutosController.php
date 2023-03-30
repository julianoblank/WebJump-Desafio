<?php

namespace Webjump\Doctrine\Controller;

use Webjump\Doctrine\DB\EntityManagerCreator;
use Webjump\Doctrine\Entity\Categoria;
use Webjump\Doctrine\Entity\Produto;
use Webjump\Doctrine\Helper\RenderizaViews;
use Webjump\Doctrine\Interface\InterfaceControllerRequest;

class ProdutosController implements InterfaceControllerRequest
{
    use RenderizaViews;

    private $produtoRepository;

    public function __construct()
    {
        $entityManager = EntityManagerCreator::createEntityManager();
        $this->produtoRepository = $entityManager->getRepository(Produto::class);
    }
    public function processaRequisicao(): void
    {
        $nomeCategoria = [];
        $produtos = $this->produtoRepository->findAll();
        foreach ($produtos as $produto) {
             array_push($nomeCategoria, implode('<br/> ',$produto->categorias()
                 ->map(fn(Categoria $categoria)=>$categoria->getNome())
                 ->toArray()));
        }
        echo $this->renderizaView('viewProdutos.php', [
            'nomeCategoria' => $nomeCategoria,
            'produtos' => $produtos
        ]);
    }
}