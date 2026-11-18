<?php
try {
    // Vytvoření spojení s databázi
    $pdo = new PDO('mysql:dbname=d268405_vyuka;host=md417.wedos.net;charset=utf8', 'a268405_vyuka', '693wnngQ.');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    // Příprava SQL dotazu
    $query = $pdo->prepare('SELECT * FROM models');

    // Provedení dotazu
    $query->execute();

    // Vypsání získáných dat z databáze
    print_r($query->fetchAll());

} catch (PDOException $e) {

    // Při chybném vytvoření spojení s databázi nebo při chybném zadání SQL dotazu se na obrazovku vypíše chybová hláška 
    echo $e->getMessage();
}
?>