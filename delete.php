<?php
session_start();
if (!isset($_SESSION['AdminLoginId'])) {
    echo "<script>alert('Please log in as admin first!!'); window.location='Admin Login.php';</script>";
    exit();
}
?>
<?php
if (isset($_GET['id'])) {
include("conn.php");
$id = $_GET['id'];
$sql = "DELETE FROM questions WHERE qid='$id'";
// $sql2 = "DELETE FROM answer WHERE ans_id =$id";
if(mysqli_query($conn,$sql)){
    // mysqli_query($conn,$sql2);
    session_start();
    $_SESSION["delete"] = "Question Deleted Successfully!";
    header("Location:dashboard.php");
}else{
    die("Something went wrong");
}
}else{
    echo "Question does not exist";
}
?>