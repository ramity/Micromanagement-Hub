<?php
require_once('D:/wamp/www/req/pass.php');
require_once('D:/wamp/www/req/modules/auth.php');
require_once('D:/wamp/www/req/modules/require_secure_false');

$min_username_length=3;
$max_username_length=20;

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
    if($password!==$cpassword)
    {
      $error.="Passwords do not match+";
    }

    if(!ctype_alnum($username))
    {
      $error.="Username contains illegal characters+";
    }

    if($min_username_length>strlen($username))
    {
      if((strlen($username)-$max_username_length)==1)
        $error.="Username is ".($min_username_length-strlen($username))." character under length+";
      else
        $error.="Username is ".($min_username_length-strlen($username))." characters under length+";
    }

    if(strlen($username)>$max_username_length)
    {
      if((strlen($username)-$max_username_length)==1)
        $error.="Username is ".(strlen($username)-$max_username_length)." character over length+";
      else
        $error.="Username is ".(strlen($username)-$max_username_length)." characters over length+";
    }
  }
  if(empty($error))
  {
    try
    {
      $con=new PDO('mysql:host=localhost;dbname=auth;charset=utf8mb4',$dbu,$dbp);
      $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
      $con->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
      $state=$con->prepare('SELECT username FROM users WHERE username=:username');
      $state->bindValue(':username',$username);
      $check_a=$state->fetchAll();

      if(empty($check_a))
      {
        $con->beginTransaction();

        $state=$con->prepare('INSERT INTO users (username,password,ip,date_created,last_active) VALUES (:username,:password,:ip,:date_created,:last_active)');

        $state->bindValue(':username',$username);
        $state->bindValue(':password',password_hash($password,PASSWORD_BCRYPT));
        $state->bindValue(':ip',$_SERVER['REMOTE_ADDR']);
        $state->bindValue(':date_created',date("m/d/Y_H:i:s:u"));
        //save token to be generated at login
        $state->bindValue(':last_active',date("m/d/Y_H:i:s:u"));
        $check_b=$state->execute();

        $con->commit();

        if($check_b)
        {
          header('Location:http://localhost/login.php');
        }
        else
        {
          $con->rollBack();
        }
      }
      else
      {
        $error.='The requested username is alread in use';
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
        <div class="logininf">
          <b>Requirements:</b>
          <ul>
            <li>Username:</li>
            <ul>
              <li>Characters: a-z, A-Z, 0-9 (Alphanumeric only)</li>
              <li>Length: <?php echo $min_username_length.'-'.$max_username_length;?> characters</li>
            </ul>
          </ul>
        </div>
      </div>
    </div>
