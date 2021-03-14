<?php


namespace Alura\Cursos\Helper;


trait FlashMessegeTrait
{
    public function defineMessagem(string $tipo, string $mensagem): void
    {
        $_SESSION['mensagem'] = $mensagem;
        $_SESSION['tipo_mensagem'] = $tipo;
    }
}