<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = ""; // or your DB password
$database = "Route Planner";

$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get form values
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

// DELIMITER //
// CREATE PROCEDURE AddFeedback(
//   IN pname VARCHAR(100),
//   IN pemail VARCHAR(100),
//   IN pmessage TEXT
// )
// BEGIN
//   INSERT INTO feedback (name, email, message) VALUES (pname, pemail, pmessage);
// END //
// DELIMITER ;


// Call the stored procedure
$sql = "CALL AddFeedback(?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $name, $email, $message);

if ($stmt->execute()) {
  echo "<script>alert('✅ Feedback submitted successfully!'); window.location.href='feedbackpage.php';</script>";
} else {
  echo "❌ Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
