<?php  
    session_start();
    include_once('circulo.php'); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Circulos</title>
</head>
<body>
    <h1>CRUD de Círculos</h1>
    <h3><?=$msg?></h3>
    <form action="circulo.php" method="post" enctype="multipart/form-data">
        <fieldset>
            <legend>Cadastro de Círculos</legend>        
            <fieldset>
                <legend>Dados do Círculo</legend>        
                    <label for="id_cir">Id:</label>
                    <input type="text" name="id_cir" id="id_cir" value="<?=isset($forma)?$forma->getIdCir():0 ?>" readonly>
                    <label for="raio">Raio:</label>
                    <input type="text" name="raio" id="raio" value="<?php if(isset($forma)) echo $forma->getRaio()?>">
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