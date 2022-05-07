<?php

session_start();
$database_name = "quiz";
$con = mysqli_connect("localhost", "root", "", $database_name);

if(isset($_POST['finish'])) {
    header("createquiz.php");
    if(!empty($_POST['QuizName']) && !empty($_POST['Courses']) ){
        $QuizName = $_POST['QuizName'];
        $Course = $_POST['Courses'];

        $query = "insert into quizlist(Course,Quizname) values ('$Course', '$QuizName')";
        mysqli_query($con, $query) or die(mysqli_error());
        echo'<script> window.location.href = "createquiz.php";</script>';


    }

}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>CREATE QUIZ</title>
</head>
<body>
<form action = "quizstart.php" method="post">
    <p>Enter Quiz Name below</p>
    <input type="text" name="QuizName">

    <p>Select the courses</p>
    <select name="Courses" id="Courses">
        <option value="WebDev">WebDev</option>
        <option value="Psychology">Psychology</option>
        <option value="Banking">Banking</option>
        <option value="Maths">Maths</option>
    </select>
    <button type="submit" name="finish"> Start Making Quiz </button>

</form>
</body>
</html>