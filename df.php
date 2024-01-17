<?php
header('Content-Type: application/json'); // Set the content type to JSON

$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$age = $_POST['age'] ?? ''; // Age is likely to be an integer
$gender = $_POST['gender'] ?? '';
$enrollment = $_POST['enroll'] ?? ''; // Enrollment might be an integer
$department = $_POST['department'] ?? '';
$division = $_POST['division'] ?? '';
$address = $_POST['address'] ?? '';

try {
    $conn = new mysqli('localhost', 'root', '', 'student_db');
    
    if ($conn->connect_error) {
        die('{"status": "error", "message": "Connection failed: ' . $conn->connect_error . '"}');
    } else {
        $stmt = $conn->prepare("INSERT INTO student_info (name, email, age, gender, enrollment, department, division, address) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssss", $name, $email, $age, $gender, $enrollment, $department, $division, $address);
        
        if ($stmt->execute()) {
            $stmt->close();
            $conn->close();
            
            // Returning a JSON response to indicate success
            echo '{"status": "success", "message": "Form submitted successfully"}';
        } else {
            throw new Exception('{"status": "error", "message": "Failed to execute the statement"}');
        }
    }
} catch (Exception $e) {
    // Catching any exceptions that might occur during database operations
    echo $e->getMessage();
}
?>
