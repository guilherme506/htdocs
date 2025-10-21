<!DOCTYPE html>
<html>
<head>
    <title>CRUD de Alunos</title>
</head>
<body>

<?php
include 'conexao.php'; // Traz o script

$sql = "SELECT cpf, priNome, ultNome FROM aluno";
if ($result = $conn->query($sql)) {
    echo "<table>";
    // Cabeçalho
    echo " <tr>";
    echo "  <th>CPF</th>";
    echo "  <th>Nome</th>";
    echo "  <th>Ação</th>";
    echo " </tr>";
    // Detalhes
    while ($row = $result->fetch_assoc()) {
        echo " <tr>";
        echo "  <td>" . $row['cpf'] . "</td>";
        echo "  <td>" . $row['priNome'] . " " . $row['ultNome'] . "</td>";
        echo "  <td>";
        echo "   <a href='update.php?cpf=" . $row['cpf'] . "'>Mod.</a>";
        echo "   <a href='delete.php?cpf=" . $row['cpf'] . "'>Del.</a>";
        echo "  </td>";
        echo " </tr>";
    }
    echo "</table>";
} else {
    echo "<h2>Sem Registros no Momento</h2>";
}
$conn->close();
?>
<a href="create.php">Cadastrar Aluno</a>

</body>    
</html>