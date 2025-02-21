<?php
$script = $_SERVER["SCRIPT_NAME"] === "/partials/lista.php" 
    ? '<script src="../assets/modifica-lista.js"></script>' 
    : '<script src="../assets/crea-prodotto.js"></script>';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?= $script ?>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <title>Lista della spesa</title>
</head>
<body class="bg-slate-50">