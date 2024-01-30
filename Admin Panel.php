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
    <link rel="stylesheet" href="adminpanel.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap">

    <title>Admin Panel</title>


</head>

<body>
    <div class="header">
        <h2>WELCOME TO ADMIN PANEL -
            <?php echo $_SESSION['AdminLoginId'] ?>
        </h2>
        <div>
            <ul class="menu">
                <li><a href="categories.php" class="button">Categories</a></li>
                <li><a href="dashboard.php" class="button">Add Question</a></li>

            </ul>
        </div>


        <div class="content">

            <div>
                <?php include_once("content.php"); ?>
            </div>
        </div>
        <form method="POST">
            <button name="Logout">LOG OUT</button>
        </form>

        <?php
        if (isset($_POST['Logout'])) {
            session_destroy();
            header("location: Admin Login.php");
        }
        ?>
</body>

</html>