
<?php
require_once 'config/database.php';

$totalProdutos = $pdo->query("SELECT COUNT(*) FROM products")->fetchColumn();
$totalEnderecos = $pdo->query("SELECT COUNT(*) FROM addresses")->fetchColumn();
$totalTransportadoras = $pdo->query("SELECT COUNT(*) FROM transporters")->fetchColumn();
$totalFretes = $pdo->query("SELECT COUNT(*) FROM freights")->fetchColumn();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LogiTrack - Painel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand fw-bold" href="index.php">📦 LogiTrack</a>
    </div>
</nav>

<div class="container py-5">
    <h1 class="mb-2">Painel de controle</h1>
    <p class="text-secondary">Sistema de gerenciamento logístico</p>

    <div class="row g-3 mt-3">

        <?php
        $cards = [
            'Produtos' => $totalProdutos,
            'Endereços' => $totalEnderecos,
            'Transportadoras' => $totalTransportadoras,
            'Fretes' => $totalFretes
        ];
        ?>

        <?php foreach ($cards as $nome => $total): ?>
        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h5><?= $nome ?></h5>
                    <h2><?= $total ?></h2>
                </div>
            </div>
        </div>
        <?php endforeach; ?>

    </div>

    <h3 class="mt-5 mb-3">Menu do sistema</h3>

    <div class="list-group">
        <a href="products.php" class="list-group-item list-group-item-action">Cadastrar produtos</a>
        <a href="addresses.php" class="list-group-item list-group-item-action">Cadastrar endereços</a>
        <a href="transporters.php" class="list-group-item list-group-item-action">Cadastrar transportadoras</a>
        <a href="freights.php" class="list-group-item list-group-item-action">Gerenciar fretes</a>
        <a href="report.php" class="list-group-item list-group-item-action">Relatórios</a>
    </div>
</div>

</body>
</html>
