<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            display: flex; 
            flex-direction: column;
            align-items: center; 
            margin: 0; 
            padding: 70px; 
            text-align: center; 
        }
        h1 {
            color: black; 
            margin-bottom: 15px; 
        }
        .formas {
            display: flex; 
            justify-content: center; 
            margin-top: -10px;
        }
        .fil {
            display: inline-block; 
            width: 250px; 
            border: 2px solid pink; 
            padding: 10px; 
            margin: 10px;
            vertical-align: top; 
        }
        .filtri {
            display: inline-block; 
            width: 230px; 
            border: 2px solid pink; 
            padding: 24px; 
            margin: 10px; 
            vertical-align: top; 
        }
        .circulo {
            width: 200px; 
            height: 200px; 
            background-color: pink; 
            border-radius: 50%; 
            margin: 10px auto; 
        }
        .quadrado {
            width: 200px; 
            height: 200px;
            background-color: pink; 
            margin: 10px auto;
        }
        .triangulo {
            width: 0;
            height: 0;
            border-left: 100px solid transparent; 
            border-right: 100px solid transparent; 
            border-bottom: 173.21px solid pink;
            margin: 10px auto; 
        }
    </style>
</head>
<body>
    <h1>Formas</h1>
    <form action="" method="get">
      <div class="formas">
          <fieldset class="fil">
            <a href="circulo/index.php">Círculo</a>
            <div class="circulo"></div> 
          </fieldset>
          <fieldset class="fil">
            <a href="quadrado/index.php">Quadrado</a>
            <div class="quadrado"></div> 
          </fieldset>
          <fieldset class="filtri">
            <a href="triangulo/index.php">Triângulo</a>
            <div class="triangulo"></div> 
          </fieldset>
      </div>
      <fieldset class="fil">
        <a href="unidade/index.php">Unidade</a>
      </fieldset>
    </form>
</body>
</html>
