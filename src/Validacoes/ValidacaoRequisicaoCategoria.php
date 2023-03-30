<?php

namespace Webjump\Doctrine\Validacoes;

use Webjump\Doctrine\DB\EntityManagerCreator;
use Webjump\Doctrine\Entity\Categoria;
use Webjump\Doctrine\Interface\InterfaceValidacaoRequest;

class ValidacaoRequisicaoCategoria implements InterfaceValidacaoRequest
{
    private $categoriaRepository;
    private $entityManager;

    public function __construct()
    {
        $this->entityManager = EntityManagerCreator::createEntityManager();
        $this->categoriaRepository = $this->entityManager->getRepository(Categoria::class);
    }
    public function validacaoParaPersistir(object $objeto, $id): array
    {
        $listaErro=[];

        if($objeto->getCodigo() == 0){
            array_push($listaErro,"O código da categoria não foi informado.");

        }

        if(!is_null($id)){
            if(count($this->categoriaRepository->createQueryBuilder('c')->where('c.codigo = :codigo')
                    ->andWhere('c.id <> :id')->setParameters(['codigo' => $objeto->getCodigo(), 'id' => $id])
                    ->getQuery()->getResult())>0){
                array_push($listaErro,"O código de categoria informado já está cadastrado para um produto.");
            }
        }else{
            if(!is_null($this->categoriaRepository->findOneBy(['codigo'=>$objeto->getCodigo()]))){
                array_push($listaErro,"O código de categoria informado já está cadastrado para um produto.");
            }
        }
        if($objeto->getNome() === ""){
            array_push($listaErro,"O nome da categoria não foi informado.");
        }

        return $listaErro;
    }
}