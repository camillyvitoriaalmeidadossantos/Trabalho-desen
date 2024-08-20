<?php

require_once("../classes/Quadrado.class.php");

// Esse trecho avalia se foi enviado um ID na requisição GET - nesse caso o sistema deve apresentar o formulário preenchido com os dados do contato para edição
 $id_quad = isset($_GET['id_quad']) ? $_GET['id_quad']:0; //pegando busca
 $msg = isset($_GET['msg']) ? $_GET['msg']:"";
 $lista = array();
    if($id_quad > 0){
        $formas = Quadrado::listar(1,$id_quad)[0]; 
    }
    
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $id_quad =  isset($_POST['id_quad']) ? $_POST['id_quad']:0; 
        $unidade =  isset($_POST['unidade']) ? $_POST['unidade']:0; 
        $lado =  isset($_POST['lado']) ? $_POST['lado']:0; 
        $cor =  isset($_POST['cor']) ? $_POST['cor']:""; 
        $acao =  isset($_POST['acao']) ? $_POST['acao']:0; 

    try{
        //$unidade = Unidade::listar(1,$unidade)[0];
        $quadrado = new Quadrado($id_quad,$lado,$cor, $unidade); //$unidade
        
    }catch(Exception $e){
        header('location: index.php:MSG=Erro:'.$e->getMessage());
    }
       
    $resultado = "";
    
            if($acao == 'salvar'){
                if($id_quad > 0) //alterando
            // chamar o método para alterar uma pessoa
                    $resultado = $quadrado->alterar();
                else //incluindo
            // chamar o método para incluir uma pessoa
                    $resultado = $quadrado->incluir();

            }elseif ($acao == 'excluir'){ //excluindo
            // chamar o método para exluir uma pessoa
                $resultado = $quadrado->excluir();
            }
                if($resultado)
                    header('location: index.php?MSG=Dados inseridos/Alterados com sucesso!');
                else
                    header('location: index.php?MSG=Erro ao inserir/Alterar registro');
                
            } elseif($_SERVER['REQUEST_METHOD'] == 'GET'){ 
             //  Listagem e Pesquisa
                $busca =  isset($_GET['busca']) ? $_GET['busca']:0; 
                $tipo =  isset($_GET['tipo']) ? $_GET['tipo']:0; // pegar tipo de busca  
                $lista = Quadrado::listar($tipo,$busca);
            }
?>