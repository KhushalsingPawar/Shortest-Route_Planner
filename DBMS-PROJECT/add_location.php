<?php
include 'db_connect.php';

$userId = $_POST['user_id'];
$name = $_POST['name'];
$lat = $_POST['lat'];
$lon = $_POST['lon'];

$stmt = $pdo->prepare("INSERT INTO locations (UserID, Name, Latitude, Longitude) VALUES (?, ?, ?, ?)");
$stmt->execute([$userId, $name, $lat, $lon]);

echo "Location added!";
?>
