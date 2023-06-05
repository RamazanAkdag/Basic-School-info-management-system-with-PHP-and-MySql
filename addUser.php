
<?php
    session_start();

    if(!isset($_SESSION["user_id"])){
        header("location : index.php");
        exit();
    }

    require("connectDatabase.php");

    if($_SERVER["REQUEST_METHOD"] == "POST"){//rol bilgileri de alınacak
        $username = $_POST["username"];
        $password = $_POST["password"];
        $role = $_POST["role"];

        $sql = "INSERT INTO users (username, password, role) VALUES ('$username', '$password', '$role')";
        if ($result = $conn->query($sql) === TRUE) {
            $newUserId = mysqli_insert_id($conn);
            echo "Kullanıcı başarıyla eklendi!";
        } else {
            echo "Hata: " . $sql . "<br>" . $conn->error;
        }
        //$sql = "SELECT id FROM users WHERE "
        //kullanıcı eklendikten sonra rol bilgisine göre rolünün gerektirdiği bilgileri de alacağız

        echo "<!DOCTYPE html>
        <html>
        <head>
            <title>Admin Kullanıcı Ekle</title>
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
            
            <div class='profile-container'>";
            if($role == "student"){
                echo "<h1>Öğrenci Ekle</h1>
            
                <form action='addUser.php' method='GET'>
                <label for='username'>Kullanıcı Adı:</label>
                <input type='text' id='username' name='username' value='$username' readonly>
                <input type='hidden' id='user_id' name='user_id' value='$newUserId' readonly>
                <br><br>
                <label for='student_number'>öğrenci Numarası:</label>
                <input type='number' id='student_number' name='student_number'>
                <br><br>
                <label for='grade'>sınıfı :</label>
                <input type='number' id='grade' name='grade'>
               
                <input type='submit' value='Ekle'>
            </form>";

            }elseif($role == "teacher"){
                echo "<h1>Öğretmen Ekle</h1>
            
                <form action='addUser.php' method='GET'>
                <label for='username'>Kullanıcı Adı:</label>
                <input type='text' id='username' name='username' value='$username' readonly>
                <input type='hidden' id='user_id' name='user_id' value='$newUserId' readonly>
                <br><br>
                <label for='teacher_number'>öğretmen Numarası:</label>
                <input type='number' id='teacher_number' name='teacher_number'>
                <br><br>
                <label for='department'>branşı :</label>
                <input type='text' id='department' name='department'>
               
                <input type='submit' value='Ekle'>
            </form>";

            }

            echo "
                
            </div>
        </body>
        </html>
        ";

          
        
            exit();

    }elseif($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["username"])){//user de eklenecek
        if(isset($_GET["student_number"])){//öğrenci ise
            $name = $_GET["username"];
            $student_number = $_GET["student_number"];
            $grade = $_GET["grade"];
            $user_id = $_GET["user_id"];
    
            $sql = "INSERT INTO students (name, student_number, grade,user_id) VALUES ('$name', '$student_number', '$grade','$user_id')";
            if ($conn->query($sql) === TRUE) {
                echo "Öğrenci başarıyla kaydedildi.";
            } else {
                echo "Hata: " . $sql . "<br>" . $conn->error;
            }
        }elseif(isset($_GET["teacher_number"])){//eklenen öğretmen ise
            $name = $_GET["username"];
            $teacher_number = $_GET["teacher_number"];
            $department = $_GET["department"];
            $user_id = $_GET["user_id"];
            $sql = "INSERT INTO teachers (name, teacher_number, department,user_id) VALUES ('$name', '$teacher_number', '$department','$user_id')";
            if ($conn->query($sql) === TRUE) {
                echo "Öğretmen başarıyla kaydedildi.";
            } else {
                echo "Hata: " . $sql . "<br>" . $conn->error;
            }
        }
       



        exit();

    }else{
        echo "<!DOCTYPE html>
        <html>
        <head>
            <title>Admin Kullanıcı Ekle</title>
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
            <h1>Kullanıcı Ekle</h1>
            
            <form action='addUser.php' method='post'>
            <label for='username'>Kullanıcı Adı:</label>
            <input type='text' id='username' name='username' required>
            <br><br>
            <label for='password'>Şifre:</label>
            <input type='password' id='password' name='password' required>
            <br><br>
            <label for='role'>Rol:</label>
            <select id='role' name='role'>
                
                <option value='teacher'>Öğretmen</option>
                <option value='student'>Öğrenci</option>
            </select>
            <br><br>
            <input type='submit' value='Ekle'>
        </form>
                
            </div>
        </body>
        </html>
        ";
    



    }

   $conn->close();

?>