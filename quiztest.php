<?php
    session_start();
    $database_name = "quiz";
    $con = mysqli_connect("localhost", "root", "", $database_name);
    $QuestionNum = 1;
    $AnswerNum = 0;
    $Score = 0;

    $QuizNum = $_GET['QuizNum'];

    ?>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>TAKE QUIZ</title>
</head>
<body>



<?php

    $query = "SELECT * FROM quizqa ORDER BY QuestionID ASC ";
    $result = mysqli_query($con, $query);

    $query2 = "SELECT * FROM quizlist ORDER BY QuizID ASC";
    $result2 = mysqli_query($con, $query2);


    $CorrectArray = [];
    $ChoiceArray = [];

    $check = false;



    $row3 = mysqli_fetch_array($result2);
    $ham = array($row3["QuizID"]);
    $ham2 = array($row3["Quizname"]);
    for($p = 0; $p < count($ham); $p++) {
        if($ham[$p] == $QuizNum){
            echo '<h1>'.$ham2[$p].'</h1>' ;
        }
    }



   echo '<form action="quiztest.php?QuizNum='.$QuizNum.'" method="post">';
   ?>
        <p>Enter student code</p>
        <input type="number" name="StudentID">
    <?php
    if(mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {

            if($row['QuizID'] == $QuizNum) {

                $ans = array($row['Answer1'], $row['Answer2'], $row['Answer3'], $row['Answer4']);

                shuffle($ans);
                $name = 'Button+'.strval($QuestionNum);
                $val = 'test+'.strval($AnswerNum);



                echo '<p>Question '.$QuestionNum.'</p>';
                echo $row["Question"]; ?>
                <br>
                <p>Select the correct answer below </p>
                <?php foreach ($ans as $choice) {
                    $searchString = " ";
                    $replaceString = "";
                    $choice2 = str_replace($searchString, $replaceString, $choice);
                    ?>

                        <input type=radio name=<?php echo $name ?> value=<?php echo $choice2?>>
                    <label for=<?php echo $name ?>><?php echo $choice ?></label>
                    <?php

                    $AnswerNum += 1;
                    $val = 'test+'.strval($AnswerNum);
                }

                if (isset($_POST[$name])) {

                            // Show the radio button value, i.e. which one was checked when the form was sent
                    $x = $_POST[$name];
                   // echo $x;
                    $ChoiceArray[$QuestionNum] = $x;
                    //array_push($ChoiceArray, $x);
                }
                else{
                    $ChoiceArray[$QuestionNum] = "";
                }

                $choice3 = str_replace($searchString, $replaceString, $row['Answer1']);
                $CorrectArray[$QuestionNum] = $choice3;
                $QuestionNum += 1;

            }
       }
    }

    echo '<button type="submit" name="butt" value="Submit"> Finish Quiz </button>';


        if(isset($_POST["butt"])) {
            for ($i = 1; $i < $QuestionNum; $i++) {
                if ($ChoiceArray[$i] == $CorrectArray[$i]) {
                    $Score += 1;
                }
            }
            echo '<script>alert(' . $Score . ')</script>';
                $StudentID = $_POST["StudentID"];

                $results = ($Score / ($QuestionNum-1)) * 100;

                $resultset = mysqli_query($con, "SELECT * FROM studenttable WHERE StudentID='$StudentID' AND QuizID='$QuizNum'");
                $count = mysqli_num_rows($resultset);


                if ($count == 0) {

                    $query3 = "insert into studenttable(QuizID, StudentID, Score) values('$QuizNum','$StudentID','$results')";
                    $run = mysqli_query($con, $query3) or die(mysqli_error());
                    echo '<script>alert(' . $results . ')</script>';

                } else {
                    echo '<script>alert("You can only sit this test once!")</script>';

                }




        echo'<script>window.location = "home.php"</script>';
    }




                echo'</form>';

    ?>

<br>

</body>
</html>