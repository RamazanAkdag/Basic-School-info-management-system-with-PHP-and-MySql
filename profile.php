<?php
session_start();

// Kullanıcı oturumunu kontrol et
if (!isset($_SESSION["user_id"])) {
    header("Location: index.php");
    exit();
}

$user_id = $_SESSION["user_id"];

// Veritabanı bağlantısı yapılır
require("connectDatabase.php");

// Kullanıcı bilgilerini getir
$sql = "SELECT * FROM users WHERE id = $user_id";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $user = $result->fetch_assoc();

    // Kullanıcı bilgilerini göster
    /*echo "<h2>Kullanıcı Bilgileri</h2>";
    echo "<p>Kullanıcı Adı: " . $user["username"] . "</p>";
    echo "<p>Rol: " . $user["role"] . "</p>";*/
    
   
    // Kullanıcı rolüne göre özel bilgileri göster
    if ($user["role"] == "student") {
        // Öğrenci bilgilerini getir
        $sql = "SELECT * FROM students WHERE user_id = $user_id";
        $result = $conn->query($sql);
    
        if ($result->num_rows == 1) {
            $student = $result->fetch_assoc();
    
            // Profil bilgilerini göster
            echo "<!DOCTYPE html>
                    <html>
                    <head>
                        <title>Profil</title>
                        <style>
                            /* CSS stilleri */
                            body {
                                font-family: Arial, sans-serif;
                                background-color: #f2f2f2;
                                margin: 0;
                                padding: 20px;
                            }
                            
                            .profile-container {
                                max-width: 500px;
                                margin: 0 auto;
                                background-color: #fff;
                                padding: 20px;
                                border-radius: 5px;
                                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
                            }
                            
                            h1 {
                                text-align: center;
                            }
                            
                            .profile-info {
                                margin-bottom: 20px;
                            }
                            
                            .profile-info label {
                                font-weight: bold;
                            }
                            
                            .profile-info p {
                                margin: 0;
                            }
                        </style>
                    </head>
                    <body>
                        
                        <div class='profile-container'>
                        <h1>Kullanıcı Bilgileri</h1>
                        <div class='profile-info'>
                        <p>  <label>Kullanıcı Adı:</label> " . $user["username"] . "</p>
                        <br>
                        <p>  <label>Kullanıcı Rolü:</label>" . $user["role"] . "</p>
                    
                        </div>
                            <h1>Öğrenci Profili</h1>
                            
                            <div class='profile-info'>
                                <label>Ad:</label>
                                <p>" . $student["name"] . "</p>
                            </div>
                            
                            <div class='profile-info'>
                                <label>Öğrenci Numarası:</label>
                                <p>" . $student["student_number"] . "</p>
                            </div>
                            
                            <div class='profile-info'>
                                <label>Sınıf:</label>
                                <p>" . $student["grade"] . "</p>
                            </div>
                            
                            <div class='profile-info'>
                                <label><a href='grades.php'>Notlarınızı görüntülemek için tıklayınız</a></label>
                            </div>
                            
                        </div>
                    </body>
                    </html>";
        }
    } elseif ($user["role"] == "teacher") {
        // Öğretmen bilgilerini getir
        $sql = "SELECT * FROM teachers WHERE user_id = $user_id";
        $result = $conn->query($sql);
    
        if ($result->num_rows == 1) {
            $teacher = $result->fetch_assoc();
    
            // Profil bilgilerini göster
            echo "<!DOCTYPE html>
                    <html>
                    <head>
                        <title>Profil</title>
                        <style>
                            /* CSS stilleri */
                            body {
                                font-family: Arial, sans-serif;
                                background-color: #f2f2f2;
                                margin: 0;
                                padding: 20px;
                            }
                            
                            .profile-container {
                                max-width: 500px;
                                margin: 0 auto;
                                background-color: #fff;
                                padding: 20px;
                                border-radius: 5px;
                                box-shadow: 0 2px;
                            }
                            h1 {
                                text-align: center;
                            }
                            
                            .profile-info {
                                margin-bottom: 20px;
                            }
                            
                            .profile-info label {
                                font-weight: bold;
                            }
                            
                            .profile-info p {
                                margin: 0;
                            }
                        </style>
                    </head>
                    <body>
                        <div class='profile-container'>
                            <h1>Öğretmen Profili</h1>
                            
                            <div class='profile-info'>
                                <label>Ad:</label>
                                <p>" . $teacher["name"] . "</p>
                            </div>
                            
                            <div class='profile-info'>
                                <label>Branş:</label>
                                <p>" . $teacher["department"] . "</p>
                            </div>
                            <div class='profile-info'>
                                 <label><a href='addGrade.php'>Not Eklemek için tıklayınız</a></label>
                            </div>
                        </div>
                      
                             
                    
                    </body>
                    </html>";
        }
    }elseif($user["role"] == "admin"){

        $sql = "SELECT * FROM admins WHERE user_id = $user_id";
        $result = $conn->query($sql);

        if($result->num_rows == 1){
            $admin = $result->fetch_assoc();

            echo "<!DOCTYPE html>
                    <html>
                    <head>
                        <title>Profil</title>
                        <style>
                            /* CSS stilleri */
                            body {
                                font-family: Arial, sans-serif;
                                background-color: #f2f2f2;
                                margin: 0;
                                padding: 20px;
                            }
                            
                            .profile-container {
                                max-width: 500px;
                                margin: 0 auto;
                                background-color: #fff;
                                padding: 20px;
                                border-radius: 5px;
                                box-shadow: 0 2px;
                            }
                            h1 {
                                text-align: center;
                            }
                            
                            .profile-info {
                                margin-bottom: 20px;
                            }
                            
                            .profile-info label {
                                font-weight: bold;
                            }
                            
                            .profile-info p {
                                margin: 0;
                            }
                        </style>
                    </head>
                    <body>
                        <div class='profile-container'>
                            <h1>Admin Profili</h1>
                            
                            <div class='profile-info'>
                                <label>Ad:</label>
                                <p>" . $admin["name"] . "</p>
                            </div>
                            
                            <div class='profile-info'>
                                <label>admin mail:</label>
                                <p>" . $admin["email"] . "</p>
                            </div>
                            <div class='profile-info'>
                                 <label><a href='addUser.php'>Kullanıcı Eklemek için Tıklayınız</a></label>
                            </div>
                            <div class='profile-info'>
                                 <label><a href='removeUser.php'>Kullanıcı Silmek için Tıklayınız</a></label>
                            </div>
                        </div>
                      
                             
                    
                    </body>
                    </html>";
        }

    }
    
}

$conn->close();
?>


