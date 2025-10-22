<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grafico de Vendas 2025</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
</head>
<body>
    <h1>Grafico</h1>
    <canvas id="myChart" width="10px" height="5px"></canvas>
    <?php
    function lerCSV($arquivo){
        if (($handle = fopen($arquivo, "r")) !== false){
            // Salta linha do cabeçalho
            fgetcsv($handle, 1000, ",");
            // Ler as linhas 
            while (($dados = fgetcsv($handle, 1000, ",")) !== false){
                $linhas[] = $dados; 
            }
            fclose($handle);
        }
        return $linhas;
    }
    $data = lerCSV('data.csv');
    $labels = [];
    $values = [];

    foreach ($data as $row){
        $labels[] = $row[0];
        $values[] = $row[1];
    }
        
    ?>
    <script>
        var ctx = document
            .getElementById('myChart')
            .getContext('2d');
        var meuGraf = new Chart(ctx,{
            type: 'radar',
            data: {
                    labels: <?php echo json_encode($labels);?>,
                    datasets:[{
                        label:'Valores',
                        data: <?php echo json_encode($values); ?>,
                        backgroundColor: 'rgba(00, 255, 00, 0.1)',
                        borderColor: '#00FF00',
                        borderwidth: 1
                    }], 
            }
        });


    </script>
    </form>
</body>
</html>