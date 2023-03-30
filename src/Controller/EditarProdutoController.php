<?php

namespace Webjump\Doctrine\Controller;

use Webjump\Doctrine\DB\EntityManagerCreator;
use Webjump\Doctrine\Entity\Categoria;
use Webjump\Doctrine\Entity\Produto;
use Webjump\Doctrine\Helper\RenderizaViews;
use Webjump\Doctrine\Interface\InterfaceControllerRequest;

class EditarProdutoController implements InterfaceControllerRequest
{
    use RenderizaViews;

    private $entityManager;
    private $produtoRepository;
    private $categoriaRepository;

    public function __construct()
    {
        $this->entityManager = EntityManagerCreator::createEntityManager();
        $this->produtoRepository = $this->entityManager->getRepository(Produto::class);
        $this->categoriaRepository = $this->entityManager->getRepository(Categoria::class);
    }


    public function processaRequisicao(): void
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        if(is_null($id) || $id === false){
            header('Location: /public/dashboard');
            return;
        }

        $produto = $this->produtoRepository->find($id);
        $categorias = $this->categoriaRepository->findAll();

        echo $this->renderizaView('viewEditarProduto.php', [
            'categorias' => $categorias,
            'titulo' => 'Edit Product',
            'produto' => $produto
        ]);
    }
}