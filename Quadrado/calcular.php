<?php
require_once("../classes/unidade.class.php");
require_once("../classes/Quadrado.class.php");
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta e Cálculo de Quadrado</title>
    <style>
        .modal {
            width: 1024px;
            height: 1024px;
            border: 1px solid #ccc;
            padding: 20px;
            margin: 20px auto;
        }
    </style>
</head>
<body>
    <div class="modal">
        <h1>Consulta de Quadrado</h1>
        <?php
        $id_quad = isset($_GET['id_quad']) ? $_GET['id_quad'] : 0;
        if ($id_quad > 0) {
            $formas = Quadrado::listar(1, $id_quad);
            if (!empty($formas)) {
                $forma = $formas[0];
                echo $forma->Desenhar();
            } else {
                echo "<p>Quadrado não encontrado.</p>";
            }
        }
        ?>
    </div>
    <div>
        <h2>Cálculo de Área e Perímetro</h2>
        <form method="post">
            <input type="hidden" name="lado" value="<?php echo isset($forma) ? $forma->getLado() : 0; ?>">
            <input type="hidden" name="cor" value="<?php echo isset($forma) ? $forma->getCor() : '#000000'; ?>"> <!-- Adicionando o campo para cor -->
            <input type="submit" value="Calcular">
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $lado = isset($_POST['lado']) ? $_POST['lado'] : 0; 
             $cor = isset($_POST['cor']) ? $_POST['cor'] : '#000000';

            if ($lado <= 0) {
                echo "<p>Erro: Lado deve ser maior que zero!</p>";
            } else {
                $unidade = new unidade(1); 
                $quadrado = new Quadrado(0, $lado, $cor, $unidade);

                $area = $quadrado->calcularArea();
                $perimetro = $quadrado->calcularPerimetro();
                echo "<h1>Resultados do Quadrado</h1>";
                echo "<p>Lado: " . $lado . " " . $unidade->getUnidade() . "</p>";
                echo "<p>Área: " . $area . " " . $unidade->getUnidade() . "</p>";
                echo "<p>Perímetro: " . $perimetro . " " . $unidade->getUnidade() . "</p>";
            }
        }
        ?>
    </div>
</body>
</html>
