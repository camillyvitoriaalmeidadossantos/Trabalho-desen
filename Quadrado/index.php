<?php 
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
    <h1>Crud</h1>
    <h3><?=$msg?></h3>
        <form action="quadrado.php" method="post">
        <fieldset>
            <legend>Cadastro</legend>
            <label for="id_quad">ID:</label>
            <input type="text" name="id_quad" id="id_quad" value="<?=isset($formas) ? $formas->getIdQuad():0 ?>" readonly>

            <label for="lado">Lado:</label>
            <input type="text" name="lado" id="lado" value="<?php if(isset($formas)) echo $formas->getLado()?>" >

            <label for="unidade">Unidade de Medida:</label>
            <input type="text" name="unidade" id="unidade" value="<?php if(isset($formas)) echo $formas->getUnidade()?>">
            <!-- <select name="unidade" id="unidade"> -->
                <!-- <option value="0">Selecione</option> -->
                <?php
                        // $uns = Unidade::listar(0); //chamando o metodo listar
                        //     foreach($unidades as $unidade){
                        //         $str = "<option selected value='{$unidade->getId()}>'";
                        //             if(isset($formas))
                        //                 if($formas->getUnidade()->getId() == $unidade->getId())
                        //     $str .= "selected";
                        //     $str .= "{$unidade->getUnidade()}</option>";
                        //         echo $str;
                        //     }
                    ?>
            <!-- </select> -->
            <label for="cor">Cor:</label>
            <input type="color" name="cor" id="cor" value="<?php if(isset($formas)) echo $formas->getCor()?>">

            <button type='submit' name='acao' value='salvar'>Salvar</button>
            <button type='submit' name='acao' value='excluir'>Excluir</button>
            <button type='reset'>Cancelar</button>
        </fieldset>    
        </form>    
    <hr>
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
                            <option value="2">Unidade</option>
                            <option value="3">Lado</option>
                            <option value="4">Cor</option>
                         </select>

                    <button type='submit'>Buscar</button>
            </fieldset>
        </form>
        <hr>
            <h1>Quadrado</h1>
            <table>
                <tr>
                    <th>Id</th>
                    <th>Unidade</th>
                    <th>Lado</th>
                    <th>Cor</th>
                    <th>Desenhar</th>
                </tr>
    <?php
        if(isset($lista)){
            foreach($lista as $quadrado){
                // var_dump($quadrado);
    ?>
        <tr>
            <td><a href="index.php?id_quad=<?=$quadrado->getIdQuad() ?>"><?= $quadrado->getIdQuad()?></a></td>
            <td><?= $quadrado->getUnidade() ?></td> 
            <td><?= $quadrado->getLado() ?></td>
            <td><?= $quadrado->getCor() ?></td>
            <!-- <td><?= $quadrado->Desenhar() ?></td>  -->
        </tr>
    <?php
            }
        }
    ?>
    </table>
</body>
</html>