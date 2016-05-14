<?php
require_once('D:/wamp/www/req/pass.php');
if(isset($_POST['register_submit'])&&!empty($_POST['register_submit']))
{
  $error='';
  if(isset($_POST['register_username'])&&!empty($_POST['register_username']))
  {
    $username=$_POST['register_username'];
  }
  else
  {
    $error.="Username is not defined+";
  }
  if(isset($_POST['register_password'])&&!empty($_POST['register_password']))
  {
    $password=$_POST['register_password'];
  }
  else
  {
    $error.="Password is not defined+";
  }
  if(isset($_POST['register_cpassword'])&&!empty($_POST['register_cpassword']))
  {
    $cpassword=$_POST['register_cpassword'];
  }
  else
  {
    $error.="Confirm password is not defined+";
  }
  if(empty($error))
  {
    try
    {
      $con=new PDO('mysql:host=localhost;dbname=auth;charset=utf8mb4',$dbu,$dbp);
    }
    catch(PDOException $e)
    {

    }
  }
}
?>
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
          <input type="password" class="loginformtext" placeholder="Password" name="register_password">
          <div class="loginformlabel">Confirm Password</div>
          <input type="password" class="loginformtext" placeholder="Password" name="register_cpassword">
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
