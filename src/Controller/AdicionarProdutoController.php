<?php

namespace Webjump\Doctrine\Controller;

use Webjump\Doctrine\DB\EntityManagerCreator;
use Webjump\Doctrine\Entity\Categoria;
use Webjump\Doctrine\Helper\RenderizaViews;
use Webjump\Doctrine\Interface\InterfaceControllerRequest;

class AdicionarProdutoController implements InterfaceControllerRequest
{
    use RenderizaViews;

    private $categoriaRepository;
    public function __construct()
    {
        $entityManager = EntityManagerCreator::createEntityManager();
        $this->categoriaRepository = $entityManager->getRepository(Categoria::class);
    }

    public function processaRequisicao(): void
    {
        $categorias = $this->categoriaRepository->findAll();

        echo $this->renderizaView('viewAdicionarProduto.php', [
            'titulo' => 'New Product',
            'categorias' => $categorias
        ]);
    }
}