<?php  
session_start();
include_once('unidade.php'); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Unidade de Medida</title>
</head>
<body>
    <h1>Cadastro de Unidade de Medida</h1>
    <form action="unidade.php" method="POST">
        <label for="id_un">Id:</label>
        <input type="text" name="id_un" id="id_un" readonly value="<?=isset($unidade)?$unidade->getIdUn():0 ?>">
        <label for="unidade">Un:</label>
        <input type="text" name="unidade" id="unidade" value="<?=isset($unidade)?$unidade->getUnidade():'' ?>">
        <button type='submit' name='acao' value='salvar'>Salvar</button>
        <button type='submit' name='acao' value='excluir'>Excluir</button>
        <button type='reset'>Cancelar</button>
    </form>

   <form action="" method="get">
        <fieldset>
            <legend>Pesquisa</legend>
            <label for="busca">Busca:</label>
            <input type="text" name="busca" id="busca" value="">
            <label for="tipo">Tipo:</label>
            <select name="tipo" id="tipo">
                <option value="">Escolha</option>
                <option value="1">Id</option>
                <option value="2">Unidade</option>
            </select>
            <button type='submit'>Buscar</button>
   
        </fieldset>
    </form>
    <hr>
    <h1>Lista meus contatos</h1>
    <table>
        <tr>
            <th>Id</th>
            <th>Unidade</th>
        </tr>
        <?php  
            foreach($lista as $unidade){ 
                echo "<tr>
                          <td><a href='index.php?id=".$unidade->getIdUn()."'>".$unidade->getIdUn()."</a></td>
                          <td>{$unidade->getUnidade()}</td>
                      </tr>";
            }     
        ?>
    </table>
</body>
</html>