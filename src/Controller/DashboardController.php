<?php

namespace Webjump\Doctrine\Controller;

use Webjump\Doctrine\DB\EntityManagerCreator;
use Webjump\Doctrine\Entity\Produto;
use Webjump\Doctrine\Helper\RenderizaViews;
use Webjump\Doctrine\Interface\InterfaceControllerRequest;

class DashboardController implements InterfaceControllerRequest
{
    use RenderizaViews;

    private $produtoRepository;

    public function __construct()
    {
        $entityManager = EntityManagerCreator::createEntityManager();
        $this->produtoRepository = $entityManager->getRepository(Produto::class);
    }


    public function processaRequisicao(): void{

        $produtos = $this->produtoRepository->findAll();
        $totalProdutos = $this->produtoRepository->count([]);

        echo $this->renderizaView('viewDashboard.php', [
            'produtos' => $produtos,
            'totalProdutos' => $totalProdutos
        ]);
    }
}