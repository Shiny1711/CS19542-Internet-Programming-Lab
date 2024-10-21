<?php
session_start(); // Start the session

// Database connection
$servername = "localhost:3307"; // Update if necessary
$username = "root"; // Update if necessary
$password = ""; // Update if necessary
$dbname = "hotel_booking"; // Ensure this is your correct database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the admin is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    echo "You must be logged in as an admin to access this page.";
    exit();
}

// SQL query to fetch user and booking details
$sql = "SELECT u.id AS user_id, u.username, u.email, b.room_type, b.checkin_date, b.checkout_date, b.number_of_members 
        FROM users u 
        LEFT JOIN bookings b ON u.id = b.user_id"; // Ensure 'id' matches your actual users table primary key

$result = $conn->query($sql);

// Check if there are results
if ($result->num_rows > 0) {
    // Start HTML structure
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Dashboard</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <div class="container mt-5">
            <h2>Admin Dashboard</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Room Type</th>
                        <th>Check-In Date</th>
                        <th>Check-Out Date</th>
                        <th>Number of Members</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Fetch and display data
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['user_id']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['username']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['room_type']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['checkin_date']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['checkout_date']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['number_of_members']) . "</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
            <a href="admin_logout.php" class="btn btn-danger mt-3">Logout</a>
        </div>
    </body>
    </html>
    <?php
} else {
    echo "No bookings found.";
}

// Close the database connection
$conn->close();
?>
