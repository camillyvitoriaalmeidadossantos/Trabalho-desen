<?php
require_once('../config/config.inc.php');
class Database{
    public static function getInstance(){ 
        try{ 
            return new PDO(DSN, USUARIO, SENHA);
        }catch(PDOException $e){  
            echo "Erro ao conectar ao banco de dados: ".$e->getMessage(); 
        }
    }
}