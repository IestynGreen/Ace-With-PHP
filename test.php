<?php
    session_start();
    $database_name = "quiz";
    $con = mysqli_connect("localhost", "root", "", $database_name);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <p>hi</p>
    <?php
    $query = "SELECT * FROM quizqa ORDER BY QuestionID ASC ";
    $result = mysqli_query($con, $query);
    $LastBig = 0;
    if(mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $ans = array($row['QuizID']);
            if ($ans[0] > $LastBig) {
                $LastBig = $ans[0];
            }
        }

    }

    for($x = 0; $x < $LastBig; $x++){
        echo'<a href="quiztest.php">';
        echo "Quiz",$x + 1;
        echo '</a>';
        echo '<br>';
    }

    //One page 1
    $_COOKIE['QuizChoice'] = $LastBig;

    ?>
</head>
<body>

</body>
</html>