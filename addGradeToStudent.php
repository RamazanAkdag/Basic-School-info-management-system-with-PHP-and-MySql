<?php
    session_start();
    if(!isset($_SESSION["user_id"])){
        header("location : index.php");
        exit();
    }
    if($_SERVER["REQUEST_METHOD"] == "POST"){//form gönderildiğinde çalışır ve veri tabanına ekleme yapar
        require("connectDatabase.php");
        $teacher_id = $_POST["teacher_id"];
        $student_id = $_POST["student_id"];
        $grade = $_POST["grade"];
        $course = $_POST["course"];

        $sql = "INSERT INTO grades (grade, course,teacher_id, student_id) VALUES ('$grade', '$course','$teacher_id' ,'$student_id')";

        if ($conn->query($sql) === TRUE) {
            echo "Not başarıyla eklendi.";
        } else {
            echo "Not eklenirken hata oluştu: " . $conn->error;
        }



        exit();
    }
    $user_id = $_SESSION["user_id"];
    $student_id = $_GET["student_id"];
    //veritabanına bağlanılır
    require("connectDatabase.php");
    
    $sql_teacher = "SELECT id FROM teachers WHERE $user_id";
    $result = $conn->query($sql_teacher)->fetch_assoc();
    $teacher_id =  $result["id"];
    
    echo "
    <style>
  .grade-form {
    max-width: 400px;
    margin: 0 auto;
    padding: 20px;
    background-color: #f2f2f2;
    border-radius: 5px;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
  }

  .grade-form label {
    display: block;
    margin-bottom: 10px;
    font-weight: bold;
  }

  .grade-form input[type='number'],
  .grade-form input[type='text'] {
    width: 100%;
    padding: 10px;
    border-radius: 3px;
    border: 1px solid #ccc;
  }

  .grade-form button {
    display: block;
    width: 100%;
    padding: 10px;
    margin-top: 10px;
    background-color: #4CAF50;
    color: #fff;
    border: none;
    border-radius: 3px;
    cursor: pointer;
  }

  .grade-form button:hover {
    background-color: #45a049;
  }
</style>

<div class='grade-form'>
  <form action='addGradeToStudent.php' method='POST'>
    <label for='grade'>Not:</label>
    <input type='number' id='grade' name='grade' required>

    <label for='course'>Ders İsmi:</label>
    <input type='text' id='course' name='course' required>

    <label for='course'>Öğrenci ID:</label>
    <input type='text' name='student_id' value=' $student_id ' readonly>
    <label for='course'>Öğretmen ID:</label>
    <input type='text' name='teacher_id' value=' $teacher_id ' readonly>
    

    <button type='submit'>Notu Kaydet</button>
  </form>
</div>
";

    









$conn->close();


?>
