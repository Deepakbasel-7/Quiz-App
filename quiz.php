<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <title>Quiz Page</title>
  <style>


    .blink {
      animation: blink 1s infinite;
    }

    .golden {
      color: #FF5722;
      font-size: 1.5em;
      font-weight: bold;
      text-shadow: 2px 2px 4px #000;
    }
  </style>
</head>
<script>
    var timeLimit = 60;

    function updateTimer() {
      var minutes = Math.floor(timeLimit / 60);
      var seconds = timeLimit % 60;
      document.getElementById("timer").innerHTML = minutes + "m " + seconds + "s";

      if (timeLimit <= 0) {
        document.querySelector("form").submit();
      } else {
        timeLimit--;
        setTimeout(updateTimer, 1000);
      }
    }

    window.onload = function () {
      updateTimer();
      setInterval(function() {
        document.getElementById("quizApp").classList.toggle("blink");
      }, 1000);
    };
  </script>
<body class="bg-dark text-light">
  <?php
session_start();
// echo $_SESSION['fname'];
if( isset( $_SESSION['fname'] ) ) {

  ?>
<div class="text-center">
  <b id="answerNow" class="golden">Answer Now!!</b><br>
  <b id="timeRemaining" class="golden">Time Remaining: </b><span id="timer" class="golden">1m 0s</span><br>
</div>
<nav class="navbar navbar-dark bg-dark">
  <a href="user.php" class="btn btn-secondary mr-auto">Back</a>
  <!-- <span class="navbar-brand mb-0 h1" id="quizApp" class="blink">Quiz App</span> -->
 
</nav>

<div class="container mt-4">
  <table class="table table-dark table-hover">
    <thead>
      <tr>
        <th>Question</th>
        <th>Options</th>
      </tr>
    </thead>
    <tbody class="table-hover">
      <form action="http://localhost/project/result.php" method="POST">
        <?php
        include_once('conn.php');
        $selectedCategory = isset($_POST['selectedCategory']) ? $_POST['selectedCategory'] : '';

        $sqlQuestions = "SELECT * FROM questions WHERE categories = '$selectedCategory'";
        $resQuestions = mysqli_query($conn, $sqlQuestions);
        if (mysqli_num_rows($resQuestions) > 0) {
          while ($rowQuestion = mysqli_fetch_assoc($resQuestions)) {
        ?>
            <tr>
              <td><?php echo $rowQuestion['question']; ?></td>
              <td>
                <ul class="list-unstyled">
                  <?php
                  $separates = explode(',', $rowQuestion['options']);
                  $i = 1;
                  foreach ($separates as $separate) {
                  ?>
                    <li class="table-hover">
                      <label>
                        <input type="radio" name="options[<?php echo $rowQuestion['qid']; ?>]" value="<?php echo $i; ?>">
                        <?php echo $separate; ?>
                      </label>
                    </li>
                  <?php
                    $i++;
                  }
                  ?>
                </ul>
              </td>
            </tr>
        <?php
          }
        } else {
          echo "<tr><td colspan='2'>No questions available for the selected category.</td></tr>";
        }
        ?>
        <tr>
          <td colspan="2" class="text-center">
            <input type="submit" name="sub" class="btn btn-primary">
          </td>
        </tr>
      </form>
    </tbody>
  </table>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<?php } else {
  header('Location: login.php');
}
?>
</body>


</html>
