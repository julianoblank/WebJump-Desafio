<?php

namespace Webjump\Doctrine\Helper;

trait RenderizaViews
{
    public function renderizaView(string $caminhoView, array $dados): string{

        // Esse metodo extrai o que vem da key do array e transforma em uma variavel.
        extract($dados);

        // Metodo que gera buffer
        ob_start();
        require __DIR__ . '/../../view/'.$caminhoView;

        return ob_get_clean();
    }
}