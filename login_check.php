<?php


  
  session_start();
include_once("conn.php");


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

      // Redirect to user.php
      header("Location: user.php");
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