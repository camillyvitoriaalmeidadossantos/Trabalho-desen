<?php
require_once('../config/config.inc.php');

class Database{
    static public $lastId;

    /** Método para criar conexão com o banco de dados */
    public static function getInstance(){ 
        try{ 
            return new PDO(DSN, USUARIO, SENHA);
        }catch(PDOException $e){
            echo "Erro ao conectar ao banco de dados: ".$e->getMessage(); // ... e apresenta mensagem de erro para o usuário
        }
    }

    public static function conectar(){
        return Database::getInstance();
    }

    public static function preparar($conexao, $sql){
        return  $conexao->prepare($sql);
    }
    
    public static function vincular($comando,$parametros = array()){
        foreach($parametros as $key=>$value){
            $comando->bindValue($key,$value); 
        }
        return $comando;
    }

    public static function executar($sql,$parametros = array()){
        $conexao = self::conectar();
        //$conexao->beginTransaction();
        $comando = self::preparar($conexao,$sql);
        $comando = self::vincular($comando, $parametros);
        try {
            $comando->execute();
            self::$lastId = $conexao->lastInsertId();
            //$conexao->commit();
            return $comando;
        }catch(PDOException $e){
            //$conexao->rollBack();
            throw new Exception ("Erro ao executar o comando no banco de dados: "
               .$e->getMessage()." - ".$comando->errorInfo()[2]);
        }
    }

}
