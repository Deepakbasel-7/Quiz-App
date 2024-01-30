
<?php
session_start();
include('conn.php');
error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Quiz</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">

</head>
<style>
  .blinking {
    animation: blinkingText 1.2s infinite;
  }

  @keyframes blinkingText {
    0% {
      color: #FFEB3B;
    }

    49% {
      color: #FF5722;
    }

    60% {
      color: #429600;
    }

    99% {
      color: #e91e1e;
    }

    100% {
      color: #FFF;
    }
  }
body{
  background-color: #555;
}
<style>
  body {
    background-color: #222;
    color: #fff;
    font-family: Arial, sans-serif;
  }

  .container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
    background-color: #333;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
  }

  h1.blinking {
    animation: blinkingText 1.2s infinite;
  }

  @keyframes blinkingText {
    0% {
      color: #FFEB3B;
    }
    49% {
      color: #FF5722;
    }
    60% {
      color: #429600;
    }
    99% {
      color: #e91e1e;
    }
    100% {
      color: #FFF;
    }
  }



  .btn-danger {
    background-color: #DC3545;
    border: none;
  }

  .btn-danger:hover {
    background-color: #a02633;
  }

  table {
    width: 100%;
    border-collapse: collapse;
  }

  th,
  td {
    padding: 10px;
    text-align: center;
  }

  th {
    background-color: #444;
  }

  tr:nth-child(even) {
    background-color: #555;
  }

  tr:nth-child(odd) {
    background-color: #666;
  }
</style>



<body>
  <header class="d-flex justify-content-between my-4">


    <div class="text-center">
      <a href="login.php" class="btn btn-danger">
        <i class="fas fa-sign-out-alt"></i> Log out
      </a>
    </div>
  </header>

  <div class="container">
  
    <div class="card-body text-white">
        <table class="table table-dark table-hover">
            <?php
            // Initialize an array to store the results for each category
            $categoryResults = array();

            if (isset($_POST['sub'])) {
                if (isset($_POST['options'])) {
                    foreach ($_POST['options'] as $questionId => $selectedOption) {
                        // Use regular expression to extract the last number
                        if (preg_match('/(\d+)$/', $selectedOption, $matches)) {
                            $lastNumber = $matches[0];

                            $sql = "SELECT * FROM questions WHERE qid = $questionId";
                            $res = mysqli_query($conn, $sql);

                            if ($res) {
                                $row = mysqli_fetch_assoc($res);

                                // Check if the selected option matches the correct answer
                                $isCorrect = ($lastNumber == $row['correct_ans']);

                                // Update the category results
                                $category = $row['categories'];
                                if (!isset($categoryResults[$category])) {
                                    $categoryResults[$category] = array('total' => 0, 'correct' => 0);
                                }

                                $categoryResults[$category]['total']++;
                                if ($isCorrect) {
                                    $categoryResults[$category]['correct']++;
                                }
                            } else {
                                echo 'Error in query: ' . mysqli_error($conn);
                            }
                        }
                    }

                    // Display the user's score for each category
                    foreach ($categoryResults as $category => $result) {
                        $totalQuestions = $result['total'];
                        $correctAnswers = $result['correct'];
                        echo '<h1 class="text-center blinking text-white">' . $category . '</h1>';
                        // echo "<td>Total Questions: $totalQuestions</td>";
                        // echo "<td>$correctAnswers</td>";
                        
                    }
                } else {
                    echo 'No options selected.';
                }
            }
            ?>
            <tr>
                <th>Attempted Questions</th>
                <th>Your Score is :</th>
            </tr>
            <tr>
                <td><?php echo $totalQuestions; ?></td>
                <td><?php echo $correctAnswers; ?></td>
            </tr>
        </table>
    </div>
</div>

</body>
</html>