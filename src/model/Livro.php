<?php 

class Livro{

    private $codigo;
    private $titulo;
    private $autor;
    private $anoLancamento;

    public function getCodigo(){
        return $this->codigo;
    }

    public function setCodigo($n){
        $this->codigo = $n;
    }

    public function getTitulo(){
        return $this->titulo;
    }

    public function setTitulo($n){
        $this->titulo = $n;
    }

    public function getAutor(){
        return $this->autor;
    }

    public function setAutor($n){
        $this->autor = $n;
    }

    public function getAnoLancamento(){
        return $this->anoLancamento;
    }

    public function setAnoLancamento($n){
        $this->anoLancamento = $n;
    }
}
?>