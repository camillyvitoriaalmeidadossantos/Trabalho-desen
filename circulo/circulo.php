<?php
require_once("../classes/Circulo.class.php");
require_once("../classes/unidade.class.php");
    
    if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $id_cir =  isset($_POST['id_cir']) ? $_POST['id_cir']:0; 
    $raio =  isset($_POST['raio']) ? $_POST['raio']:0; 
    $cor =  isset($_POST['cor']) ? $_POST['cor']:""; 
    $unidade =  isset($_POST['unidade']) ? $_POST['unidade']:0; 
    $arquivo = isset($_FILES['fundo'])?$_FILES['fundo']:"";
    $acao =  isset($_POST['acao']) ? $_POST['acao']:0; 
    $destino = "../".IMG."/".$arquivo['name'];

    
    try{
        $unidade = unidade::listar(1,$unidade)[0];
        $circulo = new Circulo($id_cir,$raio,$cor, $unidade, $destino); 
        
    $resultado = "";
            if($acao == 'salvar'){
                if($id_cir > 0) 
                $resultado = $circulo->alterar();
            else 
                $resultado = $circulo->incluir();

            }elseif ($acao == 'excluir'){ 
                $resultado = $circulo->excluir();
            }
            $_SESSION['MSG'] = "Dados inseridos/Alterados com sucesso!";
            move_uploaded_file($arquivo['tmp_name'],$destino);
        
        }catch(Exception $e){ 
            $_SESSION['MSG'] = $e->getMessage();
    
        }finally{
            header('location: index.php');
       }
         }elseif($_SERVER['REQUEST_METHOD'] == 'GET'){ 
            $id_cir =  isset($_GET['id_cir'])?$_GET['id_cir']:0; 
            $msg = (isset($_SESSION['MSG'])?$_SESSION['MSG']:"");
            if ($msg != ""){
                echo "<h2>{$msg}</h2>";
                unset($_SESSION['MSG']);
            }
   
            if ($id_cir > 0){
                $forma = Circulo::listar(1,$id_cir)[0];                                          
            }
            
                $busca =  isset($_GET['busca']) ? $_GET['busca']:0; 
                $tipo =  isset($_GET['tipo']) ? $_GET['tipo']:0; 
                $lista = Circulo::listar($tipo,$busca);
            }
?>