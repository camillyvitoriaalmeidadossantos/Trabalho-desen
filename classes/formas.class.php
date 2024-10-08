<?php

abstract class Formas {
    private $id_quad; 
    private $cor;
    private $unidade;     
    private $fundo;
    private $id_tri;
    private $id_cir;

    public function __construct($id_quad = 0, $cor = "null", unidade $unidade, $fundo = "null", $id_tri = 0, $id_cir = 0) {
        $this->setIdQuad($id_quad);
        $this->setCor($cor);
        $this->setUnidade($unidade);
        $this->setFundo($fundo);
        $this->setIdTri($id_tri);
        $this->setIdCir($id_cir);
    }

    public function setIdQuad($novoIdQuad) {
        if ($novoIdQuad < 0)
            throw new Exception("Erro: id inválido!");
        else
            $this->id_quad = $novoIdQuad;
    }

    public function setCor($cor) {
        $this->cor = $cor;
    }

    public function setFundo($fundo) {
        $this->fundo = $fundo;
    }

    public function setUnidade(unidade $unidade = null) {
        if ($unidade)
            $this->unidade = $unidade;
        else
            throw new Exception("Erro: Deve ser informada uma unidade de medida!");
    }

    public function setIdTri($novoIdTri) {
        if ($novoIdTri < 0)
            throw new Exception("Erro: id inválido!");
        else
            $this->id_tri = $novoIdTri;
    }

    public function setIdCir($novoIdCir) {
        if ($novoIdCir < 0)
            throw new Exception("Erro: id inválido!");
        else
            $this->id_cir = $novoIdCir;
    }

    public function getIdQuad() { return $this->id_quad; }
    public function getCor() { return $this->cor; }
    public function getUnidade() { return $this->unidade; }
    public function getFundo() { return $this->fundo; }
    public function getIdTri() { return $this->id_tri; }
    public function getIdCir() { return $this->id_cir; }

    abstract public function incluir();
    abstract public function excluir();
    abstract public function alterar();
    abstract public static function listar($tipo = 0, $busca = ""): array;
    abstract public function desenhar();
    abstract public function DesenharCirculo();
    abstract public function DesenharTriangulo();
    abstract public function calcularArea();
    abstract public function calcularPerimetro();
}
