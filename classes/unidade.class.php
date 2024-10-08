<?php
require_once("../classes/Database.class.php");

class unidade {
    private $id_un;
    private $unidade;

    // Construtor
    public function __construct($id_un = 0, $unidade = "null") {
        $this->setIdUn($id_un);
        $this->setUnidade($unidade); 
    }

    // Setters
    public function setIdUn($novoIdUn) {
        if ($novoIdUn < 0) {
            throw new Exception("Erro: id inválido!");
        } else {
            $this->id_un = $novoIdUn;
        }
    }

    public function setUnidade($novoUnidade) {
        if ($novoUnidade === "" || is_null($novoUnidade)) {
            throw new Exception("Erro: Unidade inválida!");
        } else {
            $this->unidade = $novoUnidade;
        }
    }

    
    public function getIdUn() { 
        return $this->id_un;
    }

    public function getUnidade() { 
        return $this->unidade;
    }

   
    public function incluir() {
        $sql = 'INSERT INTO unidade (unidade) VALUES (:unidade)';
        $parametros = array(':unidade' => $this->getUnidade());
        Database::executar($sql, $parametros);
    }

    public function excluir() {
        $sql = 'DELETE 
                FROM unidade 
                WHERE id_un = :id_un';
        $parametros = array(':id_un' => $this->getIdUn());
        return Database::executar($sql, $parametros);
    }

    public function alterar() {
        $sql = 'UPDATE unidade SET unidade = :unidade WHERE id_un = :id_un';
        $parametros = array(
            ':id_un' => $this->getIdUn(),
            ':unidade' => $this->getUnidade()
        );
        Database::executar($sql, $parametros);
        return true;
    }

    public static function listar($tipo = 0, $busca = "") {
        $sql = "SELECT * FROM unidade";
        $parametros = array();

        if ($tipo > 0) {
            switch ($tipo) {
                case 1:
                    $sql .= " WHERE id_un = :busca";
                    $parametros = array(':busca' => $busca);
                    break;
                case 2:
                    $sql .= " WHERE unidade LIKE :busca";
                    $busca = "%{$busca}%";
                    $parametros = array(':busca' => $busca);
                    break;
            }
        }

        $comando = Database::executar($sql, $parametros);
        $unidades = array();
        
        while ($registro = $comando->fetch(PDO::FETCH_ASSOC)) {
            if (isset($registro['unidade'])) {
                if (!is_null($registro['unidade']) && $registro['unidade'] !== "") {
                    $unidade = new unidade($registro['id_un'], $registro['unidade']);
                    array_push($unidades, $unidade);
                } else {
                    throw new Exception("Erro: Campo 'unidade' não pode ser nulo ou vazio.");
                }
            } else {
                throw new Exception("Erro: Campo 'unidade' não encontrado no banco de dados.");
            }
        }
        return $unidades;
    }
}
?>
