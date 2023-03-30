<?php

namespace Webjump\Doctrine\Helper;

trait FlashMessageTrait
{
    public function defineMensagem(string $tipo, string $mensagem): void {
        $_SESSION['tipo-mensagem'] = $tipo;
        $_SESSION['mensagem'] .= $mensagem;
    }

}