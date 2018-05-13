<?php
// host_name bisa diganti kalau database server tidak sama dengan web server
$host_name = $_SERVER['SERVER_NAME']; 
$database_name = "latihan";
$user_name = "hacker";
$password = "2e3n6nNHa8vDjbce";

try {
    // kalau port bukan default 3306, bisa ditambahkan parameter port
    $connection = new PDO("mysql:host=$host_name;dbname=$database_name", $user_name, $password);
    // set the PDO error mode to exception
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected successfully";
} catch (PDOException $error) {
    die("Connection failed: " . $error->getMessage());
}
