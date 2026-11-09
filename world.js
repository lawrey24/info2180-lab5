document.addEventListener('DOMContentLoaded',() => {
    const countryInput = document.getElementById('country');
    const lookupbtn = document.getElementById('lookup');
    const resultdiv = document.getElementById('result');
    const lookupCitiesBtn = document.getElementById('lookup-cities');

    function fetchCountryData(isCityLookup = false) {
        const country = countryInput.value.trim();
        let url = `world.php?country=${encodeURIComponent(country)}`;

        if (isCityLookup) {
            url += '&lookup-cities=cities';
        }

        fetch(url)
            .then(response => response.text())
            .then(data => {
                resultdiv.innerHTML = data;
            })
            .catch(error => {
                console.error('Error fetching data:', error);
                resultdiv.innerHTML = '<p>Error fetching data. Please try again later.</p>';
            });
        }

        if (lookupbtn) {
            lookupbtn.addEventListener('click', () => {
                fetchCountryData(false);
            });
        }

        if (lookupCitiesBtn) {
            lookupCitiesBtn.addEventListener('click', () => {
                fetchCountryData(true);
            });
        }
    });
        




