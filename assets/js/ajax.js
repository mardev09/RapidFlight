const url = 'https://aerodatabox.p.rapidapi.com/flights/airports/icao/LEMD/2025-05-06T13:00/2025-05-06T21:00?withLeg=true&direction=Both&withCancelled=true&withCodeshared=true&withCargo=false&withPrivate=false&withLocation=false';
const options = {
	method: 'GET',
	headers: {
		'x-rapidapi-key': 'e71f37d53amsh535400404897a4ep123ec5jsnd82727a76054',
		'x-rapidapi-host': 'aerodatabox.p.rapidapi.com'
	}
};

try {
	const response = await fetch(url, options);
	const result = await response.text();
	console.log(result);
} catch (error) {
	console.error(error);
}