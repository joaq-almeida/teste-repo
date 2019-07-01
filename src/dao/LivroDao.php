<?php

require_once '../model/Livro.php';
require_once '../factory/Conexao.php';

class LivroDao extends Conexao{

    public function inserir(Livro $l){

        try {
            $sql = " INSERT INTO livro(titulo, autor, anoLancamento)
                 VALUES(?,?,?) ";
            $stm = Conexao::prepare($sql);
            $x = 0;
            $stm->bindValue(++$x, $l->getTitulo());
            $stm->bindValue(++$x, $l->getAutor());
            $stm->bindValue(++$x, $l->getAnoLancamento());
            $stm->execute();

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
   
    public function deletar(Livro $l){

        try {
            $sql = " DELETE FROM livro WHERE livro.codigo = ? ";
            $stm = Conexao::prepare($sql);
            $x = 0;
            $stm->bindValue(++$x, $l->getCodigo());
            $stm->execute();

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function editar(Livro $l){

        try {
            $sql = " UPDATE livro SET titulo = ?, autor = ?, anoLancamento = ?
                    WHERE livro.codigo = ? ";
            $stm = Conexao::prepare($sql);
            $x = 0;
            $stm->bindValue(++$x, $l->getTitulo());
            $stm->bindValue(++$x, $l->getAutor());
            $stm->bindValue(++$x, $l->getAnoLancamento());
            $stm->bindValue(++$x, $l->getCodigo());
            $stm->execute();

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
 
    public function listar(){

        try {
            $sql = " SELECT * FROM livro ORDER BY livro.codigo DESC";
            $stm = Conexao::prepare($sql);
            $stm->execute();
            return $stm->fetchAll();

        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function encontrarPorAutor(Livro $l){

        try {
            $sql = " SELECT * FROM livro WHERE livro.autor LIKE '?%' ";
            $stm = Conexao::prepare($sql);
            $x = 0;
            $stm->bindValue(++$x, $l->getAutor());
            $stm->execute();
            return $stm->fetch();

        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
?>