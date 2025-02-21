<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciando no Docker | João Pedro</title>
    <link rel="stylesheet" href="vendor/bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .navbar {
            background-color: #007bff;
        }
        .navbar-brand {
            color: #fff !important;
            font-weight: bold;
        }
        .table-container {
            margin-top: 50px;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        footer {
            background: #007bff;
            color: white;
            text-align: center;
            padding: 10px;
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <?php
        $result = file_get_contents("http://node-container:9001/jogos");
        $jogos = json_decode($result);
    ?>

    <!-- Barra de Navegação -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="#">🎮 Meus Jogos</a>
        </div>
    </nav>

    <div class="container">
        <div class="table-container">
            <h2 class="text-center mb-4">Lista de Jogos</h2>
            <table class="table table-striped table-hover">
                <thead class="table-primary">
                    <tr>
                        <th>Jogo</th>
                        <th>Nota</th>
                        <th>Data de Lançamento</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($jogos as $jogo): ?>
                        <tr>
                            <td><?php echo $jogo->nome; ?></td>
                            <td><span class="badge bg-success"><?php echo $jogo->nota; ?></span></td>
                            <td><?php echo date('d/m/Y', strtotime($jogo->data_lancamento)); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Rodapé -->
    <footer>
        <p>&copy; 2025 João Pedro | Todos os direitos reservados.</p>
    </footer>
</body>
</html>
