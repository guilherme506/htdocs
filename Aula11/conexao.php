<?php
$host = "localhost"; 
$user = "root";
$password = "";
$dbname = "matricula";

$dsn = "mysq:host=$host;dbname=$dbname;charset=utf8mb4";
$options = [
  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false, ];
try
{
    $pdo = new PDO($dsn, $user, $password, $options);
    echo "conexão estabelcida";

    $sql = "INSERT INTO cidade(cod_cidade,des_nome, sig_uf) VALUES ('$cod_cidade','$des_nome','$sig_uf')";
    $pstm = PDO->prepare($sql);
    $pstm->execute([
        'cod_cidade'=> 8,
        'des_nome'=>'joao da silva',
        'sig_uf'=>'endgit'
    ]);
    echo $pstm->rowcount().

    $stm = $pdo->query("SELECT aluno, endereco, cidade from matricula");
    while ($linha = $stm->fetch(PDO::FETCH_ASSOC)) {
        echo "Nome: ".$linha['aluno'].", e-mail: "
        . $linha['e-mail'];
    }
}
catch(\PDOException $e){
    throw new \PDOException($e->getMessage(),
   (int)$e->getCode()); }

?>  