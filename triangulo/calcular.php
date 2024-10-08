<?php
require_once("../classes/unidade.class.php");
require_once("../classes/triangulo1.class.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta e Cálculo do Triângulo</title>
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
        <h1>Consulta de Triângulo</h1>
        <?php
        $id_tri = isset($_GET['id_tri']) ? $_GET['id_tri'] : 0;
        if ($id_tri > 0) {
            $formas = Triangulo::listar(1, $id_tri);
            if (!empty($formas)) {
                $forma = $formas[0];
                echo $forma->DesenharTriangulo();
            } else {
                echo "<p>Triângulo não encontrado.</p>";
            }
        }
        ?>
    </div>
    <div>
        <h2>Cálculo de Área e Perímetro</h2>
        <form method="post">
            <input type="hidden" name="ladoA" value="<?php echo isset($forma) ? $forma->getLadoA() : 0; ?>">
            <input type="hidden" name="ladoB" value="<?php echo isset($forma) ? $forma->getLadoB() : 0; ?>">
            <input type="hidden" name="ladoC" value="<?php echo isset($forma) ? $forma->getLadoC() : 0; ?>">
            <input type="submit" value="Calcular">
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $ladoA = isset($_POST['ladoA']) ? $_POST['ladoA'] : 0;
            $ladoB = isset($_POST['ladoB']) ? $_POST['ladoB'] : 0;
            $ladoC = isset($_POST['ladoC']) ? $_POST['ladoC'] : 0;
            $cor = isset($_POST['cor']) ? $_POST['cor'] : '#000000'; 

            
            if ($ladoA <= 0 && $ladoB <= 0 && $ladoC <= 0) {
                echo "<p>Erro: LadoA deve ser maior que zero!</p>";
            }else {
                $unidade = new unidade(1); 

                $triangulo = new Triangulo(0, $ladoA, $ladoB, $ladoC, $cor, $unidade );

                $area = $triangulo->calcularArea();
                $perimetro = $triangulo->calcularPerimetro();
                echo "<h1>Resultados do Triângulo</h1>";
                echo "<p>LadoA: " . $ladoA . " " . $unidade->getUnidade()."</p>";
                echo "<p>LadoB: " . $ladoB . " " . $unidade->getUnidade()."</p>";
                echo "<p>LadoC: " . $ladoC . " " . $unidade->getUnidade()."</p>";
                echo "<p>Área: " . $area . " " . $unidade->getUnidade()."</p>";
                echo "<p>Perímetro: " . $perimetro . " " . $unidade->getUnidade()."</p>";
            }
        }
        ?>
    </div>
</body>
</html>
