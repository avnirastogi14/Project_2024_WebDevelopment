const images = [
    "https://t3.ftcdn.net/jpg/05/49/37/30/360_F_549373036_sjqy4Y3BUfFKAAELVfvOw0gIDAZ6QmH6.jpg",
    "https://as2.ftcdn.net/v2/jpg/04/72/40/73/1000_F_472407355_YUmspuQxu0XBxMeoZjprvkuhR6VFZMhI.jpg"
];

let currentIndex = 0;

function changeImage() {
    const imageElement = document.getElementById("imageElement");
    imageElement.classList.add("vortex-animation");

    setTimeout(() => {
        currentIndex = (currentIndex + 1) % images.length;
        imageElement.src = images[currentIndex];
        imageElement.classList.remove("vortex-animation");
    }, 1000);
}

setInterval(changeImage, 5000);

document.addEventListener('DOMContentLoaded', () => {
    document.getElementById("imageElement").src = images[currentIndex];
});

function showForm(type) {
    const contentArea = document.getElementById('content-area');
    let formContent = '';

    if (type === 'flights') {
        formContent = `
            <form id="flights-form" action="process_booking.php" method="POST">
                <h3>Flight Booking</h3>
                <input type="text" placeholder="Airline" name="airline" required>
                <input type="text" placeholder="Flight Number" name="flight_number" required>
                <input type="text" placeholder="Departure City" name="departure" required>
                <input type="text" placeholder="Arrival City" name="arrival" required>
                <label for="departure_time">Departure Time:</label>
                <input type="datetime-local" name="departure_time" required>
                <label for="arrival_time">Arrival Time:</label>
                <input type="datetime-local" name="arrival_time" required>
                <input type="number" placeholder="Price" name="price" step="0.01" required>
                <button type="submit">Search Flights</button>
            </form>
        `;
    } else if (type === 'hotels') {
        formContent = `
            <form id="hotels-form" action="process_booking.php" method="POST">
                <h3>Hotel Booking</h3>
                <input type="text" placeholder="Hotel Name" name="hotel_name" required>
                <input type="text" placeholder="Location" name="location" required>
                <input type="number" placeholder="Rating (1-5)" name="rating" step="0.1" min="1" max="5" required>
                <input type="number" placeholder="Price per Night" name="price_per_night" step="0.01" required>
                <textarea placeholder="Amenities" name="amenities"></textarea>
                <button type="submit">Search Hotels</button>
            </form>
        `;
    } else if (type === 'villas') {
        formContent = `
            <form id="villas-form" action="process_booking.php" method="POST">
                <h3>Homestay Booking</h3>
                <input type="text" placeholder="Homestay Name" name="homestay_name" required>
                <input type="text" placeholder="Location" name="location" required>
                <input type="number" placeholder="Rating (1-5)" name="rating" step="0.1" min="1" max="5" required>
                <input type="number" placeholder="Price per Night" name="price_per_night" step="0.01" required>
                <input type="text" placeholder="Host Name" name="host_name" required>
                <textarea placeholder="Description" name="description"></textarea>
                <button type="submit">Search Homestays</button>
            </form>
        `;
    } else if (type === 'trains') {
        formContent = `
            <form id="trains-form" action="process_booking.php" method="POST">
                <h3>Train Booking</h3>
                <input type="text" placeholder="Departure Station" name="departure" required>
                <input type="text" placeholder="Arrival Station" name="arrival" required>
                <label for="train-date">Travel Date:</label>
                <input type="date" name="train-date" required>
                <button type="submit">Search Trains</button>
            </form>
        `;
    }

    contentArea.innerHTML = formContent;
}