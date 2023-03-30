<?php

use Webjump\Doctrine\Controller\persistProduct;

require __DIR__.'/../vendor/autoload.php'; // retorna o diretorio atual  "C:\webjump-desafio\desafio\public"

// Busca as rotas em config.
$rotas = require __DIR__.'/../config/rotas.php';
$url = $_SERVER['PATH_INFO'];

if(!array_key_exists($url, $rotas)){
    http_response_code(404);
    exit();
}

if(!isset($_SESSION)) {
    session_start();
}

$classeController = $rotas[$url];
$controller = new $classeController();
$controller->processaRequisicao();


