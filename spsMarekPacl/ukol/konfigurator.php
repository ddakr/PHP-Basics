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
    $auta = $query->fetchAll();

} catch (PDOException $e) {

    // Při chybném vytvoření spojení s databázi nebo při chybném zadání SQL dotazu se na obrazovku vypíše chybová hláška 
    echo $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfigurator BMW</title>
    <link rel="stylesheet" href="stylesheet.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
</head>
<body>
<div class="navbar">
<div class="logo">
    <a href="index.html">
    <img src="bmw-logo.jpg" alt="Logo bmw">
    </a>
    </div>
    <div class="cart">
        <i class="fa-solid fa-cart-shopping"></i>
    </div>
    <div class="user">
        <i class="fa-solid fa-user"></i>
    </div>
</div>
<div class="karty0">
    <?php foreach ($auta as $auto):?>
        <div class="karty1">
            <img src="<?php echo $auto['image']; ?>" alt="<?php echo $auto['name']; ?>">
            <h1><?php echo $auto['name']; ?></h1>
            <p><?php echo number_format($auto['Base_price'], 0, ',', ' '); ?> Kč</p>
        </div>
    <?php endforeach; ?>
</div>
    
</body>
</html>
