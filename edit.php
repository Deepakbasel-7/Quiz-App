<?php
session_start();
if (!isset($_SESSION['AdminLoginId'])) {
    echo "<script>alert('Please log in as admin first!!'); window.location='Admin Login.php';</script>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>Edit Question</title>
</head>

<body>
    <div class="container my-5">
        <header class="d-flex justify-content-between my-4">
            <h1>Edit Question</h1>
            <div>
                <a href="dashboard.php" class="btn btn-primary">Back</a>
            </div>
        </header>
        <form action="process.php" method="post">
            <?php

            if (isset($_GET['id'])) {
                include("conn.php");
                $id = $_GET['id'];
                $sql = "SELECT * FROM questions WHERE qid=$id";
                $answer= "SELECT * FROM answer WHERE ans_id=$id";
                echo '<script>console.log("' . $answer . '"); </script>';
                $result1 = mysqli_query($conn, $sql);
                $result2 = mysqli_query($conn, $answer);
                $ques = mysqli_fetch_array($result1);
                $row1 = mysqli_fetch_array($result2);
                $result2->data_seek(0);

                ?>
                
                <div class="form-elemnt my-4">
                    <input type="text" class="form-control" name="question" placeholder="Question:"
                        value="<?php echo $ques["question"]; ?>">
            </div>
                <?php
                $i=1;
                while ($row = $result2->fetch_assoc()) {
                    // Access the column values
                    $aid = $row["aid"];
                    $answer = $row["answer"];
                    echo '<div class="form-elemnt my-4">';
                    echo '<label for="pwd">Option '.$i.' :</label>';
                    echo '<input type="hidden" name="aid'.$i.'" value="'.$aid.'">';
                    echo '<input type="text" class="form-control" id="'.$aid.'" placeholder="Enter Option" name="option'.$i.'" required value="' . $answer . '">';
                $i++;
                }
                ?>
                <div class="form-elemnt my-4">
                    <label>Correct Option:</label>
                    <input type="number" class="form-control" id="c" name="correct" value="<?php echo $ques["correct"]; ?>" required>
                </div>
                <input type="hidden" value="<?php echo $id; ?>" name="id">
                <div class="form-element my-4">
                    <input type="submit" name="edit" value="Edit Question" class="btn btn-primary">
                </div>
                <?php
            } else {
                echo "<h3>Question Does Not Exist</h3>";
            }
            ?>

        </form>


    </div>
</body>

</html>