<?php
session_start();
if (!isset($_SESSION['AdminLoginId'])) {
    echo "<script>alert('Please log in as admin first!!'); window.location='Admin Login.php';</script>";
    exit();
}
?>
<?php

include_once("conn.php");
$id = $_GET['id'];

    $sql2 = "DELETE FROM categories WHERE id = $id";

    echo $sql2;

    

    $res2 = mysqli_query( $conn, $sql2 );
    if( $res2 ) {
        header('Location: http://localhost/project/categories.php');
    } else {
        ?>
        <script>alert('Adding Unsuccessfull!!');</script>
        <?php
    }


?>