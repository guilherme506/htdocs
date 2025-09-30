<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Cadastro de pessoa</title>
</head>
<body>
    <div class="container">x'
        <h2>Cadastro de pessoas</h2>
        <!-- Mensagens -->
        <div class="mensagem">
            <?php if (isset($_GET['msg'])) { ?>
                <p style='color: <?= $_GET['tipo'] === 'ok' ? 'green': 'red'?>;'>
                <?=htmlspecialchars($_GET['msg']) ?>
            <?php }?>
            <!-- Pagina -->
            <form action="processal.php" method="POST">
                <label for="nome:">Nome:</label>
                <input type="text" id = "nome" name="nome" require></input>

                <label for="Idade:">Idade:</label>
                <input type="number" id = "idade" name="idade" require></input>

                <label for="estadoCivil:">Estado Civil:</label>
                <select name="estadoCivil" id="estadoCivil">
                    <option value="">Selecione o estado civil</option>
                    <option value="C">Casado</option>
                    <option value="S">Solteiro</option>

                </select>
                    <button type="submit">Enviar</button>
                </form>
        </div>
    </div>
</body>
</html>