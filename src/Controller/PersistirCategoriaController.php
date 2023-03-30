<?php

namespace Webjump\Doctrine\Controller;

use Doctrine\DBAL\Driver\Exception;
use Webjump\Doctrine\DB\EntityManagerCreator;
use Webjump\Doctrine\Entity\Categoria;
use Webjump\Doctrine\Helper\FlashMessageTrait;
use Webjump\Doctrine\Interface\InterfaceControllerRequest;
use Webjump\Doctrine\Interface\InterfaceValidacaoRequest;
use Webjump\Doctrine\Validacoes\ValidacaoRequisicaoCategoria;

class PersistirCategoriaController implements InterfaceControllerRequest
{
    use FlashMessageTrait;

    private $entityManager;
    private InterfaceValidacaoRequest $validacaoRequisicaoCategoria;

    public function __construct()
    {
        $this->entityManager = EntityManagerCreator::createEntityManager();
        $this->validacaoRequisicaoCategoria = new ValidacaoRequisicaoCategoria();
    }

    public function processaRequisicao(): void
    {
        $listaErros=[];

        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $codigo = filter_input(INPUT_POST, 'codigo', FILTER_VALIDATE_INT);
        $nome = htmlspecialchars($_POST['name']);

        if(!is_null($id) && $id !== false){
            $categoria = $this->entityManager->find(Categoria::class, $id);
            $url = 'Location: /public/editarCategoria?id='.$id;

        }else{
            $categoria = new Categoria();
            $url = 'Location: /public/adicionarCategoria';
        }
        $categoria->setNome($nome);
        $categoria->setCodigo($codigo);

        $listaErros = $this->validacaoRequisicaoCategoria->validacaoParaPersistir($categoria,$id);

        if(empty($listaErros)){
            try{
                $this->entityManager->persist($categoria);
                $this->entityManager->flush();
                $this->defineMensagem('sucesso','Categoria cadastrada com sucesso.');
            }catch (Exception $e){
                echo 'Houve uma exceção: '.$e->getMessage();
            }

            // Redireciona para categorias após inserir categoria.
            header('Location: /public/categorias', false, 302);

        }else{
            foreach ($listaErros as $erro) {
                $this->defineMensagem('erro','<ul><li>'.$erro.'</li></ul><br/>');
            }
            header($url, false, 302);
        }

    }
}