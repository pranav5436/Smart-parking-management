<?php
$db = new SQLite3('vehicle_registration.db');

// Create table if it doesn't exist
$db->exec("CREATE TABLE IF NOT EXISTS registrations (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    ownerName TEXT NOT NULL,
    vehicleType TEXT NOT NULL,
    vehicleNumber TEXT NOT NULL,
    registrationDate TEXT NOT NULL
)");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ownerName = $_POST['ownerName'];
    $vehicleType = $_POST['vehicleType'];
    $vehicleNumber = $_POST['vehicleNumber'];
    $registrationDate = $_POST['registrationDate'];

    $stmt = $db->prepare("INSERT INTO registrations (ownerName, vehicleType, vehicleNumber, registrationDate) VALUES (:ownerName, :vehicleType, :vehicleNumber, :registrationDate)");
    $stmt->bindValue(':ownerName', $ownerName, SQLITE3_TEXT);
    $stmt->bindValue(':vehicleType', $vehicleType, SQLITE3_TEXT);
    $stmt->bindValue(':vehicleNumber', $vehicleNumber, SQLITE3_TEXT);
    $stmt->bindValue(':registrationDate', $registrationDate, SQLITE3_TEXT);

    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: Could not insert data";
    }
}

$db->close();
?>
