<?php
require_once("../classes/Database.class.php");
class Unidade{
    // Atributos da classe - informações que a classe irá controlar/manter
    private $id_un; // atributos privados podem ser lidos e escritos somente pelos membros da classe, públicos pode ser manipulados por qualquer outro objeto/programa
    private $descr; 
   
    public function __construct($id_un = 0, $descr = "null"){
        $this->setIdUn($id_un); // chama os métodos da classe para definir os valores dos atributos, enviando os parâmetros recebidos no construtor, em vez de atribuir direto, assim passa pelas regras de negócio
        $this->setDescr($descr);
    }
    public function setIdUn($novoId){
        if ($novoId < 0)
            throw new Exception("Erro: id inválido!"); //dispara uma exceção
        else
            $this->id_un = $novoId;
    }
    // função que define (set) o valor de um atributo
    public function setDescr($novodescr){
        if ($novodescr == "")
            throw new Exception("Erro: Descrição inválida!");
        else
            $this->descr = $novodescr;
    }
    public function getIdUn(){ return $this->id_un;}
    public function getDescr() { return $this->descr;}

    /***
     * Inclui uma pessoa no banco  */     
    public function incluir(){
        // abrir conexão com o banco de dados
        $conexao = Database::getInstance(); // chama o método getInstance da classe Database de forma estática para abrir conexão com o banco de dados
        $sql = 'INSERT INTO Unidade (descr)
                     VALUES (:descr)';
        $formas = $conexao->prepare($sql);  // prepara o formas para executar no banco de dados
        $formas->bindValue(':descr',$this->descr); // vincula os valores com o formas do banco de dados
        return $formas->execute(); // executa o formas
    }    
    /** Método para excluir uma pessoa do banco de dados */
    public function excluir(){
        $conexao = Database::getInstance();
        $sql = 'DELETE 
                  FROM Unidade
                 WHERE id_un = :id_un';
        $formas = $conexao->prepare($sql); 
        $formas->bindValue(':id_un',$this->id_un);
        return $formas->execute();
    }  
    /**
     * Essa função altera os dados de uma pessoa no banco de dados
     */
    public function alterar(){
        $conexao = Database::getInstance();
        $sql = 'UPDATE Unidade 
                   SET descr = :descr
                 WHERE id_un = :id_un';
                 $formas = $conexao->prepare($sql); 
                 $formas->bindValue(':descr',$this->descr);
                 return $formas->execute();
        }    
    //** Método estático para listar pessoas - nesse caso não precisa criar um objeto Pessoa para poder chamar esse método */
    public static function listar($tipo = 0, $busca = "" ){
        $conexao = Database::getInstance();
        // montar consulta
        $sql = "SELECT * FROM Unidade";        
        if ($tipo > 0 )
            switch($tipo){
                case 1: $sql .= " WHERE id_un = :busca"; break;
                case 2: $sql .= " WHERE descr like :busca"; $busca = "%{$busca}%"; break;
            }

        // prepara o comando
        $formas = $conexao->prepare($sql); // preparar formas
        // vincular os parâmetros
        if ($tipo > 0 )
            $formas->bindValue(':busca',$busca);

        // executar consulta
        $formas->execute(); // executar formas
        $descr = array(); // cria um vetor para armazenar o resultado da busca
        // listar o resultado da consulta         
        while($registro = $formas->fetch()){
            $unidade = new Unidade($registro['id_un'],$registro['descr']); // cria um objeto pessoa com os dados que vem do banco
            array_push($descr,$unidade); // armazena no vetor pessoas
        }
        return $descr;  // retorna o vetor pessoas com uma coleção de objetos do tipo Pessoa
       
    }    
}

?>