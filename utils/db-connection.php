<?php

try {
    // $dsn = "pgsql:host=ep-frosty-wave-a8sgk0w5-pooler.eastus2.azure.neon.tech;port=5432;dbname=neondb;sslmode=require";
    // $username = "neondb_owner";
    // $password = "npg_2jTxA0KQcrGR";
    $root = $_SERVER["DOCUMENT_ROOT"];
    $connection = new PDO("sqlite:{$root}/db.sqlite", null, null, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::SQLITE_ATTR_OPEN_FLAGS => SQLITE3_OPEN_READWRITE | SQLITE3_OPEN_CREATE
    ]);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
