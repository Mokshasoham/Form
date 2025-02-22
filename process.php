<?php
$file = 'db_connection.php';
if (!file_exists($file)) {
    die("Error: Database connection file not found!");
}

include $file;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password
    $message = $_POST['message'];
    $terms = isset($_POST['terms']) ? "Accepted" : "Not Accepted";

    // Check if email already exists
    $check_email = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($check_email);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "Error: This email is already registered. Please use another email.";
    } else {
        // Insert new user data
        $sql = "INSERT INTO users (name, email, password, message, terms) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssss", $name, $email, $password, $message, $terms);

        if ($stmt->execute()) {
            echo "Registration successful!";
            header("Location: success.html");
        } else {
            echo "<script>alert('Error: Could not register. Please try again.'); window.location.href='index.html';</script>";
        }
    }
    $stmt->close();
    $conn->close();
}
?>
