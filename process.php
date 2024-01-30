<?php
include('conn.php');
if (isset($_POST["create"])) {
    $title = mysqli_real_escape_string($conn, $_POST["title"]);
    $type = mysqli_real_escape_string($conn, $_POST["type"]);
    $author = mysqli_real_escape_string($conn, $_POST["author"]);
    $description = mysqli_real_escape_string($conn, $_POST["description"]);
    $sqlInsert = "INSERT INTO books(title , author , type , description) VALUES ('$title','$author','$type', '$description')";
    if(mysqli_query($conn,$sqlInsert)){
        session_start();
        $_SESSION["create"] = "Question Added Successfully!";
        header("Location:dashboard.php");
    }else{
        die("Something went wrong");
    }
}
if (isset($_POST["edit"])) {
    $question= mysqli_real_escape_string($conn, $_POST["question"]);
    $options = array($_POST['option1'], $_POST['option2'],$_POST['option3'], $_POST['option4']);
    $aids = array($_POST['aid1'], $_POST['aid2'],$_POST['aid3'], $_POST['aid4']);
    $correct= mysqli_real_escape_string($conn, $_POST["correct"]);
    echo '<script>console.log("'.$aids[0].'"); </script>';
    echo '<script>console.log("'.$aids[1].'"); </script>';
    echo '<script>console.log("'.$aids[2].'"); </script>';
    echo '<script>console.log("'.$aids[3].'"); </script>';
    $id = mysqli_real_escape_string($conn, $_POST["id"]);
    $sqlUpdate = "UPDATE questions SET question = '$question',correct = $correct WHERE qid='$id'";
    for ($i = 0; $i < count($aids); $i++) {
        $option = $options[$i];
        $aid = $aids[$i];
        $sql2 = "UPDATE answer SET answer = '$option' WHERE aid='$aid'";
        mysqli_query($conn, $sql2);
      }
    if(mysqli_query($conn,$sqlUpdate)){
        session_start();
        $_SESSION["update"] = "Question Updated Successfully!";
        header("Location:dashboard.php");
    }else{
        die("Something went wrong");
    }
}
?>