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
  <title>Codes</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
  </body>
  <style>
    body {
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
      margin: 0;
      background-color: #f8f9fa;
      /* Set your desired background color */
    }

    


    .data {
      background-color: #f8f9fa;
      padding: 20px;
      border-radius: 10px;
    }

    .quiz-form {
      width: 60%;
      /* Adjust this value based on your requirements */
      padding: 20px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
      /* Adjust the shadow as needed */
    }

    .form-group {
      margin-bottom: 15px;
    }

    .btn-success {
      background-color: #28a745;
      border-color: #28a745;
    }

    .btn-success:hover {
      background-color: #218838;
      border-color: #1e7e34;
    }

    h2 {
      text-align: center;
      color: #007bff;
    }
  </style>
</head>

<body>

  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div class="top-buttons">
          <button class="btn btn-secondary" onclick="goBack()">Back</button>
        </div>
      </div>
    </div>
    <div class="row justify-content-center">
      <form method="post" onsubmit="return validateForm()" class="quiz-form">
        <h2>Add a Question</h2>
        <div class="form-group">
          <label for="ques">Question:</label>
          <input type="text" class="form-control" id="ques" placeholder="Enter Question" name="question" required>
        </div>
        <div class="form-group">
          <label for="o1">Option 1:</label>
          <input type="text" class="form-control" id="o1" placeholder="Enter Option" name="option1" required>
        </div>
        <div class="form-group">
          <label for="o2">Option 2:</label>
          <input type="text" class="form-control" id="o2" placeholder="Enter Option" name="option2" required>
        </div>
        <div class="form-group">
          <label for="o3">Option 3:</label>
          <input type="text" class="form-control" id="o3" placeholder="Enter Option" name="option3" required>
        </div>
        <div class="form-group">
          <label for="o4">Option 4:</label>
          <input type="text" class="form-control" id="o4" placeholder="Enter Option" name="option4" required>
        </div>
        <div class="form-group">
          <label for="o4">Select Categories:</label>
          <?php
          include_once('conn.php');

          $sql = "SELECT * FROM categories";

          $res = mysqli_query($conn, $sql);

          if (mysqli_num_rows($res)) {
            ?>
            <select name="categories" id="">
              <option value="" disabled>Select categories:</option>
              <?php
              while ($row = mysqli_fetch_assoc($res)) {
                ?>

                <!-- <option value="">Cat1</option> -->
                <option value="<?php echo $row['cat']; ?>">
                  <?php echo $row['cat']; ?>
                </option>

                <?php
              }
              ?>
            </select>
            <?php
          }
          ?>

        </div>
        <div class="form-group">
          <label for="c">Correct Option (1-4):</label>
          <input type="number" class="form-control" id="c" name="correct" required>
        </div>

        <button type="submit" name="sub" class="btn btn-success">Add Question</button>
      </form>
    </div>
  </div>

  <div>
    <!-- Your PHP code for displaying messages -->
    <?php
    include("conn.php");

    if (isset($_POST['sub'])) {
      $ques = trim($_POST['question']);
      $options = array(
        'first' => $_POST['option1'],
        'second' => $_POST['option2'],
        'third' => $_POST['option3'],
        'fourth' => $_POST['option4']
      );

      $optionsString = implode(',', $options);
      echo '<script> console.log("' . $optionsString . '")</script>';


    

      $categories = $_POST['categories'];
      $correct = $_POST['correct'];

      $options = array($_POST['option1'], $_POST['option2'], $_POST['option3'], $_POST['option4']);
      $sql = "SELECT MAX(qid) AS last_insert_id FROM questions";
      $sql1 = "SELECT * FROM questions";
      $data1 = mysqli_query($conn, $sql1);
      $data = mysqli_query($conn, $sql);
      $row = mysqli_fetch_assoc($data);
      $lastInsertId = $row['last_insert_id'];
      $next_id = $lastInsertId + 1; // Incrementing the last ID by 1
    
      if ($data1) {
        $question = array();
        while ($row = mysqli_fetch_assoc($data1)) {
          $question[] = $row['question'];
        }
      }

      if (in_array($ques, $question)) {
        echo '<script>alert(" Question Already Added!!")</script>';



      } else {
        $sql = "INSERT INTO `questions`(`question`, `options`, `categories`, `correct_ans`) VALUES ('$ques','$optionsString','$categories', '$correct')";

        // echo $sql;

        if ($conn->query($sql) === TRUE) {
          $last_id = $conn->insert_id;
          for ($i = 0; $i < count($options); $i++) {
            $option = $options[$i];
            // $sql2 = "INSERT INTO `answer`(`answer`, `ans_id`) VALUES ('$option','$last_id')";
            // mysqli_query($conn, $sql2);
          }
          echo '<script>alert(" Question Added Successfully!!")</script>';



        } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
        }
      }
    }
    ?>
  </div>

  <script>
    function validateForm() {
      var correctOption = document.getElementById("c").value;
      var options = [document.getElementById("o1").value, document.getElementById("o2").value, document.getElementById("o3").value, document.getElementById("o4").value];
      if (correctOption < 1 || correctOption > 4) {
        alert("Please select a valid option!!");
        return false;
      }
      return true;
    }

    function goBack() {
      window.history.back();
    }
  </script>

</body>

</html>