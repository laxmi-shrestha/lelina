<?php
$host="localhost";
$user="root";
$password="";
$database="lelina";

$conn =mysqli_connect($host,$user,$password,$database);
if(! $conn){
    die("connection failed-something went wrong");
}



?>