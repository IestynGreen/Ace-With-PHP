<?php
    session_start();
    $database_name = "test";
    $con = mysqli_connect("localhost", "root", "", $database_name);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>





    <?php
    $query = "SELECT * FROM quizqa ORDER BY Course  ASC  ";
    $result = mysqli_query($con, $query);
    $LastBig = 0;
    $b = 0;
    $Bank = false;
    $Maths = false;
    $Webdev = false;
    $Psychology = false;
    if(mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $ans = array($row['QuizID']);
            $name = array($row['QuizName']);
            $Course = array($row['Course']);
            ?>

            <form action="test.php" method="POST">

            <?php
            for ($x = 0; $x < count($ans); $x++) {
                if ($ans[$x] == $b) {

                } else {

                    echo '<ul>';
                    $b = $ans[$x];


                    ?>
                    <label for=<?php echo $x ?>>
                        <?php
                        if($Course[$x]=="Banking") {
                            if ($Bank == false) {
                                echo'<br>';
                                echo '<u>Banking</u>';
                            }
                                $fair = $ans[$x];
                                echo '<li><a id=' . $fair . ' href="quiztest.php?QuizNum='.$fair.'" >';
                                echo $name[$x], " - Quiz", $ans[$x], " - ", $Course[$x];

                                echo '</a></li></label>';


                                echo '</ul>';
                                $Bank = true;

                        }
                        if($Course[$x]=="Maths") {
                            if ($Maths == false) {
                                echo'<br>';
                                echo '<u>Maths</u>';
                            }
                            $fair = $ans[$x];
                            echo '<li><a id=' . $fair . ' href="quiztest.php?QuizNum='.$fair.'" >';
                            echo $name[$x], " - Quiz", $ans[$x], " - ", $Course[$x];
                            echo '</a></li></label>';


                            echo '</ul>';
                            $Maths = true;
                        }
                        if($Course[$x]=="WebDev") {
                            if ($Webdev == false) {
                                echo'<br>';
                                echo '<u>WebDev</u>';
                            }
                            $fair = $ans[$x];
                            echo '<li><a id=' . $fair . ' href="quiztest.php?QuizNum='.$fair.'" >';
                            echo $name[$x], " - Quiz", $ans[$x], " - ", $Course[$x];
                            echo '</a></li></label>';


                            echo '</ul>';

                            $Webdev = true;

                        }
                        if($Course[$x]=="Psychology") {
                            if ($Psychology == false) {
                                echo'<br>';
                                echo '<u>Psychology</u>';
                            }
                            $fair = $ans[$x];
                            echo '<li><a id=' . $fair . ' href="quiztest.php?QuizNum='.$fair.'" >';
                            echo $name[$x], " - Quiz", $ans[$x], " - ", $Course[$x];
                            echo '</a></li></label>';


                            echo '</ul>';

                            $Psychology = true;

                        }
                }
            }

            if (isset($_POST['Links'])) {
                $_SESSION['QuizNum'] = $_POST['Links'];
            }

        }
    }


    //One page 1

    ?>
            </form>

</head>
<body>





</body>
</html>