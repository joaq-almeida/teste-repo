<?php

require_once '../model/Livro.php';
require_once '../dao/LivroDao.php';

class PessoaController{
    
    public function __construct(){

        $this->listar();
        if(isset($_POST['cadastrar'])){
            $this->receberDadosInserir();
        }
        if(isset($_POST['atualizar'])){
            $this->receberDadosEditar();
        }
        if(isset($_GET['deletar'])){
            $this->receberDeletar();
        }
        /*if(isset($_GET['listar'])){
            $this->listar();
        }*/
    }

    public function receberDadosInserir(){
        $l = new Livro();
        $dao = new LivroDao();

        $l->setTitulo($_POST['titulo']);
        $l->setAutor($_POST['autor']);
        $l->setAnoLancamento($_POST['anoLancamento']);

        $dao->inserir($l);
    }

    public function receberDadosEditar(){
        $l = new Livro();
        $dao = new LivroDao();

        $l->setTitulo($_POST['titulo']);
        $l->setAutor($_POST['autor']);
        $l->setAnoLancamento($_POST['anoLancamento']);
        $l->setCodigo($_POST['codigo']);

        $dao->editar($l);
    }

    public function receberDeletar(){
        $l = new Livro();
        $dao = new LivroDao();
        $l->setCodigo($_GET['codigo']);

        $dao->deletar($l);
    }

    public function listar(){
        $l = new Livro();
        $dao = new LivroDao();
        $dados = [];

        foreach ($dao->listar() as $key => $value) {
            $dados[] = $value;
        }
        echo json_encode($dados);
    }
}

new PessoaController();

?>