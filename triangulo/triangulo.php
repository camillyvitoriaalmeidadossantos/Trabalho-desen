<?php
require_once("../classes/triangulo1.class.php");
require_once("../classes/unidade.class.php");
    
    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $id_tri =  isset($_POST['id_tri']) ? $_POST['id_tri']:0; 
        $ladoA =  isset($_POST['ladoA']) ? $_POST['ladoA']:0; 
        $ladoB =  isset($_POST['ladoB']) ? $_POST['ladoB']:0; 
        $ladoC =  isset($_POST['ladoC']) ? $_POST['ladoC']:0; 
        $cor =  isset($_POST['cor']) ? $_POST['cor']:""; 
        $unidade =  isset($_POST['unidade']) ? $_POST['unidade']:0; 
        $arquivo = isset($_FILES['fundo'])?$_FILES['fundo']:"";
        $acao =  isset($_POST['acao']) ? $_POST['acao']:0; 
        $destino = "../".IMG."/".$arquivo['name'];
    
    try{
        $unidade = unidade::listar(1,$unidade)[0];
        $triangulo = new Triangulo($id_tri,$ladoA, $ladoB, $ladoC,$cor, $unidade, $destino);
        
    $resultado = "";
            if($acao == 'salvar'){
                if($id_tri > 0) 
                $resultado = $triangulo->alterar();
            else 
                $resultado = $triangulo->incluir();

            }elseif ($acao == 'excluir'){ 
                $resultado = $triangulo->excluir();
            }
            $_SESSION['MSG'] = "Dados inseridos/Alterados com sucesso!";
            move_uploaded_file($arquivo['tmp_name'],$destino);
        
        }catch(Exception $e){ 
            $_SESSION['MSG'] = $e->getMessage();
    
        }finally{
            header('location: index.php');
       }
         }elseif($_SERVER['REQUEST_METHOD'] == 'GET'){ 
            $id_tri =  isset($_GET['id_tri'])?$_GET['id_tri']:0; 
            $msg = (isset($_SESSION['MSG'])?$_SESSION['MSG']:"");
            if ($msg != ""){
                echo "<h2>{$msg}</h2>";
            }
   
            if ($id_tri > 0){
                $forma = Triangulo::listar(1,$id_tri)[0];                                          
            }  
                $busca =  isset($_GET['busca']) ? $_GET['busca']:0; 
                $tipo =  isset($_GET['tipo']) ? $_GET['tipo']:0; 
                $lista = Triangulo::listar($tipo,$busca);
            }
?>