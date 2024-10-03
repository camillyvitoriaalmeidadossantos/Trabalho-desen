<?php
require_once("../classes/Database.class.php");
require_once("../classes/unidade.class.php");
require_once("../classes/formas.class.php");

class Circulo {
    private $id_cir;
    private $raio;
    private $cor;
    private $unidade;

    public function __construct($id_cir = 0, $raio = 0, $cor = "", unidade $unidade ) { 
        $this->setIdCir($id_cir);
        $this->setUnidade($unidade);
        $this->setRaio($raio); 
        $this->setCor($cor);
    }

    public function setIdCir($novoIdCir) { 
        if ($novoIdCir < 0) {
            throw new Exception("Erro: ID inválido!");
        } else {
            $this->id_cir = $novoIdCir; 
        }
    }

    public function setUnidade($novoUnidade) {
        if (is_null($novoUnidade)) {
            throw new Exception("Erro: Unidade inválida!");
        } else {
            $this->unidade = $novoUnidade;
        }
    }

    public function setRaio($novoRaio) {
        if ($novoRaio <= 0) {
            throw new Exception("Erro: Raio inválido!");
        } else {
            $this->raio = $novoRaio;
        }
    }

    public function setCor($novoCor) {
        if (empty($novoCor)) {
            throw new Exception("Erro: Cor inválida!");
        } else {
            $this->cor = $novoCor;
        }
    }

    public function getIdCir() { return $this->id_cir; }
    public function getUnidade() { return $this->unidade; }
    public function getRaio() { return $this->raio; }
    public function getCor() { return $this->cor; }

    public function incluir() {
        $sql = 'INSERT INTO Circulo (id_un, raio, cor)
                VALUES (:id_un, :raio, :cor)';
        $parametros = [
            ':id_un' => $this->unidade->getIdUn(),
            ':raio' => $this->raio,
            ':cor' => $this->cor
        ];
        Database::executar($sql, $parametros);
    }

    public function excluir() {
        $sql = 'DELETE FROM Circulo WHERE id_cir = :id_cir';
        $parametros = [
            ':id_cir' => $this->id_cir
        ];
        Database::executar($sql, $parametros);
    }

    public function alterar() {
        $sql = 'UPDATE Circulo 
                   SET cor = :cor, raio = :raio, id_un = :id_un
                 WHERE id_cir = :id_cir';
        $parametros = [
            ':id_cir' => $this->id_cir,
            ':cor' => $this->cor,
            ':raio' => $this->raio,
            ':id_un' => $this->unidade->getIdUn()
        ];
        Database::executar($sql, $parametros);
    }

    public static function listar($tipo = 0, $busca = "") {
        $sql = "SELECT * FROM Circulo";
        $parametros = [];

        if ($tipo > 0) {
            switch($tipo) {
                case 1: $sql .= " WHERE id_cir = :busca"; break;
                case 2: $sql .= " WHERE raio LIKE :busca"; $busca = "%{$busca}%"; break;
                case 3: $sql .= " WHERE cor LIKE :busca"; $busca = "%{$busca}%"; break;
                case 4: $sql .= " WHERE id_un = :busca"; break;
            }
            $parametros = [':busca' => $busca];
        }

        $comando = Database::executar($sql, $parametros);
        $formas = [];

        while ($registro = $comando->fetch(PDO::FETCH_ASSOC)) {
            $unidade = new unidade($registro['id_un']); // Criar objeto Unidade
            $circulo = new Circulo($registro['id_cir'], $registro['raio'], $registro['cor'], $unidade);
            array_push($formas, $circulo);
        }
        return $formas;
    }

    public function DesenharCirculo() {
        return "<div style='display:block; width:{$this->raio}px; height:{$this->raio}px; background-color:{$this->cor}; border-radius:50%;'></div>";
    }
    public function calcularArea() {
        return $this->getRaio() * $this->getRaio();
    }

    public function calcularPerimetro() {
        return 4 * $this->getRaio();
    }
}
?>
