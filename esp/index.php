<?php
    $storedData = file_exists('data.txt') ? file_get_contents('data.txt') : '000000';
    $checkboxStates = str_split(substr($storedData, 1));
?>

<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Control panel</title>
    <link rel="stylesheet" href="index.css">
    <link rel="icon" type="image/x-icon" href="settings.png">
</head>
<style>
    .box:checked {
        background-color: <?php echo htmlspecialchars(strlen($storedData) >= 72 ? substr($storedData, 65, 7) : "#FFA500"); ?>;
    }
</style>
<body>
    <main>
        <?php 
            $file = 'data.txt';
            if (file_exists($file)) {
                $data = file_get_contents($file);
                if (strlen(trim($data)) > 0) {
                    echo htmlspecialchars($data);
                } else {
                    echo "#0000000000000000000000000000000000000000000000000000000000000000";
                }
            } else {
                echo "missing data.txt";
            }
        ?>
    </main>
    <!--<br>-->
    <form method="POST" action="data.php" id="form1">
        <p class="text">Text</p>
        <input type="text" name="data" class="input" placeholder="Libovolný text...">
        <button type="submit" class="odeslat">Potvrdit</button>
    </form>
    <!--<br>-->
    <form method="POST" action="data.php" id="form2">
        <p class="text">Předvolby</p>
        <section id="form21">
            <button type="submit" name="data" value="$red" class="red">Red</button>
            <button type="submit" name="data" value="$green" class="green">Green</button>
            <button type="submit" name="data" value="$blue" class="blue">Blue</button>
        </section>
        <section id="form22">
            <button type="submit" name="data" value="$police" class="preset">Police</button>
            <button type="submit" name="data" value="$ani1" class="preset">ani1</button>
            <button type="submit" name="data" value="$ani2" class="preset">ani2</button>
        </section>
        <section id="form23">
            <button type="submit" name="data" value="#1111111111111111111111111111111111111111111111111111111111111111#ffdfa3" class="preset">Osvětlení1</button>
            <button type="submit" name="data" value="#1111111111111111111111111111111111111111111111111111111111111111#ffc966" class="preset">Osvětlení2</button>
            <button type="submit" name="data" value="#1111111111111111111111111111111111111111111111111111111111111111#b85900" class="preset">Osvětlení3</button>
        </section> </form>
    <!--<br>-->
    <form method="POST" action="data.php">
        <section id="form3">
            <?php for ($i = 0; $i < 64; $i++): ?>
                <?php $isChecked = isset($checkboxStates[$i]) && $checkboxStates[$i] === '1'; ?>
                <input class="box" type="checkbox" name="check<?= $i + 1 ?>" value="1" <?= $isChecked ? 'checked' : '' ?>>
            <?php endfor; ?>
            <script src="drag.js"></script>
        </section>
        <section id="form31">
            <p class="text">Potvrzení barvy pixelů</p>
            <input id="color" type="color" name="color" class="color" value="<?php echo htmlspecialchars(strlen($storedData) >= 72 ? substr($storedData, 65, 7) : "#FFA500"); ?>">
            <button type="submit" class="colorButton">Potvrdt</button>
        </section
    </form>

</body>
</html>