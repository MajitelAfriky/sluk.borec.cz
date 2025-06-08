let mouseDown = false;
let shouldCheck = null;

document.querySelectorAll('.box').forEach(box => {
    // Při stisknutí tlačítka myši
    box.addEventListener('mousedown', function(event) {
        mouseDown = true;
        shouldCheck = !event.target.checked; // Zjistí, zda checkbox zaškrtnout/odškrtnout
        event.target.checked = shouldCheck;  // Přepne stav checkboxu okamžitě
        event.preventDefault(); // Zabrání výchozímu chování
    });

    // Při přejíždění přes checkboxy se stav přepíná, pokud myš držíme
    box.addEventListener('mouseover', function() {
        if (mouseDown) {
            this.checked = shouldCheck; // Přepínání stavu při přejíždění
        }
    });
});

// Ukončení při uvolnění tlačítka myši
document.body.addEventListener('mouseup', function() {
    mouseDown = false; // Ukončení režimu "myš držena"
});

// Přidání události pro jednoduché kliknutí, která funguje nezávisle na drag & drop
document.querySelectorAll('.box').forEach(box => {
    box.addEventListener('click', function(event) {
        if (!mouseDown) {
            this.checked = !this.checked; // Přepne stav checkboxu na základě aktuálního stavu
            event.preventDefault(); // Zabrání výchozímu chování
        }
    });
});
