<?php
    session_start();
    $database_name = "quiz";
    $con = mysqli_connect("localhost", "root", "", $database_name);
    $QuestionNum = 1;
    $AnswerNum = 1;
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





    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)){



            $ans2 =$ans=array($row['Answer1'],$row['Answer2'],$row['Answer3'],$row['Answer4']);
            shuffle($ans);

            echo '<form action="quiztest.php" method="POST">';

            echo "<p>Question.$QuestionNum</p>";
            echo $row["Question"];
            echo "<br>";
            echo "<p>Select the correct answer below </p>";
            foreach($ans as $choice) {
                echo "<input type='radio' name=string($AnswerNum)>".$choice."</input><br>";

            }
            $QuestionNum += 1;

        }
            echo '<button type="submit" name="butt"> Finish Quiz </button>';
            echo $row;

                if (isset($_POST['butt'])) {
                    for ($i = 0; $i < $AnswerNum; $i++) {
                        echo ($row);
                        if ($i == isset($ans2[2])){
                            echo '<script>alert("Correct")</script>';
                        }
                    }

                }


    }



    ?>
<br>

</body>
</html>