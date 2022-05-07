<?php
session_start();
$database_name = "quiz";
$con = mysqli_connect("localhost", "root", "", $database_name);

$sql = mysqli_query($con,"SELECT MAX(QuizID) FROM quizlist");
$row = mysqli_fetch_array($sql);
$maxID = $row[0];



if(isset($_POST['enter'])){

    if(!empty($_POST['Question']) && !empty($_POST['Answer1']) && !empty($_POST['Answer2']) && !empty($_POST['Answer3']) && !empty($_POST['Answer4'])){
        echo '<script>alert("")</script>';
        $Question = $_POST['Question'];
        $Answer1 = $_POST['Answer1'];
        $Answer2 = $_POST['Answer2'];
        $Answer3 = $_POST['Answer3'];
        $Answer4 = $_POST['Answer4'];

        $query = "insert into quizqa(QuizID, Question, Answer1, Answer2, Answer3, Answer4) values('$maxID', '$Question' , '$Answer1', '$Answer2', '$Answer3', '$Answer4')";
        $run = mysqli_query($con, $query) or die(mysqli_error());
        if($run){
            echo "Form submitted successfully";
        }
        else{
            echo "Form not submitted";
        }
    }
    else{
        echo " all fields required";
    }
}

if(isset($_POST['finish'])) {
    echo '<script>alert("quiz saved")</script>';

    if(!empty($_POST['Question']) && !empty($_POST['Answer1']) && !empty($_POST['Answer2']) && !empty($_POST['Answer3']) && !empty($_POST['Answer4'])){
        echo '<script>alert("")</script>';

        $Question = $_POST['Question'];
        $Answer1 = $_POST['Answer1'];
        $Answer2 = $_POST['Answer2'];
        $Answer3 = $_POST['Answer3'];
        $Answer4 = $_POST['Answer4'];


        $query = "insert into quizqa(QuizID, Question, Answer1, Answer2, Answer3, Answer4) values('$maxID', '$Question' , '$Answer1', '$Answer2', '$Answer3', '$Answer4')";
        $run = mysqli_query($con, $query) or die(mysqli_error());}
    echo'<script> window.location.href = "home.php";</script>';
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>CREATE QUIZ</title>
</head>
<body>
<form action = "createquiz.php" method="post">


    <p>Enter question below</p>
    <input type="text" name="Question">
    <p>Enter correct answer below</p>
    <input type="text" name="Answer1">
    <p>Enter Answer below</p>
    <input type="text" name="Answer2">
    <p>Enter Answer below</p>
    <input type="text" name="Answer3">
    <p>Enter Answer below</p>
    <input type="text" name="Answer4">
    <br>
    <br>
    <button type="submit" name="enter"> Add another Question </button>
    <button type="submit" name="finish"> Finish Quiz </button>
</form>
</body>
</html>