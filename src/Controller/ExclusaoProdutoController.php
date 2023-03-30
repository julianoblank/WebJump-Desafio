<?php

namespace Webjump\Doctrine\Controller;

use Webjump\Doctrine\DB\EntityManagerCreator;
use Webjump\Doctrine\Entity\Produto;
use Webjump\Doctrine\Helper\FlashMessageTrait;
use Webjump\Doctrine\Interface\InterfaceControllerRequest;

class ExclusaoProdutoController implements InterfaceControllerRequest
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
            $this->defineMensagem('erro','Não foi possível excluir o produto.');
            header('Location: /public/dashboard');
            return;
        }

        try{
            $produto = $this->entityManager->getReference(Produto::class, $id);
            $this->entityManager->remove($produto);
            $this->entityManager->flush();
            $this->defineMensagem('sucesso','Produto excluido com sucesso.');
            header('Location: /public/produtos');
        }catch (Exception $e){
            echo 'Houve uma exceção: '.$e->getMessage();
        }
    }
}