<?php

namespace Webjump\Doctrine\Controller;

use Webjump\Doctrine\DB\EntityManagerCreator;
use Webjump\Doctrine\Entity\Categoria;
use Webjump\Doctrine\Helper\RenderizaViews;
use Webjump\Doctrine\Interface\InterfaceControllerRequest;

class EditarCategoriaController implements InterfaceControllerRequest
{
    use RenderizaViews;

    private $entityManager;
    private $categoriaRepository;

    public function __construct()
    {
        $this->entityManager = EntityManagerCreator::createEntityManager();
        $this->categoriaRepository = $this->entityManager->getRepository(Categoria::class);
    }

    public function processaRequisicao(): void
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        if(is_null($id) || $id === false){
            header('Location: /public/dashboard');
            return;
        }
        $categoria = $this->categoriaRepository->find($id);

        echo $this->renderizaView('viewEditarCategoria.php', [
            'categoria' => $categoria,
            'titulo' => 'Edit Category'
        ]);
    }
}