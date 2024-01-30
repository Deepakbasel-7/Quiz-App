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
    <link rel="stylesheet" href="categories.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap">

</head>

<body>

    <h2>Quiz Categories</h2>
    <div>
        <button id="add">Add new category</button>
        <a style="padding: 30px;" href="http://localhost/project/Admin Panel.php"><button id="add">Back to
                Panel</button> </a>
    </div>


    <div class="add-cat">
        <form action="add-cat.php" method="POST">
            <label for="cate">Category Name</label>
            <input type="text" id="cate" name="cat" required>
            <button type="submit" name="add">Add</button>
        </form>




    </div>

    <div class="table-container">
        <?php


        include_once("conn.php");
        $sql = "SELECT * FROM categories";

        $res = mysqli_query($conn, $sql);

        if (mysqli_num_rows($res) > 0) {
            ?>
            <table border="1" width="60%" cellspacing="0" cellpadding="0">
                <tr>
                    <th>S.N</th>
                    <th>Name</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>

                <?php
                $i = 1;
                while ($row = mysqli_fetch_assoc($res)) {
                    ?>
                    <tr>
                        <td>
                            <?php echo $i; ?>
                        </td>
                        <td>
                            <?php echo $row['cat']; ?>
                        </td>
                        <td><a href="add-cat.php?id=<?php echo $row['id']; ?>">Edit</a></td>
                        <td><a href="deletecat.php?id=<?php echo $row['id']; ?>">Delete</a></td>
                    </tr>
                    <?php
                    $i++;
                }

                ?>
            </table>
            <?php
        }
        ?>

    </div>


    <script>
        function addCat() {
            const addBtn = document.getElementById('add');
            const addCategories = document.querySelector('.add-cat');
            addBtn.addEventListener("click", function () {
                addCategories.style.display = (addCategories.style.display === 'none' || addCategories.style.display === '') ? 'block' : 'none';
            });
        }

        window.addEventListener("load", function () {
            addCat();
        });
    </script>

</body>

</html>