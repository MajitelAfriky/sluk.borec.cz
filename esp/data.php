<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Získání dat z formuláře 1 a 2
    $data = $_POST['data'];
    
    // Když bude zadána pouze hodnata barvy v hex tvaru, tak se připíší "1111..." pro přehlednost
    if (preg_match('/^#[a-zA-Z0-9]{6}$/', $data)) {
    $data = "#1111111111111111111111111111111111111111111111111111111111111111" . $data;
    }



    // Získání hodnot zaškrtávacích políček
    $checkboxValues = '#';
    for ($i = 1; $i <= 64; $i++) {
        $checkboxName = 'check' . $i;
        // Pokud je zaškrtnuté políčko, přidej '1', jinak '0'
        $checkboxValues .= isset($_POST[$checkboxName]) ? '1' : '0';
    }

    // Podmínka pro uložení pouze checkbox hodnot, pokud alespoň jeden checkbox je zaškrtnutý
    if (strpos($checkboxValues, '1') !== false) {
        // Uložení dat pouze z checkboxů
        $dataToSave = $checkboxValues . $_POST['color'];
    } else {
        // Uložení původních dat z formuláře
        $dataToSave = $data;
    }

    // Uložení dat do souboru s přepsáním předchozích dat
    file_put_contents('data.txt', $dataToSave);

    header("location: esp");
    //header("Location: index.php");
    exit();
}
?>