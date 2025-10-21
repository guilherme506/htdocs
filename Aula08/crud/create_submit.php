
<?php
include 'conexao.php'; // Traz o script

$prinome = $conn->real_escape_string(
    $_POST['priNome']); 
$ultnome = $conn->real_escape_string(
    $_POST['ultNome']);
$cpf = $conn->real_escape_string(
    $_POST['cpf']);

$sql = "INSERT INTO aluno (cpf, prinome, ultnome) VALUES ('$cpf', '$prinome', '$ultnome')";    
if (!$conn->query($sql)) {
    echo "Erro: " . $conn->error;
} else {
    echo "Aluno cadastrado com sucesso!";
    header('Location: report.php');
    exit();
}
$conn->close();
?>