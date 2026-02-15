const searchButton = document.querySelector('.searchBtn')

// Búscador
searchButton?.addEventListener('click', e => {
    e.preventDefault();
    let origin;
    let destination;
    const fechaIda = document.querySelector('#ida span input[type="date"]').value;
    const fechaVuelta = document.querySelector('#vuelta span input[type="date"]').value;

    document.querySelectorAll('.search-from-to .search-select').forEach(button => {
        if (button.querySelector('span p:first-child').textContent == 'Origen') {
            origin = button.querySelector('span p:last-child').textContent != "¿De dónde sales?" ? button.querySelector('span p:last-child').textContent : ""
        } else if (button.querySelector('span p:first-child').textContent == 'Destino') {
            destination = button.querySelector('span p:last-child').textContent != "¿A dónde vas?" ? button.querySelector('span p:last-child').textContent : ""
        }
    })

    if (!origin || !destination || !fechaIda) {
        rpfPopup('warning', 'Campos incompletos', 'Selecciona origen, destino y fecha de ida');
        return;
    }

    // Obtener IATA codes
    fetch("/getIATA", {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ origin, destination }),
    })
        .then(res => res.json())
        .then(cities => {
            searchFlights(cities, fechaIda, fechaVuelta, origin, destination);
        })
        .catch(err => {
            console.error(err);
            rpfPopup('error', 'Error', 'No se pudieron resolver las ciudades');
        });
})

// Buscar vuelos de ida y (opcionalmente) vuelta
function searchFlights(cities, fechaIda, fechaVuelta, originName, destName) {
    // Búsqueda de IDA
    const idaPromise = fetch('/search-flights', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
            origin: cities.origin,
            destination: cities.destination,
            date: fechaIda
        })
    }).then(res => res.json());

    // Búsqueda de VUELTA (origen/destino invertidos)
    let vueltaPromise = Promise.resolve([]);
    if (fechaVuelta) {
        vueltaPromise = fetch('/search-flights', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                origin: cities.destination,
                destination: cities.origin,
                date: fechaVuelta
            })
        }).then(res => res.json());
    }

    Promise.all([idaPromise, vueltaPromise])
        .then(([vuelosIda, vuelosVuelta]) => {
            if (vuelosIda.length === 0 && vuelosVuelta.length === 0) {
                rpfPopup('info', 'Sin resultados', 'No se encontraron vuelos para tu búsqueda');
                return;
            }

            // Redirigir a /vuelos con los resultados via POST
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '/vuelos';
            form.style.display = 'none';

            const inputIda = document.createElement('input');
            inputIda.type = 'hidden';
            inputIda.name = 'vuelosIda';
            inputIda.value = JSON.stringify(vuelosIda);
            form.appendChild(inputIda);

            if (vuelosVuelta.length > 0) {
                const inputVuelta = document.createElement('input');
                inputVuelta.type = 'hidden';
                inputVuelta.name = 'vuelosVuelta';
                inputVuelta.value = JSON.stringify(vuelosVuelta);
                form.appendChild(inputVuelta);
            }

            const inputOrigin = document.createElement('input');
            inputOrigin.type = 'hidden';
            inputOrigin.name = 'searchOrigin';
            inputOrigin.value = originName;
            form.appendChild(inputOrigin);

            const inputDest = document.createElement('input');
            inputDest.type = 'hidden';
            inputDest.name = 'searchDest';
            inputDest.value = destName;
            form.appendChild(inputDest);

            document.body.appendChild(form);
            form.submit();
        })
        .catch(err => {
            console.log(err);
            rpfPopup('error', 'Error de búsqueda', 'No se pudieron buscar los vuelos');
        });
}

// Al realizar una reserva desde el slideshow
const reserveButtons = document?.querySelectorAll('.reserveButton');

reserveButtons.forEach(button => {
    button.addEventListener('click', e => {
        e.preventDefault();
        const idVuelo = button.dataset.idvuelo;
        if (idVuelo) {
            window.location.href = '/pago?idVuelo=' + idVuelo;
        } else {
            rpfPopup('error', 'Error', 'No se pudo identificar el vuelo');
        }
    })
})