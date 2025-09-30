
<?php
echo "Bem vindo " . $_POST["nome"]. "<br>";
$_IDADE10 = intval($_POST["idade"]);
$_IDADE10 += 10;
echo "Daqui a 10 anos você tera:  " . $_IDADE10;