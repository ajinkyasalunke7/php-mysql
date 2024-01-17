<?php
$servername = "localhost"; // Change this to your server name
$username = "root"; // Change this to your database username
$password = ""; // Change this to your database password
$dbname = "student_db"; // Change this to your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $age = $_POST['age'] ?? 0; // Default value set to 0
    $gender = $_POST['gender'] ?? '';
    $enrollment = $_POST['enroll'] ?? 0; // Default value set to 0
    $department = $_POST['department'] ?? '';
    $division = $_POST['division'] ?? '';
    $address = $_POST['address'] ?? '';

    // Prepare and bind the SQL statement
    $stmt = $conn->prepare("INSERT INTO student_info (name, email, age, gender, enrollment, department, division, address) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

    // Check if the statement preparation was successful
    if ($stmt) {
        $stmt->bind_param("ssisiss", $name, $email, $age, $gender, $enrollment, $department, $division, $address);

        // Execute the SQL statement
        if ($stmt->execute()) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Error in preparing statement: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>
