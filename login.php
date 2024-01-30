<!DOCTYPE html>
<html lang="en">

<head>
  <title>LOGIN</title>
  <link rel="stylesheet" type="text/css" href="link.css" />
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
  <section class="container">
    <div class="login-container">
      <div class="circle circle-one"></div>
      <div class="form-container">

        <h2 class="opacity">LOGIN</h2>
        <form method="POST" action="user.php">
          <input type="text" name="fname" placeholder="USERNAME" />
          <input type="password" name="pass" placeholder="PASSWORD" />
          <button class="opacity" name="sub">SUBMIT</button>
        </form>
        <div class="register-forget opacity">
          <a href="registration.php">REGISTER</a>
        </div>
      </div>
      <div class="circle circle-two"></div>
    </div>
    <div class="theme-btn-container"></div>
  </section>
</body>

</html>

<script src="test.js"></script>

<?php
include("conn.php");
session_start();

if (isset($_POST['sub'])) {
  $user = $_POST['fname'];
  $pass = $_POST['pass'];

  // Check if both username and password are not empty
  if (!empty($user) && !empty($pass)) {
    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM user WHERE name = ?");
    $stmt->bind_param("s", $user);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($result->num_rows == 1 && password_verify($pass, $row['password'])) {
      // Password is correct
      // Store user information in the session
      $_SESSION['user_id'] = $row['id'];
      $_SESSION['fname'] = $user;

      // Redirect to quiz.php
      header("Location: quiz.php");
      exit();
    } else {
      // Redirect back to the login page with an error parameter
      header("Location: login.php?error=1");
      exit();
    }
  } else {
    // Redirect back to the login page with an error parameter for empty fields
    header("Location: login.php?error=2");
    exit();
  }

}
?>

<script>
  // Check if there's an error parameter in the URL
  const urlParams = new URLSearchParams(window.location.search);
  const error = urlParams.get('error');

  // Display alert if there's an error parameter
  if (error === '1') {
    alert("Invalid credentials. Please try again.");
  } else if (error === '2') {
    alert("Please enter both username and password.");
  }
</script>