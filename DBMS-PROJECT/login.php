<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Route Planner";

$conn = new mysqli($servername, $username, $password, $dbname);

// Connection error
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $stmt = $conn->prepare("SELECT firstname, lastname, phonenumber, email, password FROM signup WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($firstname, $lastname, $phonenumber, $email, $stored_password);
        $stmt->fetch();

        if ($password === $stored_password) {
            $fullname = $firstname . ' ' . $lastname;

            echo "
            <script>
              localStorage.setItem('loggedIn', 'true');
              localStorage.setItem('user', JSON.stringify({
                fullname: '$fullname',
                email: '$email',
                phone: '$phonenumber',
              }));
              alert('✅ Login successful!');
              window.location.href = 'homepage.html';
            </script>";
        } else {
            echo "<script>alert('❌ Wrong password!'); window.location.href='loginpage.html';</script>";
        }
    } else {
        echo "<script>alert('⚠️ Email not found. Please sign up first.'); window.location.href='signuppage.html';</script>";
    }

    $stmt->close();
}

$conn->close();
?>
