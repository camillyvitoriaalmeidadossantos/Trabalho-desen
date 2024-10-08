<?php
    session_start();
    include_once('quadrado.php');
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quadrado</title>
</head>
<body>
    <h1>Crud do Quadrado</h1>
    <h3><?= $msg ?></h3>
    <a href="cadastro.php">Novo</a>

    <form action="" method="get">
        <fieldset>
            <legend>Pesquisa</legend>
            <label for="busca">Busca:</label>
            <input type="text" name="busca" id="busca" value="">
            <label for="tipo">Tipo:</label>
            <select name="tipo" id="tipo">
                <option value="0">Escolha</option>
                <option value="1">Id</option>
                <option value="2">Lado</option>
                <option value="3">Cor</option>
                <option value="4">Unidade</option>
            </select>
            <button type='submit'>Buscar</button>
        </fieldset>
    </form>
    <hr>
    <h1>Lista meus contatos</h1>
    <table>
        <tr>
            <th>Id</th>
            <th>Tamanho</th>
            <th>Cor</th>
            <th>Un</th>
            <th>Alterar</th>
        </tr>

        <?php
        if (!empty($lista)) {
            foreach($lista as $forma) {
                echo "<tr>
                        <td>{$forma->getIdQuad()}</td>
                        <td>{$forma->getLado()}</td>
                        <td>{$forma->getCor()}</td>
                        <td>{$forma->getUnidade()->getUnidade()}</td>
                        <td>
                            <a href='calcular.php?id_quad={$forma->getIdQuad()}&lado={$forma->getLado()}'>Visualizar</a> |
                            <a href='cadastro.php?id_quad={$forma->getIdQuad()}'>Editar</a>
                        </td>
                    </tr>";
            }
        } 
        ?>
    </table>
</body>
</html>
