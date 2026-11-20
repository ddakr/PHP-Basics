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
<div class="karty0">
    <?php foreach ($auta as $auto):?>
        <div class="karty1">
            <img src="<?php echo $auto['image']; ?>" alt="<?php echo $auto['name']; ?>">
            <h1><?php echo $auto['name']; ?></h1>
            <p><?php echo number_format($auto['Base_price'], 0, ',', ' '); ?> Kč</p>
        </div>
    <?php endforeach; ?>
</div>
