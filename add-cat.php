<?php
session_start();
if (!isset($_SESSION['AdminLoginId'])) {
    echo "<script>alert('Please log in as admin first!!'); window.location='Admin Login.php';</script>";
    exit();
}
?>
<?php

// add categories
include_once("conn.php");
if (isset($_POST['add'])) {
    $name = mysqli_real_escape_string($conn, $_POST['cat']);
    $sql2 = "INSERT INTO categories(cat) VALUES( '{$name}')";

    echo $sql2;



    $res2 = mysqli_query($conn, $sql2);
    if ($res2) {
        header('Location: http://localhost/project/categories.php');
    } else {
        ?>
        <script>alert('Adding Unsuccessfull!!');</script>
        <?php
    }
}




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap"> -->

    <link rel="stylesheet" href="categories.css">
</head>

<body>

    //Update categories
    <div class="edit add-cat">
        <?php
        $id = $_GET['id'];
        // echo $id;
        $sql = "SELECT * FROM categories WHERE id = $id";

        $res = mysqli_query($conn, $sql);
        if (mysqli_num_rows($res) > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                ?>
                <form action="" method="POST">
                    <label for="cate">Category Name</label>
                    <input type="text" id="cate" value="<?php echo $row['cat']; ?>" name="update_cat" required>
                    <button type="submit" name="update">Update</button>
                </form>
                <?php
            }
        }


        if (isset($_POST['update'])) {
            $update_cat = mysqli_real_escape_string($conn, $_POST['update_cat']);

            $sql1 = "UPDATE categories SET cat = '$update_cat' WHERE id = $id";

            echo $sql1;

            $res1 = mysqli_query($conn, $sql1);

            if ($res1) {
                header('Location: http://localhost/project/categories.php');
            } else {
                ?>
                <script>alert('Adding Unsuccessfull!!');</script>
                <?php
            }
        }

        ?>





    </div>
</body>

</html>