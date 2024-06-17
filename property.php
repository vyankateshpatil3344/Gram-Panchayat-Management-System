<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = new mysqli("localhost", "root", "", "tax");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $name = $_POST['name'];
    $homeNo = $_POST['homeNo'];
    $yearFrom = $_POST['yearFrom'];
    $yearTo = $_POST['yearTo'];
    $totalFees = $_POST['totalFees'];
    $remainingFee = $_POST['remainingFee'];

    $sql = "INSERT INTO your_table_name (name, homeNo, yearFrom, yearTo, totalFees, remainingFee)
            VALUES ('$name', '$homeNo', '$yearFrom', '$yearTo', '$totalFees', '$remainingFee')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
