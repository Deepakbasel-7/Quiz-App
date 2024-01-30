
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <title>Question List</title>
    <style>
        table td,
        table th {
            vertical-align: middle;
            text-align: left;
            padding: 20px !important;
        }


        body {
            background-color: #222;
        }

        .d-flex justify-content-between my-4,
        h1 {
            color: whitesmoke;
        }
    </style>
</head>

<body>
    <header class="d-flex justify-content-between my-4">

        <div>
            <a href="http://localhost/project/Admin Panel.php" class="btn btn-primary">Back</a>
        </div>
    </header>
    <div class="container my-4">
        <header class="d-flex justify-content-between my-4">
            <h1><b>Questions</b></h1>
            <div>
                <a href="add.php" class="btn btn-success">Add New Question</a>
            </div>
        </header>
        <?php
        session_start();
        if (isset($_SESSION["create"])) {
            ?>
            <div class="alert alert-success">
                <?php
                echo $_SESSION["create"];
                ?>
            </div>
            <?php
            unset($_SESSION["create"]);
        }
        ?>
        <?php
        if (isset($_SESSION["update"])) {
            ?>
            <div class="alert alert-success">
                <?php
                echo $_SESSION["update"];
                ?>
            </div>
            <?php
            unset($_SESSION["update"]);
        }
        ?>
        <?php
        if (isset($_SESSION["delete"])) {
            ?>
            <div class="alert alert-success">
                <?php
                echo $_SESSION["delete"];
                ?>
            </div>
            <?php
            unset($_SESSION["delete"]);
        }
        ?>

        <table class="table table-hover table-dark">
            <thead>
                <tr>
                    <!-- <th>Qid</th> -->
                    <th>Question</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

                <?php
                include('conn.php');
                $sqlSelect = "SELECT * FROM questions";
                $result = mysqli_query($conn, $sqlSelect);
                while ($data = mysqli_fetch_array($result)) {
                    ?>
                    <tr>
                        <!-- <td><?php // echo $data['qid']; ?></td> -->
                        <td>
                            <?php echo $data['question']; ?>
                        </td>

                        <td>
                            <a href="edit.php?id=<?php echo $data['qid']; ?>" class="btn btn-warning">Edit</a>
                            <a href="delete.php?id=<?php echo $data['qid']; ?>" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>

</body>

</html>