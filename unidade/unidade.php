<?php
require_once("../classes/unidade.class.php");
// Esse trecho avalia se foi enviado um ID na requisição GET - nesse caso o sistema deve apresentar o formulário preenchido com os dados do contato para edição
    $id_un =  isset($_GET['id_un'])?$_GET['id_un']:0; // pegar busca
    $msg =  isset($_GET['MSG'])?$_GET['MSG']:""; // pegar busca

if ($id_un > 0){
    $formas = Unidade::listar(1,$id_un)[0]; // cria a variável contato que será utilizada para preencher o formulário quando o usuário clicar para alterar um registro
}

// Inserir e alterar dados
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $id_un =  isset($_POST['id_un'])?$_POST['id_un']:0; 
    $descr =  isset($_POST['descr'])?$_POST['descr']:""; 
    $acao =   isset($_POST['acao'])?$_POST['acao']: ""; 

    try{
        // criar o objeto Pessoa que irá persistir os dados 
        $unidade = new Unidade($id_un,$descr);
        $resultado = "";

    if($acao == 'salvar'){
        if($id_un > 0)//alterando
            // chamar o método para alterar uma pessoa
            $resultado = $unidade->alterar();
        else // inserindo                        
            // chamar o método para incluir uma pessoa
            $resultado = $unidade->incluir();
    }
    
        elseif ($acao == 'excluir'){
            
        $resultado = $unidade->excluir();
    }
     header("Location: index.php");
    } catch(Exception $e){ // caso ocorra algum erro na validação das regras de negócio dispara uma exceção
        header('location: index.php?MSG=Erro: '.$e->getMessage()); // direciona para o incio com a mensagem de erro
    }
    if ($resultado)
        header('location: index.php?MSG=Dados inseridos/Alterados com sucesso!');
    else
        header('location: index.php?MSG=Erro ao inserir/alterar registro');

}elseif($_SERVER['REQUEST_METHOD'] == 'GET'){ // se a requisição é 
    $busca =  isset($_GET['busca'])?$_GET['busca']:0; // pegar informação da busca
    $tipo =  isset($_GET['tipo'])?$_GET['tipo']:0; // pegar tipo de busca  
    $lista = Unidade::listar($tipo,$busca); 
}
?>
