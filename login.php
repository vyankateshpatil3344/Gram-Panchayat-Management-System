<?php
session_start(); 
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST["username"];
    $password = $_POST["password"];

   
    if ($username === "admin" && $password === "password") {
  
        $_SESSION["username"] = $username;
        header("Location: village_home.php"); 
        exit;
    } else {

        header("Location: login.html?error=1"); 
        exit;
    }
}
?>
