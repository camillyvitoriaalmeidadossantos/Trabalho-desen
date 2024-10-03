<?php
require_once("../classes/Database.class.php");
require_once("../classes/unidade.class.php");
require_once("../classes/formas.class.php");
require_once("../classes/triangulo.class.php");

class Escaleno extends Triangulo {
    private $id_tri;
    private $ladoA;
    private $ladoB;
    private $ladoC;
    private $cor;
    private $unidade;

    public function __construct($id_tri = 0, $ladoA = 0,$ladoB = 0,$ladoC = 0, $cor = "", unidade $unidade) { 
        $this->setIdTri($id_tri);
        $this->setUnidade($unidade);
        $this->setLadoA($ladoA); 
        $this->setLadoB($ladoB); 
        $this->setLadoC($ladoC); 
        $this->setCor($cor);
    }

    public function setIdTri($novoIdTri) { 
        if ($novoIdTri < 0) {
            throw new Exception("Erro: ID inválido!");
        } else {
            $this->id_tri = $novoIdTri; 
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

    public function getIdTri() { return $this->id_tri; }
    public function getUnidade() { return $this->unidade; }
    public function getLadoA() { return $this->ladoA; }
    public function getLadoB() { return $this->ladoB; }
    public function getLadoC() { return $this->ladoC; }
    public function getCor() { return $this->cor; }

    public function incluir() {
        $sql = 'INSERT INTO Triangulo (id_un, ladoA, ladoB, ladoC, cor)
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
        $sql = 'DELETE FROM Triangulo WHERE id_tri = :id_tri';
        $parametros = [
            ':id_tri' => $this->id_tri
        ];
        Database::executar($sql, $parametros);
    }

    public function alterar() {
        $sql = 'UPDATE Triangulo 
                   SET cor = :cor, ladoA = :ladoA, ladoB = :ladoB, ladoC = :ladoC ,id_un = :id_un
                 WHERE id_tri = :id_tri';
        $parametros = [
            ':id_tri' => $this->id_tri,
            ':cor' => $this->cor,
            ':ladoA' => $this->ladoA,
            ':ladoB' => $this->ladoB,
            ':ladoC' => $this->ladoC,
            ':id_un' => $this->unidade->getIdUn()
        ];
        Database::executar($sql, $parametros);
    }

    // public static function listar($tipo = 0, $busca = "") {
    //     $sql = "SELECT * FROM Triangulo";
    //     $parametros = [];

    //     if ($tipo > 0) {
    //         switch($tipo) {
    //             case 1: $sql .= " WHERE id_tri = :busca"; break;
    //             case 2: $sql .= " WHERE ladoA LIKE :busca"; $busca = "%{$busca}%"; break;
    //             case 3: $sql .= " WHERE ladoB LIKE :busca"; $busca = "%{$busca}%"; break;
    //             case 4: $sql .= " WHERE ladoC LIKE :busca"; $busca = "%{$busca}%"; break;
    //             case 5: $sql .= " WHERE cor LIKE :busca"; $busca = "%{$busca}%"; break;
    //             case 6: $sql .= " WHERE id_un = :busca"; break;
    //         }
    //         $parametros = [':busca' => $busca];
    //     }

        // $comando = Database::executar($sql, $parametros);
        // $formas = [];

        // while ($registro = $comando->fetch(PDO::FETCH_ASSOC)) {
        //     $unidade = new unidade($registro['id_un']); // Criar objeto Unidade
        //     $triangulo = new Triangulo($registro['id_tri'], $registro['ladoA'], $registro['ladoB'], $registro['ladoC'], $registro['cor'], $unidade);
        //     array_push($formas, $triangulo);
        // }

        // return $formas;
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

    // public function Desenhar() {
    //     return "<div style='display:block; width:{$this->lado}px; height:{$this->lado}px; background-color:{$this->cor}'></div>";
    // }

  


?>
