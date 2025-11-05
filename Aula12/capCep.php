<?php
function buscarCep($cep)
{
    $cep = preg_replace('/\D/', '', $cep);
    if (strlen($cep) != 8) {
        return null;
    }

    $url = "https://viacep.com.br/ws/$cep/json/";
    $response = @file_get_contents($url);
    if (!$response) {
        return null;
    }
    $dados = json_decode($response, true);
    if (isset($dados["erro"])) {
        return null;
    }
    return $dados;
}
$dadosCep = null;
if (isset($_POST["cep"])) {
    $dadosCep = buscarCep($_POST["cep"]);
}

?>

<body>
    <style>
        body 
        {
            font-family: 'Arial', sans-serif;
            background-image:linear-gradient(rgb(0 0 255 / 0.5), rgb(255 255 0 / 0.5));
            background-size: cover;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;

        }

        label 
        {
            display: block;
            margin-right: 10px;
            width: 100px;
        }

        .erro 
        {
            color: red;
            font-weight: bold;
            margin-top: 10x;
        }

        button[type="submit"] 
        {
            background-color: #007bff;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            width: 100%;
            cursor: pointer;
            font-size: 16px;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }

        input {
            display: block;
            width: 100px;
            border-radius: 10px;
            box-sizing: border-box;
        }
        h1.primeiro{
            text-align: center  ;
            background-color: darkgoldenrod;
            align-items: center;
        }
        h1.segundo{
            text-align: center  ;
            background-color: darkgoldenrod;
            align-items:center ;
        }
    </style>
    <form method="post">
        <h1 class="primeiro">Aluno</h1>

        <label>Matricula:</label>
        <input type="text" name="nome" id="nome">

        <label>Nome:</label>
        <input type="text" name="idade" id="idade">

        <label>Curso:</label>
        <input type="text" name="curso" id="curso">

        <label>Data de nascimento:</label>
        <input type="text" name="nascimento" id="nascimento">

        <label>Genero:</label>
        <input type="text" name="genero" id="genero">

        <label>Email:<label />
        <input type="text" name="email" id="email">


        <h1 class="segundo">Endereço</h1>
        
        <label>CEP:</label>
        <input type="text" name="cep" required/ value="<?= $dadosCep['cep'] ?? '' ?>">
        <input type="submit" />
        <?php
        if ($dadosCep === null && isset($_POST["cep"])) {
        ?>
           <p class"erro">ERRO:Cep inválido ou não encontrado</p>
        <?php
        }
        ?>
        <label>Logradouro:</label>
        <input type="text" name="logadouro" value="<?= $dadosCep['logradouro'] ?? '' ?>">

        <label>Bairro:</label>
        <input type="text" name="Bairro" value="<?= $dadosCep['bairro'] ?? '' ?>">

       <label>Localidade:</label>
        <input type="text" name="Localidade" value="<?= $dadosCep['localidade'] ?? '' ?>">

        <label>UF:</label>
        <input type="text" name="UF" value="<?= $dadosCep['uf'] ?? '' ?>">

    </form>
</body>