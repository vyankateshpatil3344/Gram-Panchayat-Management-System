<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form data
    $full_name = $_POST["full_name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];
    $address = $_POST["address"];
    $phone_number = $_POST["phone_number"];
    // Process the Aadhar card upload if needed (not included in this example)

    // Perform validation (e.g., check password match, email format, etc.)
    if ($password != $confirm_password) {
        echo "Error: Passwords do not match.";
        exit; // Stop further processing
    }

    // Hash the password for security (you should use a stronger hashing algorithm in production)
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Store the registration data in a database or file (not included in this example)
    // For demonstration, let's just display the registered user's information
    echo "Registration successful! Details:<br>";
    echo "Full Name: $full_name<br>";
    echo "Email: $email<br>";
    echo "Address: $address<br>";
    echo "Phone Number: $phone_number<br>";
    // Additional processing for Aadhar card upload if needed
} else {
    header("Location: register.html");
    exit; // Stop further processing
}
?>
