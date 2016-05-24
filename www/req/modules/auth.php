<?php
require_once('D:/wamp/www/req/pass.php');

$secure=[];
$secure['login']=false;

if(isset($_COOKIE['AUTH'])&&!empty($_COOKIE['AUTH']))
{
  try
  {
    $parts=explode('+',$_COOKIE['AUTH']);
    $userid=$parts[0];
    $tokenhash=$parts[1];

    $con=new PDO('mysql:host=localhost;dbname=auth;charset=utf8mb4',$dbu,$dbp);
    $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $con->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
    $state=$con->prepare('SELECT id,username,token FROM users WHERE id=:id');
    $state->bindValue(':id',$userid);
    $state->execute();
    $values=$state->fetchAll();

    if(!empty($values))
    {
      if(password_verify($values[0]['token'],$tokenhash))
      {
        $secure['login']=true;
        $secure['username']=$values[0]['username'];
      }
      else
      {
        //kill cookie
        unset($_COOKIE['AUTH']);
        setcookie('AUTH','',time()-3600,'/','',false,true);
      }
    }
    else
    {
      //kill cookie
      unset($_COOKIE['AUTH']);
      setcookie('AUTH','',time()-3600,'/','',false,true);
    }
  }
  catch(PDOException $e)
  {
    echo 'An error has occured';
    echo $e->getMessage();
  }
}

if($secure['login'])
{
  $token=substr(md5(rand()),0,256);
  $state=$con->prepare("UPDATE users SET token=:token WHERE id=:id");
  $state->bindValue(':id',$values[0]['id']);
  $state->bindValue(':token',$token);
  $result=$state->execute();
  if($result)
  {
    setcookie('AUTH',$values[0]['id'].'+'.password_hash($token,PASSWORD_BCRYPT),time()+(60*60*24*7),'/','',false,true);
  }
}
?>
