<!DOCTYPE html>
  <head>
    <title>Ramity Hub</title>
    <link rel="stylesheet" type="text/css" href="http://localhost/css/main.css">
    <link rel="stylesheet" type="text/css" href="http://localhost/css/login.css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
  </head>
  <body>
    <?php require_once('D:/wamp/www/req/parts/bars.php')?>
    <div id="container">
      <div id="containerinr">
        <form action="http://localhost/register.php" method="post" class="login">
          <div class="loginheader">Register</div>
          <div class="loginformlabel">Desired Username</div>
          <input type="text" class="loginformtext" placeholder="Username" name="register_username" autocomplete="off">
          <div class="loginformlabel">Password</div>
          <input type="text" class="loginformtext" placeholder="Password" name="register_password">
          <div class="loginformlabel">Confirm Password</div>
          <input type="text" class="loginformtext" placeholder="Password" name="register_cpassword">
          <input type="submit" class="loginformsubmit" value="Register" name="register_submit">
        </form>
        <div class="registerinf">
          <b>Requirements:</b>
          <ul>
            <li>Username:</li>
            <ul>
              <li>Characters: a-z, A-Z, 0-9 (Alphanumeric only)</li>
              <li>Length: 3-20 characters</li>
            </ul>
          </ul>
        </div>
      </div>
    </div>
