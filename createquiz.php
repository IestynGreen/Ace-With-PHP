<?php
    session_start();
    $database_name = "test";
    $con = mysqli_connect("localhost", "root", "", $database_name);

$sql = mysqli_query($con,"SELECT MAX(QuizID) FROM quizqa");
$row = mysqli_fetch_array($sql);
$maxID = $row[0];

$Webdev = false;
$Psychology = false;
$Maths = false;
$Banking = false;


    if(isset($_POST['enter'])){

        if(!empty($_POST['Question']) && !empty($_POST['Answer1']) && !empty($_POST['Answer2']) && !empty($_POST['Answer3']) && !empty($_POST['Answer4'])){
            echo '<script>alert("")</script>';
            $Question = $_POST['Question'];
            $Answer1 = $_POST['Answer1'];
            $Answer2 = $_POST['Answer2'];
            $Answer3 = $_POST['Answer3'];
            $Answer4 = $_POST['Answer4'];

            $QuizName = $_POST['QuizName'];
            $Courses = $_POST['Courses'];

            $query = "insert into quizqa(QuizID, Question, Answer1, Answer2, Answer3, Answer4, QuizName, Course) values('$maxID', '$Question' , '$Answer1', '$Answer2', '$Answer3', '$Answer4', '$QuizName', '$Courses')";
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

    $sql = mysqli_query($con,"SELECT MAX(QuizID) FROM quizqa");
    $y = mysqli_fetch_array($sql);
    $nextID = ($y[0]+1);

    $Question = $_POST['Question'];
    $Answer1 = $_POST['Answer1'];
    $Answer2 = $_POST['Answer2'];
    $Answer3 = $_POST['Answer3'];
    $Answer4 = $_POST['Answer4'];

    $QuizName = $_POST['QuizName'];
    $Courses = $_POST['Courses'];

    $query = "insert into quizqa(QuizID, Question, Answer1, Answer2, Answer3, Answer4, QuizName, Course) values('$nextID', '$Question' , '$Answer1', '$Answer2', '$Answer3', '$Answer4', '$QuizName', '$Courses')";
    $run = mysqli_query($con, $query) or die(mysqli_error());}



        }

$query = "SELECT * FROM quizqa ORDER BY QuestionID ASC ";
$result = mysqli_query($con, $query);


?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>CREATE QUIZ</title>
    </head>
    <body>


    //Want to use previous ID to make an if statement. If Quiz ID == Current ID{Do not display Enter quiz name and courses and display add questions} else if it doesnt then its a new quiz and will allow user to enter new quiz name and course



    <?php

    ?>
        <form action = "createquiz.php" method="post">
            <p>Enter Quiz Name below</p>
            <input type="text" name="QuizName">

            <p>Select the courses</p>
            <select name="Courses" id="Courses">
                <option value="WebDev">WebDev</option>
                <option value="Psychology">Psychology</option>
                <option value="Banking">Banking</option>
                <option value="Maths">Maths</option>
            </select>

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
                <button type="submit" name="enter"> Add Question to Quiz </button>
                <button type="submit" name="finish"> Begin New Quiz (This is the first question) </button>
        </form>
    </body>
</html>