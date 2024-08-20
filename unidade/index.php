<!DOCTYPE html>
<?php
    include_once('unidade.php')
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="unidade.php" method="post">
        <label for="id_un">Id:</label>
        <input type="text" name="id_un" id="id_un" >

        <label for="descr">Descrição:</label>
        <input type="text" name="descr" id="descr">

        <button type='submit' name='acao' value='salvar'>Salvar</button>
        <button type='submit' name='acao' value='excluir'>Excluir</button>
    </form>
</body>
</html>
