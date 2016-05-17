<?php
require_once('D:/wamp/www/req/pass.php');

$min_username_length=3;
$max_username_length=20;

if(isset($_POST['login_submit'])&&!empty($_POST['login_submit']))
{
  $error='';

  if(isset($_POST['login_username'])&&!empty($_POST['login_username']))
  {
    $username=$_POST['login_username'];
  }
  else
  {
    $error.="Username is not defined+";
  }

  if(isset($_POST['login_password'])&&!empty($_POST['login_password']))
  {
    $password=$_POST['login_password'];
  }
  else
  {
    $error.="Password is not defined+";
  }

  if(empty($error))
  {
    if(!ctype_alnum($username))
    {
      $error.="Username contains illegal characters+";
    }
  }
  if(empty($error))
  {
    try
    {
      $con=new PDO('mysql:host=localhost;dbname=auth;charset=utf8mb4',$dbu,$dbp);
      $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
      $con->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
      $state=$con->prepare('SELECT id,password FROM users WHERE username=:username');
      $state->bindValue(':username',$username);
      $values=$state->fetchAll();

      if(empty($values))
      {
        $error.='Incorrect username/password combination+';
      }
      else
      {
        if(password_verify($password,$values[0]['password']))
        {
          $token=substr(md5(rand()),0,256);
          $state=$con->prepare("UPDATE users SET token=:token WHERE id=:id");
          $state->bindValue(':id',$values[0]['id']);
          $state->bindValue(':token',$token);
          $result=$state->execute();
          if($result)
          {
            setcookie('AUTH',$values[0]['id'].'+'.password_hash($token,PASSWORD_BCRYPT),time()+(60*60*24*31),'','localhost',false,true);
            header('Location:http://localhost/');
          }
        }
        else
        {
          $error.='Incorrect username/password combination+';
        }
      }
    }
    catch(PDOException $e)
    {
      echo 'An error has occured';
      echo $e->getMessage();
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
        <form action="http://localhost/login.php" method="post" class="login">
          <div class="loginheader">Login</div>
          <div class="loginformlabel">Username</div>
          <input type="text" class="loginformtext" placeholder="Username" name="login_username" autocomplete="off">
          <div class="loginformlabel">Password</div>
          <input type="password" class="loginformtext" placeholder="Password" name="login_password">
          <input type="submit" class="loginformsubmit" value="Login" name="login_submit">
        </form>
        <?php
        if(!empty($error))
        {
          echo '<div class="errorinf">';
          echo '<b>Error creating account:</b>';
          echo '<ul>';
          $errors=explode('+',$error);
          foreach($errors as $errorline)
          {
            if(!empty($errorline))
              echo '<li>'.$errorline.'</li>';
          }
          echo '</ul>';
          echo '</div>';
        }
        ?>
      </div>
    </div>
