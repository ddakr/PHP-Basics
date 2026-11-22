<?php
// Připojení k databázi
try {
    $pdo = new PDO('mysql:dbname=d268405_vyuka;host=md417.wedos.net;charset=utf8', 'a268405_vyuka', '693wnngQ.');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die('Chyba připojení: ' . $e->getMessage());
}

$chyba = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // MAZÁNÍ: odeslal se formulář s tlačítkem "Smazat"
    if (isset($_POST['smazat'])) {
        $query = $pdo->prepare('DELETE FROM filmy_pacl WHERE id = ?');
        $query->execute([(int)$_POST['id']]);
    }

    // PŘIDÁNÍ: odeslal se formulář s novým filmem
    $nazev     = trim($_POST['nazev'] ?? '');
    $zanr      = trim($_POST['zanr'] ?? '');
    $rok       = trim($_POST['rok'] ?? '');
    $delka     = trim($_POST['delka'] ?? '');
    $hodnoceni = trim($_POST['hodnoceni'] ?? '');

    if ($nazev === '' || $zanr === '' || $rok === '' || $delka === '' || $hodnoceni === '') {
        $chyba = 'Vyplň všechna pole.';
    } else {
        $hodnoceniOk = filter_var($hodnoceni, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1, 'max_range' => 10]]);
        if ($hodnoceniOk === false) {
            $chyba = 'Hodnocení musí být celé číslo od 1 do 10.';
        } else {
            $query = $pdo->prepare('INSERT INTO filmy_pacl (nazev, zanr, rok, delka, hodnoceni) VALUES (?, ?, ?, ?, ?)');
            $query->execute([$nazev, $zanr, (int)$rok, (int)$delka, $hodnoceniOk]);
        }
    }
}

// VÝPIS: filmy od nejlépe hodnoceného + průměr
$query = $pdo->prepare('SELECT * FROM filmy_pacl ORDER BY hodnoceni DESC');
$query->execute();
$filmy = $query->fetchAll();
$prumer = $pdo->query('SELECT AVG(hodnoceni) FROM filmy_pacl')->fetchColumn();
?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>Zhlédnuté filmy</title>
    <link rel="stylesheet" href="filmy.css?v=<?php echo @filemtime('filmy.css'); ?>">
</head>
<body>
    <h1>Přidat zhlédnutý film</h1>

    <?php if ($chyba !== ''): ?>
        <p style="color:red;"><?php echo $chyba; ?></p>
    <?php endif; ?>

    <form action="filmy.php" method="post">
        <p><label>Název filmu: <input type="text" name="nazev"></label></p>
        <p>
            <label>Žánr:
                <select name="zanr">
                    <option value="akční">akční</option>
                    <option value="komedie">komedie</option>
                    <option value="drama">drama</option>
                    <option value="sci-fi">sci-fi</option>
                    <option value="horor">horor</option>
                </select>
            </label>
        </p>
        <p><label>Rok vydání: <input type="number" name="rok"></label></p>
        <p><label>Délka (min): <input type="number" name="delka"></label></p>
        <p><label>Hodnocení (1 až 10): <input type="number" name="hodnoceni"></label></p>
        <button type="submit">Uložit film</button>
    </form>

    <h1>Seznam filmů</h1>
    <table border="1" cellpadding="6">
        <tr>
            <th>Název</th><th>Žánr</th><th>Rok</th><th>Délka (min)</th><th>Hodnocení</th><th></th>
        </tr>
        <?php foreach ($filmy as $film): ?>
            <tr>
                <td><?php echo htmlspecialchars($film['nazev']); ?></td>
                <td><?php echo htmlspecialchars($film['zanr']); ?></td>
                <td><?php echo $film['rok']; ?></td>
                <td><?php echo $film['delka']; ?></td>
                <td><?php echo $film['hodnoceni']; ?></td>
                <td>
                    <form action="filmy.php" method="post">
                        <input type="hidden" name="id" value="<?php echo $film['id']; ?>">
                        <button type="submit" name="smazat">Smazat</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <p>
        Průměrné hodnocení:
        <?php echo $prumer !== null ? number_format($prumer, 2, ',', ' ') : 'žádné filmy'; ?>
    </p>
</body>
</html>
