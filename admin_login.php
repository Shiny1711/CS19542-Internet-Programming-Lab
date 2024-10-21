<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Admin Login</h2>
        <form action="admin_login.php" method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>

    <?php
    // Database connection
    $servername = "localhost:3307";
    $username = "root";
    $password = "";
    $dbname = "hotel_booking";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if the login form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Check hardcoded admin credentials (replace with your admin credentials)
        $admin_email = "abc@gmail.com"; // Replace with your admin email
        $admin_password = "abc"; // Replace with your admin password

        if ($email === $admin_email && $password === $admin_password) {
            $_SESSION['admin_logged_in'] = true;

            // Redirect to the admin dashboard
            header("Location: admin_dashboard.php");
            exit();
        } else {
            echo "<div class='alert alert-danger mt-3'>Invalid email or password.</div>";
        }
    }

    $conn->close();
    ?>
</body>
</html>
