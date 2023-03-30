<?php

namespace Webjump\Doctrine\Controller;

use Webjump\Doctrine\DB\EntityManagerCreator;
use Webjump\Doctrine\Entity\CategoriaProduto;
use Webjump\Doctrine\Entity\Produto;
use Webjump\Doctrine\Helper\FlashMessageTrait;
use Webjump\Doctrine\Interface\InterfaceControllerRequest;
use Webjump\Doctrine\Interface\InterfaceValidacaoRequest;
use Webjump\Doctrine\Validacoes\ValidacaoRequisicaoProduto;


class PersistirProdutoController implements InterfaceControllerRequest
{
    use FlashMessageTrait;

    private $entityManager;
    private InterfaceValidacaoRequest  $validacaoRequestProduto;
    private CategoriaProduto $categoriaProduto;

    public function __construct()
    {
        $this->entityManager = EntityManagerCreator::createEntityManager();
        $this->validacaoRequestProduto = new ValidacaoRequisicaoProduto();
        $this->categoriaProduto = new CategoriaProduto();
    }

    public function processaRequisicao(): void
    {
       $listaErros = [];

        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        if (!is_null($id) && $id !== false) {
            $produto = $this->entityManager->getReference(Produto::class, $id);
            $url = 'Location: /public/editarProduto?id='.$id;
        }else{
            $produto = new Produto();
            $id=null;
            $url = 'Location: /public/adicionarProduto';
        }
        $produto->setSku(htmlspecialchars($_POST['sku']));
        $produto->setNome(htmlspecialchars($_POST['name']));
        $produto->setPreco(htmlspecialchars(floatval($_POST['price'])));
        $produto->setQuantidade(htmlspecialchars(intval($_POST['quantity'])));
        $produto->setDescricao(htmlspecialchars($_POST['description']));

        $listaErros = $this->validacaoRequestProduto->validacaoParaPersistir($produto, $id);

        if (!isset($_POST['category'])) {
            array_push($listaErros, 'Não foi selecionado a categoria do produto.');
        }

        if(empty($listaErros)){
            if (!is_null($id) && $id !== false) {
                $produto = $this->entityManager->getReference(Produto::class, $id);
                try{
                    $this->entityManager->remove($produto);
                    $this->entityManager->flush();
                }catch (Exception $e){
                    echo 'Houve uma exceção: '.$e->getMessage();
                }
            }
            try{
                $this->entityManager->persist($produto);
                $this->entityManager->flush();

                $categoriasId = $_POST['category'];
                $produtoId = $produto->getId();
                $this->categoriaProduto->adicionarCategoriaEmProduto($produtoId, $categoriasId);
                $this->defineMensagem('sucesso','Produto cadastrado com sucesso.');
                // Redireciona para produtos após inserir produto em categoria.
                header('Location: /public/produtos', false, 302);
            }catch (Exception $e){
                echo 'Houve uma exceção: '.$e->getMessage();
            }
        }else{
            foreach ($listaErros as $erro) {
                $this->defineMensagem('erro','<ul><li>'.$erro.'</li></ul><br/>');
            }
            header($url, false, 302);
        }
    }
}