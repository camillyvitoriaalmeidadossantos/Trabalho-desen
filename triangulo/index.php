<?php
    session_start();
    include_once('triangulo.php');
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Triângulo</title>
</head>
<body>
    <h1>Crud do Triângulo</h1>
    <h3><?= $msg ?></h3>
    <a href="./cadastrotri.php">Novo</a>

    <!-- Formulário de pesquisa -->
    <form action="" method="get">
        <fieldset>
            <legend>Pesquisa</legend>
            <label for="busca">Busca:</label>
            <input type="text" name="busca" id="busca" value="">
            <label for="tipo">Tipo:</label>
            <select name="tipo" id="tipo">
                <option value="0">Escolha</option>
                <option value="1">Id</option>
                <option value="2">LadoA</option>
                <option value="3">LadoB</option>
                <option value="4">LadoC</option>
                <option value="5">Cor</option>
                <!-- <option value="4">Unidade</option> -->
            </select>
            <button type='submit'>Buscar</button>
        </fieldset>
    </form>
    <hr>
    <h1>Lista meus contatos</h1>
    <table>
        <tr>
            <th>Id</th>
            <th>LadoA</th>
            <th>LadoB</th>
            <th>LadoC</th>
            <!-- <th>Tamanho</th> -->
            <th>Cor</th>
            <th>Un</th>
            <th>Alterar</th>
        </tr>

        <?php
        if (!empty($lista)) {
            foreach($lista as $forma) {
                echo "<tr>
        <td>{$forma->getIdTri()}</td>
        <td>{$forma->getLadoA()}</td>
        <td>{$forma->getLadoB()}</td>
        <td>{$forma->getLadoC()}</td>
        <td>{$forma->getCor()}</td>
        <td>{$forma->getUnidade()->getUnidade()}</td>
        <td>
            <a href='calcular.php?id_tri={$forma->getIdTri()}&ladoA={$forma->getLadoA()}&ladoB={$forma->getLadoB()}&ladoC={$forma->getLadoC()}'>Visualizar</a> |
            <a href='cadastrotri.php?id_tri={$forma->getIdTri()}'>Editar</a>
        </td>
    </tr>";
            }
        } 
        ?>
    </table>
</body>
</html>
