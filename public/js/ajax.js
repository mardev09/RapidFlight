const searchButton = document.querySelector('.searchBtn')

// Búscador
searchButton?.addEventListener('click', e => {
    e.preventDefault();
    let origin;
    let destination;
    const fechaIda = document.querySelector('#ida span input').value;
    const fechaVuelta = document.querySelector('#vuelta span input').value;

    document.querySelectorAll('.search-from-to .search-select').forEach(button => {
        if (button.querySelector('span p:first-child').textContent == 'Origen') {
            origin = button.querySelector('span p:last-child').textContent != "¿De dónde sales?" ? button.querySelector('span p:last-child').textContent : ""
        } else if (button.querySelector('span p:first-child').textContent == 'Destino') {
            destination = button.querySelector('span p:last-child').textContent != "¿A dónde vas?" ? button.querySelector('span p:last-child').textContent : ""
        }
    })

    if (origin && destination && fechaIda) {
        const cities = {
            origin: origin,
            destination: destination
        }

        fetch("/getIATA", {
            method: 'POST',
            headers: {
            'Content-Type': 'application/json',
            },
            body: JSON.stringify(cities),
        }).then(res => {
            return res.json()
        }).then(cities => {
            getFlights(cities, fechaIda, fechaVuelta)
        }).catch(err => console.error(err))
    }
})

// Fetch a la API aunque de momento es un fetch al JSON sin mandarle ningún parámetro ya que no se puede hacer uson de la API
function getFlights(cities, fechaIda, fechaVuelta) {
    // const url = `https://booking-com15.p.rapidapi.com/api/v1/flights/searchFlights?fromId=${cities['origin']}.AIRPORT&toId=${cities['destination']}.AIRPORT&departDate=${fechaIda}${fechaVuelta ? "&returnDate=" + fechaVuelta : ""}&stops=none&pageNo=1&adults=1&children=0%2C17&sort=BEST&cabinClass=ECONOMY&currency_code=EUR`;
    // console.log(url)
    // const options = {
    // 	method: 'GET',
    // 	headers: {
    // 		'x-rapidapi-key': 'e71f37d53amsh535400404897a4ep123ec5jsnd82727a76054',
    // 		'x-rapidapi-host': 'booking-com15.p.rapidapi.com'
    // 	}
    // };

    fetch('/test.json')
    .then(res => {return res.json()})
    .then(data => {
        /* API */
        // const vuelos = data.data.flightOffers?.map((oferta) => {
        //     const primerSegmento = oferta.segments[0];
        //     const primerLeg = primerSegmento.legs[0];
        //     const carrier = primerLeg.carriersData[0];

        //     const aerolinea = carrier.name;
        //     const numeroVuelo = `${primerLeg.flightInfo.carrierInfo.marketingCarrier}${primerLeg.flightInfo.flightNumber}`;
        //     const origen = primerLeg.departureAirport.cityName;
        //     const destino = primerLeg.arrivalAirport.cityName;
        //     const fechaSalida = primerLeg.departureTime.split('T')[0];
        //     const horaSalida = primerLeg.departureTime.split('T')[1];
        //     const fechaLlegada = primerLeg.arrivalTime.split('T')[0];
        //     const horaLlegada = primerLeg.arrivalTime.split('T')[1];
        //     const precio = `${oferta.priceBreakdown.total.units}.${oferta.priceBreakdown.total.nanos.toString().padStart(9, '0')} ${oferta.priceBreakdown.total.currencyCode}`;

        //     // Datos importantes
        //     const duracionSegundos = primerLeg.totalTime;
        //     const duracionHoras = Math.floor(duracionSegundos / 3600);
        //     const duracionMinutos = Math.floor((duracionSegundos % 3600) / 60);
        //     const duracion = `${duracionHoras}h ${duracionMinutos}min`;

        //     const equipajeManoIncluido = primerSegmento.travellerCabinLuggage.length > 0;

        //     return {
        //         aerolinea,
        //         numeroVuelo,
        //         origen,
        //         destino,
        //         fechaSalida,
        //         horaSalida,
        //         fechaLlegada,
        //         horaLlegada,
        //         precio,
        //         datosImportantes: {
        //         duracion,
        //         equipajeManoIncluido,
        //         escalas: oferta.segments.length - 1
        //         }
        //     };
        // });

        /* TEST JSON */
        const vuelos = data.data.flightOffers.map((oferta) => {
        const primerSegmento = oferta.segments[0];
        const primerLeg = primerSegmento.legs[0];
        const carrier = primerLeg.carriersData[0];

        const aerolinea = carrier.name;
        const numeroVuelo = `${primerLeg.flightInfo.carrierInfo.marketingCarrier}${primerLeg.flightInfo.flightNumber}`;
        const origen = primerLeg.departureAirport.cityName;
        const destino = primerLeg.arrivalAirport.cityName;
        const fechaSalida = primerSegmento.departureTime.split('T')[0];
        const horaSalida = primerSegmento.departureTime.split('T')[1];
        const fechaLlegada = primerSegmento.arrivalTime.split('T')[0];
        const horaLlegada = primerSegmento.arrivalTime.split('T')[1];

        const precio = `${oferta.priceBreakdown.total.units}.${oferta.priceBreakdown.total.nanos
            .toString()
            .padStart(9, '0')} ${oferta.priceBreakdown.total.currencyCode}`;

        const duracionSegundos = primerSegmento.totalTime;
        const duracionHoras = Math.floor(duracionSegundos / 3600);
        const duracionMinutos = Math.floor((duracionSegundos % 3600) / 60);
        const duracion = `${duracionHoras}h ${duracionMinutos}min`;

        const equipajeManoIncluido = primerSegmento.travellerCabinLuggage?.length > 0;
        const escalas = oferta.segments.length - 1;

        return {
            aerolinea,
            numeroVuelo,
            origen,
            destino,
            fechaSalida,
            horaSalida,
            fechaLlegada,
            horaLlegada,
            precio,
            datosImportantes: {
            duracion,
            equipajeManoIncluido,
            escalas
            }
        };
        });

        // console.log(vuelos)
        
        // Creo un formulario ficticio para enviar los datos a /reserve
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '/reserve';
        form.style.display = 'none';

        const input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'vuelos';
        input.value = JSON.stringify(vuelos);

        form.appendChild(input);
        document.body.appendChild(form);
        form.submit();
    })
    .catch(err => {
        console.log(err)
    });
}

// Al realizar una reserva
const reserveButtons = document?.querySelectorAll('.reserveButton');

reserveButtons.forEach(button => {
    button.addEventListener('click', e => {
        e.preventDefault();
        const idVuelo = button.id;

        fetch('/reserve-submit', {
            method: 'POST',
            headers: {
            'Content-Type': 'application/json',
            },
            body: JSON.stringify({id: idVuelo}),
        }).then(res => {
            return res.json();
        }).then(res => {
            window.location.href = "/my-reserves"
        }).catch(err => {
            console.error(err)
        })
    })
})