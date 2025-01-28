document.addEventListener('DOMContentLoaded', function () {
    const meteoForm = document.getElementById('meteo-form');
    const meteoContent = document.getElementById('meteo-content');
    const cityInput = document.getElementById('city-input');

    // Fonction pour charger les données météo
    async function loadMeteo(city) {
        try {
            const response = await fetch(`/meteo-ajax?city=${encodeURIComponent(city)}`);
            const data = await response.json();

            if (data.success) {
                // Construire l'affichage des prévisions
                let html = `<h4>Prévisions météo pour ${data.city}</h4>`;
                html += '<div class="forecast-row">';
                data.forecastData.forEach(day => {
                    html += `
                        <div class="forecast-day">
                            <small>${day.day_short}</small>
                            <img src="${day.icon}" alt="Prévision">
                            <div>
                                <small>${day.tmin}°C / ${day.tmax}°C</small>
                            </div>
                        </div>
                    `;
                });
                html += '</div>';

                meteoContent.innerHTML = html;
            } else {
                meteoContent.innerHTML = `<p>${data.message}</p>`;
            }
        } catch (error) {
            console.error(error);
            meteoContent.innerHTML = '<p>Erreur lors du chargement des données météo.</p>';
        }
    }

    // Charger les données météo initiales
    loadMeteo(cityInput.value);

    // Gérer la soumission du formulaire
    meteoForm.addEventListener('submit', function (e) {
        e.preventDefault();
        const city = cityInput.value.trim();
        if (city) {
            loadMeteo(city);
        }
    });
});
