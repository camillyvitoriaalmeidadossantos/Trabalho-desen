<?php  
    session_start();
    include_once('unidade.php'); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Unidades</title>
</head>
<body>
  
    <h3><?=$msg?></h3>
    <form action="unidade.php" method="POST" enctype="multipart/form-data">
        <fieldset>
            <legend>Cadastro de Unidades</legend>        
            <fieldset>     
            <label for="id_un">Id:</label>
            <input type="text" name="id_un" id="id_un" readonly value="<?=isset($unidade)?$unidade->getIdUn():0 ?>">
            <label for="unidade">Un:</label>
            <input type="text" name="unidade" id="unidade" value="<?=isset($unidade)?$unidade->getUnidade():'' ?>">
            <button type='submit' name='acao' value='salvar'>Salvar</button>
            <button type='submit' name='acao' value='excluir'>Excluir</button>
            <button type='reset'>Cancelar</button>
        </fieldset>
    </form>
    <hr>
</body>
</html>