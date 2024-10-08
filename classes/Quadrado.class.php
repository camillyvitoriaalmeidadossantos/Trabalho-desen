<?php
require_once("../classes/Database.class.php");
require_once("../classes/unidade.class.php");
require_once("../classes/formas.class.php");

class Quadrado {
    private $id_quad;
    private $lado;
    private $cor;
    private $unidade;

    public function __construct($id_quad = 0, $lado = 0, $cor = "", unidade $unidade ) { 
        $this->setIdQuad($id_quad);
        $this->setUnidade($unidade);
        $this->setLado($lado); 
        $this->setCor($cor);
    }

    public function setIdQuad($novoIdQuad) { 
        if ($novoIdQuad < 0) {
            throw new Exception("Erro: ID inválido!");
        } else {
            $this->id_quad = $novoIdQuad; 
        }
    }

    public function setUnidade($novoUnidade) {
        if (is_null($novoUnidade)) {
            throw new Exception("Erro: Unidade inválida!");
        } else {
            $this->unidade = $novoUnidade;
        }
    }

    public function setLado($novoLado) {
        if ($novoLado <= 0) {
            throw new Exception("Erro: Lado inválido!");
        } else {
            $this->lado = $novoLado;
        }
    }

    public function setCor($novoCor) {
        if (empty($novoCor)) {
            throw new Exception("Erro: Cor inválida!");
        } else {
            $this->cor = $novoCor;
        }
    }

    public function getIdQuad() { return $this->id_quad; }
    public function getUnidade() { return $this->unidade; }
    public function getLado() { return $this->lado; }
    public function getCor() { return $this->cor; }

    public function incluir() {
        $sql = 'INSERT 
                INTO Quadrado (id_un, lado, cor)
                VALUES (:id_un, :lado, :cor)';
        $parametros = [
            ':id_un' => $this->unidade->getIdUn(),
            ':lado' => $this->lado,
            ':cor' => $this->cor
        ];
        
        Database::executar($sql, $parametros);
    }

    public function excluir() {
        $sql = 'DELETE 
                FROM Quadrado 
                WHERE id_quad = :id_quad';
        $parametros = [
            ':id_quad' => $this->id_quad
        ];
        Database::executar($sql, $parametros);
    }

    public function alterar() {
        $sql = 'UPDATE Quadrado 
                   SET cor = :cor, lado = :lado, id_un = :id_un
                 WHERE id_quad = :id_quad';
        $parametros = [
            ':id_quad' => $this->id_quad,
            ':cor' => $this->cor,
            ':lado' => $this->lado,
            ':id_un' => $this->unidade->getIdUn()
        ];
        Database::executar($sql, $parametros);
    }

    public static function listar($tipo = 0, $busca = "") {
        $sql = "SELECT * FROM Quadrado";
        $parametros = [];

        if ($tipo > 0) {
            switch($tipo) {
                case 1: $sql .= " WHERE id_quad = :busca"; break;
                case 2: $sql .= " WHERE lado LIKE :busca"; $busca = "%{$busca}%"; break;
                case 3: $sql .= " WHERE cor LIKE :busca"; $busca = "%{$busca}%"; break;
                case 4: $sql .= " WHERE id_un = :busca"; break;
            }
            $parametros = [':busca' => $busca];
        }

        $comando = Database::executar($sql, $parametros);
        $formas = [];

        while ($registro = $comando->fetch(PDO::FETCH_ASSOC)) {
            $unidade = new unidade($registro['id_un']); 
            $quadrado = new Quadrado($registro['id_quad'], $registro['lado'], $registro['cor'], $unidade);
            array_push($formas, $quadrado);
        }
        return $formas;
    }

    public function desenhar() {
        return "<div style='width: {$this->lado}px; height: {$this->lado}px; background-color: {$this->cor}; display: inline-block; margin: 20px;'></div>";
    }
    public function calcularArea() {
        return $this->getLado() * $this->getLado();
    }

    public function calcularPerimetro() {
        return 4 * $this->getLado();
    }
}
?>
