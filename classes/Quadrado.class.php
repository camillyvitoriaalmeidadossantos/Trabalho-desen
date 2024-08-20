<?php
    require_once("../classes/Database.class.php");
    class Quadrado{
        private $id_quad; // atributos privados podem ser lidos e escritos somente pelos membros da classe, públicos pode ser manipulados por qualquer outro objeto/programa
        private $unidade;
        private $lado;
        private $cor;

    // chama os métodos da classe para definir os valores dos atributos,
    // enviando os parâmetros recebidos no construtor,
    // em vez de atribuir direto, assim passa pelas regras de negócio
    public function __construct($id_quad = 0, $lado = 0, $cor = "", $unidade = 0){ 
        $this->setIdQuad($id_quad);
        $this->setUnidade($unidade);
        $this->setLado($lado); 
        $this->setCor($cor);
    }
    public function setIdQuad($novoIdQuad){ 
        if($novoIdQuad < 0) // se o id quadrado for < 0 executa o erro.
            throw new Exception("Erro: if inválido!");
        else
            $this->id_quad = $novoIdQuad; // se não der erro o atributo recebe id quad
    }
    public function setUnidade($novoUnidade){
        if ($novoUnidade == "")
            throw new Exception("Erro: Unidade inválida!");
        else
            $this->unidade = $novoUnidade;
    }
    public function setLado($novoLado){
        if ($novoLado == "")
            throw new Exception("Erro: Lado inválido!");
        else
            $this->lado = $novoLado;
    }
    public function setCor($novoCor){
        if ($novoCor == "")
            throw new Exception("Erro: Cor inválido!");
        else
            $this->cor = $novoCor;
    }
    
    // função para ler (get) o valor de um atributo da classe
    public function getIdQuad() { return $this->id_quad;}
    public function getUnidade() { return $this->unidade;}
    public function getLado() { return $this->lado;}
    public function getCor() { return $this->cor;}


    //   Inclui uma pessoa no banco      
    public function incluir(){ 
        // abrir conexão com o banco de dados
    $conexao = Database::getInstance(); // chama o método getInstance da classe Database de forma estática para abrir conexão com o banco de dados
    $sql = 'INSERT INTO Quadrado (cor, lado, id_un)   
                    VALUES (:cor, :lado, :id_un)';
    $comando = $conexao->prepare($sql);  // prepara o comando para executar no banco de dados
    $comando->bindValue(':cor',$this->cor); 
    $comando->bindValue(':lado',$this->lado);
    $comando->bindValue(':id_un',$this->unidade);
    $comando->execute();// executa o comando
    return true;
    }    
    // public function incluir(){
    //     $sql = 'INSERT INTO Quadrado (unidade, lado, cor)
    //             VALUES (:unidade, :lado, :cor)';
    //     $parametros = [
    //         //':unidade',$this->unidade,
    //         ':lado',$this->lado,
    //         ':cor',$this->cor
    //     ];
    //     Database::incluir($sql, $parametros);
    // }
    public function excluir(){
        $conexao = Database::getInstance();
        $sql = 'DELETE 
                  FROM Quadrado
                 WHERE id_quad = :id_quad';
        $comando = $conexao->prepare($sql); 
        $comando->bindValue(':id_quad',$this->id_quad);
        return $comando->execute();
    }  
    public function alterar(){ //metodo
        $conexao = Database::getInstance();
        $sql = 'UPDATE Quadrado 
                   SET cor = :cor, lado = :lado, id_un = :id_un
                 WHERE id_quad = :id_quad';
        $comando = $conexao->prepare($sql); // recebendo a preparaçao
        $comando->bindValue(':id_quad',$this->id_quad);
        $comando->bindValue(':cor',$this->cor);
        $comando->bindValue(':lado',$this->lado);
        $comando->bindValue(':id_un',$this->unidade);
        $comando->execute();
        return true;
    }    

    //** Método estático para listar pessoas - nesse caso não precisa criar um objeto Pessoa para poder chamar esse método */
    public static function listar($tipo = 0, $busca = "" ){
        $conexao = Database::getInstance();
        $sql = "SELECT * FROM Quadrado";        
        if ($tipo > 0 )
            switch($tipo){
                case 1: $sql .= " WHERE id_quad = :busca"; break;
                case 2: $sql .= " WHERE lado like :busca";  $busca = "%{$busca}%";  break;
                case 3: $sql .= " WHERE cor like :busca";  $busca = "%{$busca}%";  break;
                case 4: $sql .= " WHERE id_un like :busca";  $busca = "%{$busca}%";  break;
            }

        $comando = $conexao->prepare($sql); // preparar comando         
        if ($tipo > 0 )
            $comando->bindValue(':busca',$busca); // vincular os parâmetros
        $comando->execute(); // executar comando
        $quadrados = []; // cria um vetor para armazenar o resultado da busca            
        while($registro = $comando->fetch()){   // listar o resultado da consulta    
            $quadrado = new Quadrado($registro['id_quad'],$registro['lado'],$registro['cor'],$registro['id_un']); // cria um objeto quadrado com os dados que vem do banco
            array_push($quadrados,$quadrado); // armazena no vetor quadrados
            // echo "<pre>";
            // var_dump($registro);
        }
        return $quadrados;  // retorna o vetor quadrados com uma coleção de objetos do tipo Pessoa
    } 

    // $parametros = array();
    //     if ($tipo > 0)
    // $parametros = array(':busca',$busca); 
    //     $comando = Database::executar($sql, $parametros);
    //     $formas = array(); 
    // while($registro = $comando->fetch(PDO::FETCH_ASSOC)){
    //     $quadrado = new Quadrado($registro['id'],$registro['lado'],$registro['cor']); 
    //         array_push($formas,$quadrado); 
    //     }
    //     return $formas; 

    public function Desenhar(){
        return "<div class='index.php' style='display:block; width:{$this->getLado()},{$this->getCor()},{$this->getUnidade()}
        height:{$this->getLado()},{$this->getUnidade()}, background-color:{$this->getCor()}</div>";
    } 
}
?>