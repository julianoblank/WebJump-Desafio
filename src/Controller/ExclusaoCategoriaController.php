<?php

namespace Webjump\Doctrine\Controller;

use Webjump\Doctrine\DB\EntityManagerCreator;
use Webjump\Doctrine\Entity\Categoria;
use Webjump\Doctrine\Helper\FlashMessageTrait;
use Webjump\Doctrine\Interface\InterfaceControllerRequest;

class ExclusaoCategoriaController implements InterfaceControllerRequest
{
    use FlashMessageTrait;

    private $entityManager;

    public function __construct()
    {
        $this->entityManager = EntityManagerCreator::createEntityManager();
    }

    public function processaRequisicao(): void
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        if(is_null($id) || $id === false){
            $this->defineMensagem('erro','Não foi possível excluir categoria.');
            header('Location: /public/dashboard');
            return;
        }

        try{
            $categoria = $this->entityManager->getReference(Categoria::class, $id);
            $this->entityManager->remove($categoria);
            $this->entityManager->flush();
            $this->defineMensagem('sucesso','Categoria excluida com sucesso.');
            header('Location: /public/categorias');
        }catch(Exception $e){
            echo 'Houve uma exceção: '.$e->getMessage();
        }
    }
}