<?php

namespace Webjump\Doctrine\Validacoes;

use Webjump\Doctrine\DB\EntityManagerCreator;
use Webjump\Doctrine\Entity\Produto;
use Webjump\Doctrine\Interface\InterfaceValidacaoRequest;

class ValidacaoRequisicaoProduto implements InterfaceValidacaoRequest
{
    private $produtoRepository;
    private $entityManager;

    public function __construct()
    {
        $this->entityManager = EntityManagerCreator::createEntityManager();
        $this->produtoRepository = $this->entityManager->getRepository(Produto::class);
    }

    public function validacaoParaPersistir(object $objeto, $id): array
    {
        $listaErro=[];

        if($objeto->getSku() === ""){
            array_push($listaErro,"O SKU não foi informado.");
        }

        if(!is_null($id)){
            if(count($this->produtoRepository->createQueryBuilder('p')->where('p.sku = :sku')
                ->andWhere('p.id <> :id')->setParameters(['sku' => $objeto->getSku(), 'id' => $id])
                ->getQuery()->getResult())>0){
                array_push($listaErro,"O SKU informado já está cadastrado para um produto.");
            }
        }else{
            if(!is_null($this->produtoRepository->findOneBy(['sku'=>$objeto->getSku()]))){
                array_push($listaErro,"O SKU informado já está cadastrado para um produto.");
            }
        }
        if($objeto->getNome() === ""){
            array_push($listaErro,"O nome do produto não foi informado.");
        }

        if($objeto->getPreco() == 0){
            array_push($listaErro,"O preço do produto não foi informado.");
        }

        if($objeto->getQuantidade() == 0){
            array_push($listaErro,"A quantidade do produto não foi informado.");
        }

        if($objeto->getDescricao() === ""){
            array_push($listaErro,"A descrição do produto não foi informado.");
        }

        return $listaErro;
    }
}