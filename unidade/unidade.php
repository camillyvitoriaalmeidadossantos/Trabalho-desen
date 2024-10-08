<?php

require_once("../classes/unidade.class.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $id_un =  isset($_POST['id_un'])?$_POST['id_un']:0; 
    $unidade =  isset($_POST['unidade'])?$_POST['unidade']:0; 
    $acao =  isset($_POST['acao'])?$_POST['acao']:0; 
    try{
        $unidade = new unidade($id_un,$unidade);
        if($acao == 'salvar'){
            if($id_un > 0)
                $unidade->alterar();
            else                     
                $unidade->incluir();
            
        }elseif ($acao == 'excluir'){
           $unidade->excluir();
        }
            header('location: index.php?MSG=Dados inseridos/Alterados com sucesso!');
    }catch(Exception $e){ 
        header('location: index.php?MSG='.$e->getMessage()); 
    }
}elseif($_SERVER['REQUEST_METHOD'] == 'GET'){ 
    $id_un =  isset($_GET['id_un'])?$_GET['id_un']:0;
    $msg =  isset($_GET['MSG'])?$_GET['MSG']:"";
    if ($id_un > 0){
        $unidade = unidade::listar(1,$id_un)[0]; 
    }
    $busca =  isset($_GET['busca'])?$_GET['busca']:0; 
    $tipo =  isset($_GET['tipo'])?$_GET['tipo']:0;
    $lista = unidade::listar($tipo,$busca); 
}
