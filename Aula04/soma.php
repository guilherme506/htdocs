<link rel="stylesheet" href="style.css">
<?php
isset($_POST["n1"]);
isset($_POST["n2"]);
$num1 = floatval($_POST["n1"]);
$num2 = floatval($_POST["n2"]);
$_resultado = $num1 + $num2;
echo "A soma dos numeros " .$num1 ." e " .$num2. " deu: " . $_resultado;