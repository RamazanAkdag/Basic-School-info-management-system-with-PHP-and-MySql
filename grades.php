<?php
session_start();

if(!isset($_SESSION["user_id"])){
    header("Location : index.php");
    exit();
}

$user_id = $_SESSION["user_id"];

// Veritabanı bağlantısı yapılır
require("connectDatabase.php");


    $student_query = "SELECT * FROM `students` WHERE user_id = $user_id";
    $result = $conn->query($student_query);
    //if ($result->num_rows == 1)
    $student_id = $result->fetch_assoc()["id"];
    $grades_query = "SELECT * FROM grades WHERE student_id = $student_id";
    $result = $conn->query($grades_query);


echo "<!DOCTYPE HTML>
<html>
    <head>
        <title>Kullanıcı bilgileri</title>
        <style>
            table {
  border-collapse: collapse;
  border-spacing: 0;
  width: 100%;
  border: 1px solid #ddd;
}

th, td {
  text-align: left;
  padding: 16px;
}

tr:nth-child(even) {
  background-color: #f2f2f2;
}
        </style>
    </head>
    <body>";
echo "<table>
        <tr>
            <th>Course</th>
            <th>note</th>
        </tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row["course"] . "</td>";

    echo "<td>" . $row["grade"] . "</td>";
    echo "</tr>";
}

echo "</table>
</body>
</html>
";

   



$conn->close();


?>
<!DOCTYPE html>
<html>
    <head>

    </head>
    <body>
        
    </body>

</html>



   