<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
include 'conexao.php';

$cpf = $conn->real_escape_string($_GET["cpf"]);

$sq = "SELECT cpf, prinome,ultnome from aluno where cpf = '$cpf'";

$result = $conn->query($sql);
if ($result->num_rows == 1 ){
    $aluno = $result->fetch_assoc();
}else{
    die("Aluno não existe!!");
}
$conn->close();
?>
    <form 
        onsubmit="return validarFormulario()"
        method="post"
        action="create_submit.php">
        <label for="cpf">CPF</label>
        <input
         type="text" 
         name = 'cpf'
         id="cpf" 
         value="<?php echo htmlspecialchars($aluno['cpf'])?>" 
         /><br />
        <label for="priNome">Primeiro Nome</label>
        <input
         type="text"
         name = 'priNome' 
         id="priNome" 
         value = "<?php echo htmlspecialchars($aluno['prinome'])?>"
         /><br />
        <label for="ultNome">Último Nome</label>
        <input 
        type="text" 
        name = 'ultNome' 
        id="ultNome" 
        value="<?php echo htmlspecialchars($aluno['ultnome'])?>"
        /><br />

        <input type="submit" value="Cadastrar"/>
    </form>
</body>
</html>