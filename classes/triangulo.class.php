<?php
require_once("../classes/Database.class.php");
require_once("../classes/unidade.class.php");
require_once("../classes/formas.class.php");

abstract class Triangulo extends Formas{
    private $id_tri;
    private $ladoA;
    private $ladoB;
    private $ladoC;
    private $cor;
    private $fundo;
    private $unidade;

    public function __construct($id_tri = 0, $ladoA = 0,$ladoB = 0,$ladoC = 0, $cor = "", $fundo, unidade $unidade) { 
        parent::__construct($id_tri, $cor, $unidade, $fundo);
        $this->setIdTri($id_tri);
        $this->setUnidade($unidade);
        $this->setLadoA( $ladoA); 
        $this->setLadoB($ladoB); 
        $this->setLadoC($ladoC); 
        $this->setCor($cor);
        $this->setFundo($fundo);
    }

    abstract public function setIdTri($novoIdTri);
    abstract public function setUnidade($novoUnidade);
    abstract public function setLadoA($novoLadoA);
    abstract public function setLadoB($novoLadoB);
    abstract public function setLadoC($novoLadoC);
    abstract public function setCor($novoCor);
    abstract public function setFundo($novoCor);

    public function getIdTri() { return $this->id_tri; }
    public function getUnidade() { return $this->unidade; }
    public function getLadoA() { return $this->ladoA; }
    public function getLadoB() { return $this->ladoB; }
    public function getLadoC() { return $this->ladoC; }
    public function getCor() { return $this->cor; }
    public function getFundo() { return $this->fundo; }

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
    public static function listar($tipo = 0, $busca = ""): array {
        $sql = "SELECT * FROM Triangulo";
        $parametros = [];

        if ($tipo > 0) {
            switch($tipo) {
                case 1: $sql .= " WHERE id_tri = :busca"; break;
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

        while ($registro = $comando->fetch(PDO::FETCH_ASSOC)) {
            $unidade = new unidade($registro['id_un']); 
            $triangulo = new Triangulo($registro['id_tri'], $registro['ladoA'], $registro['ladoB'], $registro['ladoC'], $registro['cor'], $unidade);
            array_push($formas, $triangulo);
        }

        return $formas;
        
    }
    abstract public function calcularArea();
    abstract public function calcularPerimetro();

}
?>
