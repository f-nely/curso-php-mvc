<?php


namespace Alura\Cursos\Controller;


use Alura\Cursos\Entity\Curso;
use Alura\Cursos\Helper\FlashMessegeTrait;
use Alura\Cursos\Infra\EntityManagerCreator;
use Doctrine\ORM\EntityManagerInterface;

class Persistencia implements InterfaceControladorRequisicao
{
    use FlashMessegeTrait;

    /**
     * @var \Doctrine\ORM\EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function processaRequisicao(): void
    {
        $descricao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_STRING);
        $curso = new Curso();
        $curso->setDescricao($descricao);

        $id = filter_input(
            INPUT_GET,
            'id',
            FILTER_VALIDATE_INT
        );

        $tipo = 'success';
        if (!is_null($id) && $id !== false) {
            $curso->setId($id);
            $this->entityManager->merge($curso);
            $this->defineMenssagem($tipo, 'Curso atualizado com sucesso');
        } else {
            $this->entityManager->persist($curso);
            $this->defineMenssagem($tipo, 'Curso inserido com sucesso');
        }

        $this->entityManager->flush();


        header('Location: /listar-cursos', true, 302);
    }
}