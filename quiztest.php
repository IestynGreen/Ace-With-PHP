<?php
    session_start();
    $database_name = "quiz";
    $con = mysqli_connect("localhost", "root", "", $database_name);
    $QuestionNum = 1;
    $AnswerNum = 0;
    $Score = 0;
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

    $CorrectArray = [];
    $ChoiceArray = [];

    if(mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {


            $ans = array($row['Answer1'], $row['Answer2'], $row['Answer3'], $row['Answer4']);
            shuffle($ans);
            $name = 'Button+'.strval($QuestionNum);
            $val = 'test+'.strval($AnswerNum);

            ?>

            <form action="quiztest.php" method="POST">

            <?php echo '<p>Question '.$QuestionNum.'</p>';
            echo $row["Question"]; ?>
            <br>
            <p>Select the correct answer below </p>
            <?php foreach ($ans as $choice) { ?>
                    <input type=radio name=<?php echo $name ?> value=<?php echo $choice?>>
                <label for=<?php echo $name ?>> <?php echo $choice ?><br></label>
                <?php

                $AnswerNum += 1;
                $val = 'test+'.strval($AnswerNum);
            }

            if (isset($_POST[$name])) {
                // Show the radio button value, i.e. which one was checked when the form was sent
                $x = $_POST[$name];
                $ChoiceArray[$QuestionNum] = $x;
                array_push($ChoiceArray, $x);
            }
            else{
                $ChoiceArray[$QuestionNum] = "";
            }
            $CorrectArray[$QuestionNum] = $row['Answer1'];
            $QuestionNum += 1;
        }

    }


echo '<button type="submit" name="butt" value="Submit"> Finish Quiz </button>';
echo'</form>';
    if (isset($_POST["butt"])) {
        for ($i = 1; $i < $QuestionNum; $i++) {
            //echo $CorrectArray[$i];
                if ($ChoiceArray[$i] == $CorrectArray[$i]) {
                    $Score += 1;
                }
        }
        echo '<script>alert(' . $Score . ')</script>';
    }

    ?>

<br>

</body>
</html>