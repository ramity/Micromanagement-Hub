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
        <form action="http://localhost/login.php" method="post" class="login">
          <div class="loginheader">Login</div>
          <div class="loginformlabel">Username</div>
          <input type="text" class="loginformtext" placeholder="Username" name="login_username" autocomplete="off">
          <div class="loginformlabel">Password</div>
          <input type="text" class="loginformtext" placeholder="Password" name="login_password">
          <input type="submit" class="loginformsubmit" value="Login" name="login_submit">
        </form>
      </div>
    </div>
