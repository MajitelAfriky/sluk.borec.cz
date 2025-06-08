<html>
    <head>
        <style>
            div {display: none;}
        </style>
    </head>
    <body>
        <main>
            <?php
            // Nastavení tajného tokenu
            define('ESP_TOKEN', 'lolopolo'); // Tento token musí odpovídat tomu v kódu ESP
            
            // Kontrola HTTP hlavičky
            if (isset($_SERVER['HTTP_X_ESP_AUTH']) && $_SERVER['HTTP_X_ESP_AUTH'] === ESP_TOKEN) {
                // Přístup povolen pro ESP, autentizace se vynechá
            } else {
                // Spuštění základní HTTP autentizace pro ostatní
                if (!isset($_SERVER['PHP_AUTH_USER'])) {
                    header('WWW-Authenticate: Basic realm="Restricted Area"');
                    header('HTTP/1.0 401 Unauthorized');
                    // Nepovolený přístup
                    exit;
                } else {
                    // Zpracování přihlášení pro běžné uživatele
                    $username = $_SERVER['PHP_AUTH_USER'];
                    $password = $_SERVER['PHP_AUTH_PW'];
                    
                    // Zde zadejte uživatele a heslo
                    if ($username == 'admin' && $password == 'admin') {
                        // Přístup povolen pro uživatele
                    } else {
                        header('HTTP/1.0 401 Unauthorized');
                        // Špatné přihlašující udaje
                        exit;
                    }
                }
            }
            // Zde pokračuje běžný obsah chráněné stránky
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
    </body>
</html>