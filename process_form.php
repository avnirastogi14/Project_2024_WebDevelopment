<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $formData = [];

    foreach ($_POST as $key => $value) {
        $formData[$key] = htmlspecialchars(strip_tags(trim($value)));
    }

    if (isset($formData['departure']) && isset($formData['arrival'])) {
        echo "Booking Details:<br>";
        echo "Departure: " . $formData['departure'] . "<br>";
        echo "Arrival: " . $formData['arrival'] . "<br>";
        if (isset($formData['date'])) {
        echo "Travel Date: " . $formData['date'] . "<br>";
        }
    }

    if (isset($formData['hotel_name'])) {
        echo "Hotel Booking Details:<br>";
        echo "Hotel Name: " . $formData['hotel_name'] . "<br>";
        echo "Check-in Date: " . $formData['checkin'] . "<br>";
        echo "Check-out Date: " . $formData['checkout'] . "<br>";
    }

    if (isset($formData['homestay_name'])) {
        echo "Homestay Booking Details:<br>";
        echo "Homestay Name: " . $formData['homestay_name'] . "<br>";
        echo "Check-in Date: " . $formData['checkin'] . "<br>";
        echo "Check-out Date: " . $formData['checkout'] . "<br>";
    }

} else {
    echo "Invalid request method.";
}
?>