<?php
// connection.php

$host = "localhost";
$username = "root";      // or your DB username
$password = "";          // or your DB password
$database = "Route Planner"; // your DB name

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get form data
$firstName = $_POST['firstname'];
$lastName = $_POST['lastname'];
$phone = $_POST['phonenumber'];
$email = $_POST['email'];
$password = $_POST['password'];

// Check if email already exists
$checkQuery = "SELECT * FROM signup WHERE email = ?";
$stmt = $conn->prepare($checkQuery);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
  // If user exists, UPDATE instead of INSERT
  $updateQuery = "UPDATE signup SET firstname=?, lastname=?, phonenumber=?, password=? WHERE email=?";
  $updateStmt = $conn->prepare($updateQuery);
  $updateStmt->bind_param("sssss", $firstName, $lastName, $phone, $password, $email);

  if ($updateStmt->execute()) {
    echo "<script>alert('Profile updated successfully!'); window.location.href='homepage.html';</script>";
  } else {
    echo "<script>alert('Failed to update profile.'); window.history.back();</script>";
  }

} else {
  // Else insert new user
  $insertQuery = "INSERT INTO signup(firstname, lastname, phonenumber, email, password) VALUES (?, ?, ?, ?, ?)";
  $insertStmt = $conn->prepare($insertQuery);
  $insertStmt->bind_param("sssss", $firstName, $lastName, $phone, $email, $password);

  if ($insertStmt->execute()) {
    echo "<script>alert('Signup successful!'); window.location.href='loginpage.html';</script>";
  } else {
    echo "<script>alert('Signup failed.'); window.history.back();</script>";
  }
}

$conn->close();
?>
