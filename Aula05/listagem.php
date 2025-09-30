<!DOCTYPE html>
<html lang="pt-BR">
<?php
$arquivo = "dados.txt";
$linhas = file($arquivo,FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
?>
<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <h2>Listagem de pessoas</h2>
        <table>
            <thead>
            <tr>
                <th>
                    <?php
                    $cabecalho = $linhas[explode(";", $linhas[0])];
                    foreach ($cabecalho as $coluna) {
                        echo "<th>".htmlspecialchars($coluna)."</th>";
                    }
                    ?>
                </th>
            </tr>
            </thead>
            <tbody>
                <tr>
                <?php
                    for($i = 1; $i < count($linhas); $i++) {
                        $cabecalho = explode(";", $linhas[$i]);
                        echo "<tr>";
                        foreach($colunas as $coluna) {
                            echo "<td>".htmlspecialchars($coluna)."</td>";
                        }
                        echo "</tr>";
                    }
            ?>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>