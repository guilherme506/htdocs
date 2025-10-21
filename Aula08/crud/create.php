<!DOCTYPE html>
<html>
<head>
    <title>CRUD de Alunos</title>
    <script>
        function validarFormulario() {
            return true;
        } 
    </script>    
</head>
<body>
    <h1>Inclusão de Alunos</h1>
    <form 
        onsubmit="return validarFormulario()"
        method="post"
        action="create_submit.php">
        <label for="cpf">CPF</label>
        <input type="text" name = 'cpf'id="cpf" /><br />
        <label for="priNome">Primeiro Nome</label>
        <input type="text" name = 'priNome' id="priNome" /><br />
        <label for="ultNome">Último Nome</label>
        <input type="text" name = 'ultNome' id="ultNome" /><br />

        <input type="submit" value="Cadastrar"/>
    </form>
</body>    
</html>
