<?php
session_start();          // ← ADD THIS (line 1!)
include 'config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name    = $_POST['name'];
    $age     = $_POST['age'];
    $address = $_POST['address'];
    $class   = $_POST['class'];

    $sql = "INSERT INTO students (name, age, address, class)
            VALUES ('$name', '$age', '$address', '$class')";

    if (mysqli_query($conn, $sql)) {
        $_SESSION['student_id'] = mysqli_insert_id($conn); 
        $_SESSION['name']       = $name;                   
        header("Location: index.php");
        exit();                                            
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>