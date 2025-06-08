<?php
// Získání IP adresy klienta
$ip_address = $_SERVER['REMOTE_ADDR'];

// Cesta k souboru
$file = 'ip.txt';

// Otevření souboru pro zápis (pokud neexistuje, vytvoří se)
$file_handle = fopen($file, 'a'); // 'a' znamená, že soubor bude otevřen pro přidání na konec

if ($file_handle) {
    // Zapsání IP adresy do souboru
    fwrite($file_handle, $ip_address . "\n"); // Přidání nového řádku
    fclose($file_handle); // Zavření souboru
} else {
    echo "Chyba při otevírání souboru.";
}

// Výpis IP adresy na stránku
echo "IP adresa: " . $ip_address;
?>
