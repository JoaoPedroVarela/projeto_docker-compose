<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciando no docker | Joao Pedro</title>
    <link rel="stylesheet" href="vendor/bootstrap-5.3.3-dist/css/bootstrap.min.css" />
</head>
<body>
    <?php
        $result = file_get_contents("http://node-container:9001/jogos");
        $jogos = json_decode($result);
    ?>
    <div class="container">
    <table class="table">
        <thead>
            <tr>
                <th>Jogo</th>
                <th>Nota</th>
                <th>Data de Lançamento</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($jogos as $jogo): ?>
                <tr>
                    <td><?php echo $jogo->nome; ?></td>
                    <td><?php echo $jogo->nota; ?></td>
                    <td><?php echo date('d/m/Y', strtotime($jogo->data_lancamento)); ?></td>
                </tr>
                <?php endforeach; ?>
        </tbody>
    </table>
    </div>
</body>
</html>