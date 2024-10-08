<?php
require_once("../classes/Quadrado.class.php");
require_once("../classes/unidade.class.php");
    
    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $id_quad =  isset($_POST['id_quad']) ? $_POST['id_quad']:0; 
        $lado =  isset($_POST['lado']) ? $_POST['lado']:0; 
        $cor =  isset($_POST['cor']) ? $_POST['cor']:""; 
        $unidade =  isset($_POST['unidade']) ? $_POST['unidade']:0; 
        $arquivo = isset($_FILES['fundo'])?$_FILES['fundo']:"";
        $acao =  isset($_POST['acao']) ? $_POST['acao']:0; 
        $destino = "../".IMG."/".$arquivo['name'];
    
    try{
        $unidade = unidade::listar(1,$unidade)[0];
        $quadrado = new Quadrado($id_quad,$lado,$cor, $unidade, $destino);
        
    $resultado = "";
            if($acao == 'salvar'){
                if($id_quad > 0) 
                $resultado = $quadrado->alterar();
            else 
                $resultado = $quadrado->incluir();

            }elseif ($acao == 'excluir'){ 
                $resultado = $quadrado->excluir();
            }
            $_SESSION['MSG'] = "Dados inseridos/Alterados com sucesso!";
            move_uploaded_file($arquivo['tmp_name'],$destino);
        
        }catch(Exception $e){ 
            $_SESSION['MSG'] = $e->getMessage();
    
        }finally{
            header('location: index.php');
       }
         }elseif($_SERVER['REQUEST_METHOD'] == 'GET'){ 
            $id_quad =  isset($_GET['id_quad'])?$_GET['id_quad']:0; 
            $msg = (isset($_SESSION['MSG'])?$_SESSION['MSG']:"");
            if ($msg != ""){
                echo "<h2>{$msg}</h2>";
                unset($_SESSION['MSG']);
            }
   
            if ($id_quad > 0){
                $forma = Quadrado::listar(1,$id_quad)[0];                                          
            }
            
                $busca =  isset($_GET['busca']) ? $_GET['busca']:0; 
                $tipo =  isset($_GET['tipo']) ? $_GET['tipo']:0; 
                $lista = Quadrado::listar($tipo,$busca);
            }
?>