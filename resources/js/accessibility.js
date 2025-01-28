
    document.addEventListener("DOMContentLoaded", function () {
        // Taille par défaut
        const defaultFontSize = 16; // Taille en pixels
        let currentFontSize = defaultFontSize;
        
        // Fonction pour appliquer une taille globale
        const applyFontSize = (fontSize) => {
            const elements = document.querySelectorAll("body, body *:not(nav):not(script)");
            elements.forEach((el) => {
                el.style.fontSize = fontSize + "px";
            });
        };
        
        // Récupérer la taille de texte depuis localStorage
        const savedFontSize = localStorage.getItem("fontSize");
        if (savedFontSize) {
            currentFontSize = parseInt(savedFontSize, 10);
            applyFontSize(currentFontSize); // Applique la taille sauvegardée
        }
        
        // Mettre à jour la taille du texte
        const updateFontSize = (sizeChange) => {
            currentFontSize += sizeChange;
            
            // Limiter la taille à des valeurs raisonnables
            if (currentFontSize > 40) currentFontSize = 40; // Taille max
            if (currentFontSize < 12) currentFontSize = 12; // Taille min
            
            applyFontSize(currentFontSize);
            
            // Sauvegarder la nouvelle taille dans localStorage
            localStorage.setItem("fontSize", currentFontSize);
        };
        
        // Réinitialiser la taille du texte
        const resetFontSize = () => {
            currentFontSize = defaultFontSize;
            applyFontSize(currentFontSize);
            
            // Supprimer la taille sauvegardée
            localStorage.removeItem("fontSize");
        };
    
        // Ajout des écoutes aux boutons
        document.getElementById("increaseText").addEventListener("click", (e) => {
            e.preventDefault();
            updateFontSize(1);
        });
        
        document.getElementById("decreaseText").addEventListener("click", (e) => {
            e.preventDefault();
            updateFontSize(-1); 
        });
        
        document.getElementById("resetText").addEventListener("click", (e) => {
            e.preventDefault();
            resetFontSize();
        });
        //darkmode
        // Récupérer le bouton de bascule Dark Mode
    const darkModeToggle = document.getElementById("darkModeToggle");

    // Vérifier si un état précédent est sauvegardé dans localStorage
    const savedDarkMode = localStorage.getItem("darkMode");
    if (savedDarkMode === "enabled") {
        document.body.classList.add("dark-mode"); // Appliquer le mode sombre
        darkModeToggle.checked = true; // Marquer le toggle comme activé
    }

    // Ajouter un écouteur d'événement sur le toggle
    darkModeToggle.addEventListener("change", function () {
        if (darkModeToggle.checked) {
            document.body.classList.add("dark-mode"); // Activer le mode sombre
            localStorage.setItem("darkMode", "enabled"); // Sauvegarder l'état dans localStorage
        } else {
            document.body.classList.remove("dark-mode"); // Désactiver le mode sombre
            localStorage.setItem("darkMode", "disabled"); // Sauvegarder l'état dans localStorage
        }
    });
});

