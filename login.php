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