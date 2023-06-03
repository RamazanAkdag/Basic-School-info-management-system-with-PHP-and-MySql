<?php
    session_start();
    if(!isset($_SESSION["user_id"])){
        header("location : login.php");
        exit();
    }

    $user_id = $_SESSION["user_id"];

    require("connectDatabase.php");

    //öğrencileri getir
    $sql = "SELECT * FROM students";
    $result = $conn->query($sql);

    echo "<style>
    .student-table {
        width: 100%;
        border-collapse: collapse;
    }
    
    .student-table th,
    .student-table td {
        padding: 10px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }
    
    .student-table th {
        background-color: #f2f2f2;
        font-weight: bold;
    }
    
    .student-table tbody tr:hover {
        background-color: #f9f9f9;
    }
</style>

<table class='student-table'>
    <thead>
        <tr>
            <th>Öğrenci Adı</th>
            <th>Öğrenci Numarası</th>
            <th>Sınıf</th>
            <th>Notlar</th>
        </tr>
    </thead>
    <tbody>";
       /* <tr
            <td></td>
            <td>123456</td>
            <td>11</td>
            <td><a href='addGradeToStudent.php'>Öğrenciye Not Ekleyin</a></td>
        </tr>

        <!-- Diğer öğrencilerin bilgileri buraya eklenebilir -->*/
        while($row = $result->fetch_assoc()){
            echo "<tr>
            <td>".$row["name"]."</td>
            <td>".$row["student_number"]."</td>
            <td>".$row["grade"]."</td>
            <td><a href='addGradeToStudent.php?student_id=".$row["id"]."'>Öğrenciye Not Ekleyin</a></td>
             </tr>";
        }
    echo "</tbody>
        </table>";
  










$conn->close();













?>