<?php  
    session_start();
    include_once('triangulo.php'); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Triângulos</title>
</head>
<body>
    <h1>CRUD de Triângulos</h1>
    <h3><?=$msg?></h3>
    <form action="triangulo.php" method="post" enctype="multipart/form-data">
        <fieldset>
            <legend>Cadastro de Triângulos</legend>        
            <fieldset>
                <legend>Dados do Triângulos</legend>        
                    <label for="id_tri">Id:</label>
                    <input type="text" name="id_tri" id="id_tri" value="<?=isset($forma)?$forma->getIdTri():0 ?>" readonly>
                    <label for="ladoA">LadoA:</label>
                    <input type="text" name="ladoA" id="ladoA" value="<?php if(isset($forma)) echo $forma->getLadoA()?>">
                    <label for="ladoB">LadoB:</label>
                    <input type="text" name="ladoB" id="ladoB" value="<?php if(isset($forma)) echo $forma->getLadoB()?>">
                    <label for="ladoC">Lado:</label>
                    <input type="text" name="ladoC" id="ladoC" value="<?php if(isset($forma)) echo $forma->getLadoC()?>">
                    <label for="cor">cor:</label>
                    <input type="color" name="cor" id="cor" value="<?php if(isset($forma)) echo $forma->getCor()?>">                   
                    <label for="unidade">Unidade:</label>
                    <select name="unidade" id="unidade" required>
                <option value="">Selecione</option>
                <?php  
                    $unidades = unidade::listar();
                    foreach($unidades as $unidade){
                        $str = "<option value='{$unidade->getIdUn()}' ";
                            if(isset($forma)) 
                                if ($forma->getUnidade()->getIdUn() == $unidade->getIdUn()) 
                                    $str .= " selected ";
                            $str .= ">{$unidade->getUnidade()}</option>";
                            echo $str;
                    }
                ?>
            </select>
                    <label for="fundo">Imagem de Fundo:</label>
                    <input type="file" name="fundo" id="fundo">
                    <button type='submit' name='acao' value='salvar'>Salvar</button>
                    <button type='submit' name='acao' value='excluir'>Excluir</button>
                    <button type='reset'>Cancelar</button>
        </fieldset>
    </form>
    <hr>
</body>
</html>