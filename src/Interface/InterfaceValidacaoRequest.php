<?php

namespace Webjump\Doctrine\Interface;

interface InterfaceValidacaoRequest
{
    public function validacaoParaPersistir(Object $objeto, int $id):array;
}