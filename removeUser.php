<?php
    session_start();

    if(!isset($_SESSION["user_id"])){
        header("location : index.php");
        exit();
    }

    require("connectDatabase.php");

    if($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["user_id"]) ){
        $user_id = $_GET["user_id"];
        $role = $_GET["role"];
       
        
        if($role == "student"){
            $sql = "SELECT * FROM students WHERE user_id = $user_id" ;
            $student_id = $conn->query($sql);
           // if($student_id->num_rows >0){
                $student_id = $student_id->fetch_assoc();
                $student_id = $student_id["id"];
                
            //}
            $sql = "DELETE FROM grades WHERE student_id = $student_id";
            $conn->query($sql);
            $sql = "DELETE FROM students WHERE user_id = $user_id";
            $conn->query($sql);
        }elseif($role == "teacher"){
            $sql = "SELECT * FROM teachers WHERE user_id = $user_id" ;
            $teacher_id = $conn->query($sql);
           // if($student_id->num_rows >0){
                $teacher_id = $teacher_id->fetch_assoc();
                $teacher_id = $teacher_id["id"];
                
            //}
            $sql = "DELETE FROM grades WHERE teacher_id = $teacher_id";
            $conn->query($sql);
            $sql = "DELETE FROM teachers WHERE user_id = $user_id";
            $conn->query($sql);
        }
       

        $sql = "DELETE FROM users WHERE id = $user_id";
        $conn->query($sql);
        echo "kullanıcı ve rol listesinden silindi";


    }else{
        $sql = "SELECT * FROM users";
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
            <th>Kullanıcı Adı</th>
          
            <th>Rolü</th>
           
        </tr>
    </thead>
    <tbody>";

    while($row = $result->fetch_assoc()){
        echo "<tr>
        <td>".$row["username"]."</td>
        <td>".$row["role"]."</td>
        
        <td><a href='removeUser.php?user_id=".$row["id"]."&role=".$row["role"]."'>Kullanıcının kaydını sil</a></td>
         </tr>";
    }

    echo "</tbody>
    </table>";



    }


    










$conn->close();


    


?>