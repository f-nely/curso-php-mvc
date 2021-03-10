<?php


namespace Alura\Cursos\Controller;


class FormularioInsercao extends ControlerComHtml implements InterfaceControladorRequisicao
{
    public function processaRequisicao(): void
    {
        echo $this->renderizaHtml('cursos/formulario.php', [
            'titulo' => 'Novo curso'
        ]);
    }
}