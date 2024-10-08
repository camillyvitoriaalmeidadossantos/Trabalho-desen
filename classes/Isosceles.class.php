<?php
require_once("../classes/Database.class.php");
require_once("../classes/unidade.class.php");
require_once("../classes/formas.class.php");
// require_once("../classes/triangulo.class.php");

 class Isosceles{
    private $id_is;
    private $ladoA;
    private $ladoB;
    private $ladoC;
    private $cor;
    private $unidade;

    public function __construct($id_is = 0, $ladoA = 0,$ladoB = 0,$ladoC = 0, $cor = "", unidade $unidade) { 
        $this->setIdIs($id_is);
        $this->setUnidade($unidade);
        $this->setLadoA($ladoA); 
        $this->setLadoB($ladoB); 
        $this->setLadoC($ladoC); 
        $this->setCor($cor);
    }

    public function setIdIs($novoIdIs) { 
        if ($novoIdIs < 0) {
            throw new Exception("Erro: ID inválido!");
        } else {
            $this->id_is = $novoIdIs; 
        }
    }

    public function setUnidade($novoUnidade) {
        if (is_null($novoUnidade)) {
            throw new Exception("Erro: Unidade inválida!");
        } else {
            $this->unidade = $novoUnidade;
        }
    }

    public function setLado($novoLadoA) {
        if ($novoLadoA <= 0) {
            throw new Exception("Erro: LadoA inválido!");
        } else {
            $this->ladoA = $novoLadoA;
        }
    }
    public function setLadoB($novoLadoB) {
        if ($novoLadoB <= 0) {
            throw new Exception("Erro: LadoB inválido!");
        } else {
            $this->ladoB = $novoLadoB;
        }
    }
    public function setLadoC($novoLadoC) {
        if ($novoLadoC <= 0) {
            throw new Exception("Erro: LadoC inválido!");
        } else {
            $this->ladoC = $novoLadoC;
        }
    }

    public function setCor($novoCor) {
        if (empty($novoCor)) {
            throw new Exception("Erro: Cor inválida!");
        } else {
            $this->cor = $novoCor;
        }
    }

    public function getIdIs() { return $this->id_is; }
    public function getUnidade() { return $this->unidade; }
    public function getLadoA() { return $this->ladoA; }
    public function getLadoB() { return $this->ladoB; }
    public function getLadoC() { return $this->ladoC; }
    public function getCor() { return $this->cor; }

    public function incluir() {
        $sql = 'INSERT INTO Isosceles (id_un, ladoA, ladoB, ladoC, cor)
                VALUES (:id_un, :ladoA, :ladoB, :ladoC, :cor)';
        $parametros = [
            ':id_un' => $this->unidade->getIdUn(),
            ':ladoA' => $this->ladoA,
            ':ladoB' => $this->ladoB,
            ':ladoC' => $this->ladoC,
            ':cor' => $this->cor
        ];
        Database::executar($sql, $parametros);
    }

    public function excluir() {
        $sql = 'DELETE FROM Isosceles WHERE id_is = :id_is';
        $parametros = [
            ':id_is' => $this->id_is
        ];
        Database::executar($sql, $parametros);
    }

    public function alterar() {
        $sql = 'UPDATE Isosceles 
                   SET cor = :cor, ladoA = :ladoA, ladoB = :ladoB, ladoC = :ladoC ,id_un = :id_un
                 WHERE id_is = :id_is';
        $parametros = [
            ':id_is' => $this->id_is,
            ':cor' => $this->cor,
            ':ladoA' => $this->ladoA,
            ':ladoB' => $this->ladoB,
            ':ladoC' => $this->ladoC,
            ':id_un' => $this->unidade->getIdUn()
        ];
        Database::executar($sql, $parametros);
    }

    public static function listar($tipo = 0, $busca = "") {
        $sql = "SELECT * FROM Isosceles";
        $parametros = [];

        if ($tipo > 0) {
            switch($tipo) {
                case 1: $sql .= " WHERE id_is = :busca"; break;
                case 2: $sql .= " WHERE ladoA LIKE :busca"; $busca = "%{$busca}%"; break;
                case 3: $sql .= " WHERE ladoB LIKE :busca"; $busca = "%{$busca}%"; break;
                case 4: $sql .= " WHERE ladoC LIKE :busca"; $busca = "%{$busca}%"; break;
                case 5: $sql .= " WHERE cor LIKE :busca"; $busca = "%{$busca}%"; break;
                case 6: $sql .= " WHERE id_un = :busca"; break;
            }
            $parametros = [':busca' => $busca];
        }

        $comando = Database::executar($sql, $parametros);
        $formas = [];

        return $formas;
        public function calcularArea() {
          $sp = (parent::getLadoA() + parent::getLadoB() + parent::getLadoC()) / 2;
          $area = ($sp * ($sp - parent::getLadoA()) * ($sp - parent::getLadoB()) * ($sp - parent::getLadoC()));
          return $area;
        }
        public function calcularPerimetro() {
          $p = parent::getLadoA() + parent::getLadoB() + parent::getLadoC();
          return $p;
        }
    }

    public function DesenharIsosceles() {
        return "<div style='display:block; width:{$this->lado}px; height:{$this->lado}px; background-color:{$this->cor}'></div>";
    }
}
?>
