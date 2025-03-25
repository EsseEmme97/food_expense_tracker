<?php

$script_name = $_SERVER["SCRIPT_NAME"];
$js=null;

switch ($script_name) {
    case "/partials/lista.php":
        $js = '<script defer src="../assets/modifica-lista.js"></script>';
        break;
    case "/index.php":
        $js = '<script defer src="../assets/crea-prodotto.js"></script>';
        break;
    case "/partials/monitora-costi.php":
        $js = '<script defer src="../assets/monitora-costi.js"></script>';
        break;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?= $js ?>
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/sort@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://unpkg.com/@tailwindcss/browser@4"></script>
    <link rel="icon" type="image/x-icon" href="../assets/images/logo.svg">
    <title>Lista della spesa</title>
</head>

<body class="bg-slate-50 pb-6">