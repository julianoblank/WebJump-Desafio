<?php

namespace Webjump\Doctrine\Controller;

use Webjump\Doctrine\Helper\RenderizaViews;
use Webjump\Doctrine\Interface\InterfaceControllerRequest;

class AdicionarCategoriaController implements InterfaceControllerRequest
{
    use RenderizaViews;

    public function processaRequisicao(): void
    {
        echo $this->renderizaView('viewAdicionarCategoria.php', [
            'titulo' => 'New Category'
        ]);
    }
}