

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Registration</title>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="link.css">
</head>


<body>
  <section class="container">
    <div class="login-container">
      <div class="circle circle-one"></div>
      <div class="form-container">
        <img
          src="https://raw.githubusercontent.com/hicodersofficial/glassmorphism-login-form/master/assets/illustration.png"
          alt="illustration" class="illustration" />
        <h2 class="opacity">Register</h2>
        <form method="POST" action="registration.php">
          <input type="text" name="fname" placeholder="USERNAME" />
          <input type="password" name="pass" placeholder="PASSWORD" />
          <button class="opacity" name="sub">SUBMIT</button>
        </form>

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

include_once('function.inc.php');

if (isset($_POST['sub'])) {
  $msg = array();
    $name = mysqli_real_escape_string($conn, $_POST['fname']);

    $pass = mysqli_real_escape_string($conn, $_POST['pass']);

    if (strlen($name) <= 4) {
      $msg[]= "Username must be more than 4 characters.";
  }

  if (strlen($pass) <= 4) {
    $msg[]= "Password must be more than 4 characters.";
}
   // Validate that the username contains only letters
   elseif (!ctype_alpha($name)) {
      $msg[]= "Username must contain only letters.";
  }

  // If all validations pass, you can proceed with further actions
  else {

    // Hash the password
    $hashed_password = password_hash($pass, PASSWORD_DEFAULT);

    // Modify the SQL query to include the hashed password
    $sql = "INSERT INTO user(name, password) VALUES('$name', '$hashed_password')";
    echo $sql;

    if (mysqli_query($conn, $sql)) {
        // Display an alert using JavaScript
        echo '<script>alert("Thank you for registering, ' . $name . '");</script>';

        // Redirect the user after the alert
        echo '<script>window.location.href = "login.php";</script>';
        exit(); // Ensure that no further code is executed after the redirect
    } 
  }
  if( $msg > 0 ){
    foreach( $msg as $m ) {
      echo '<script>alert("' . $m. '");</script>';
    }
  }

}
?>



