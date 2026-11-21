<?php
$pageTitle = $pageTitle ?? 'LogiTrack';
?>
<!doctype html>
<html lang="pt-br">
<head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= htmlspecialchars($pageTitle) ?> | LogiTrack</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="assets/style.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark topbar">
<div class="container-fluid px-4">
<a class="navbar-brand fw-bold" href="index.php">◈ LogiTrack</a>
<button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#menu"><span class="navbar-toggler-icon"></span></button>
<div class="collapse navbar-collapse" id="menu"><div class="navbar-nav ms-auto">
<a class="nav-link" href="index.php">Painel</a><a class="nav-link" href="products.php">Produtos</a>
<a class="nav-link" href="addresses.php">Endereços</a><a class="nav-link" href="transporters.php">Transportadores</a>
<a class="nav-link" href="freights.php">Fretes</a><a class="nav-link" href="report.php">Relatórios</a>
</div></div></div></nav>
<main class="container-fluid px-4 py-4">
