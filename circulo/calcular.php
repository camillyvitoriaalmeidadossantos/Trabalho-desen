<?php
require_once("../classes/unidade.class.php");
require_once("../classes/Circulo.class.php");
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta e Cálculo de Círculo</title>
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
        <h1>Consulta de Círculo</h1>
        <?php
        $id_cir = isset($_GET['id_cir']) ? $_GET['id_cir'] : 0;
        if ($id_cir > 0) {
            $formas = Circulo::listar(1, $id_cir);
            if (!empty($formas)) {
                $forma = $formas[0];
                echo $forma->DesenharCirculo();
            } else {
                echo "<p>Circulo não encontrado.</p>";
            }
        }
        ?>
    </div>
    <div>
        <h2>Cálculo de Área e Perímetro</h2>
        <form method="post">
            <input type="hidden" name="raio" value="<?php echo isset($forma) ? $forma->getRaio() : 0; ?>">
            <input type="hidden" name="cor" value="<?php echo isset($forma) ? $forma->getCor() : '#000000'; ?>"> <!-- Adicionando o campo para cor -->
            <input type="submit" value="Calcular">
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
             $raio = isset($_POST['raio']) ? $_POST['raio'] : 0; 
             $cor = isset($_POST['cor']) ? $_POST['cor'] : '#000000'; 

            if ($raio <= 0) {
                echo "<p>Erro: Raio deve ser maior que zero!</p>";
            } else {
                $unidade = new unidade(1); 
                $circulo = new Circulo(0, $raio, $cor, $unidade);
                $area = $circulo->calcularArea();
                $perimetro = $circulo->calcularPerimetro();

                echo "<h1>Resultados do Círculo</h1>";
                echo "<p>Raio: " . $circulo->getRaio() . " " . $unidade->getUnidade() . "</p>";
                echo "<p>Área: " . $area = pow($raio, 2) * 3.14."</p>";
                echo "<p>Perímetro: ". $perimetro = 2 * 3.14 * $raio . "</p>";
            }
        }
        ?>
    </div>
</body>
</html>

