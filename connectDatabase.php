<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "school";

$conn = new mysqli($servername, $username, $password, $dbname);

// Hata kontrolü yapılır
if ($conn->connect_error) {
    die("Veritabanına bağlantı sağlanamadı: " . $conn->connect_error);
}


?>