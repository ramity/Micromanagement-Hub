<?php
$secure=[];
$secure['login']=false;
if(isset($_COOKIE['AUTH'])&&!empty($_COOKIE['AUTH']))
{
  try
  {
    $parts=explode('+',$_COOKIE['AUTH']);
    $userid=$parts[0];
    $token=$parts[1];

    $con=new PDO('mysql:host=localhost;dbname=auth;charset=utf8mb4',$dbu,$dbp);
    $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $con->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);
    $state=$con->prepare('SELECT username,token FROM users WHERE id=:id');
    $state->bindValue(':id',$userid);
    $values=$state->fetchAll();

    if(!empty($values))
    {
      if($token===password_hash($values[0]['token'],PASSWORD_BCRYPT))
      {
        $secure['login']=true;
        $secure['username']=$values[0]['username'];
      }
      else
      {
        //kill cookie
        unset($_COOKIE['AUTH']);
        setcookie('AUTH','',time()-3600,'','localhost',false,true);
      }
    }
    else
    {
      //kill cookie
      unset($_COOKIE['AUTH']);
      setcookie('AUTH','',time()-3600,'','localhost',false,true);
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
  $state->bindValue(':id',$check_a[0]['id']);
  $state->bindValue(':token',$token);
  $result=$state->execute();
  if($result)
  {
    setcookie('AUTH',$check_a[0]['id'].'+'.password_hash($token,PASSWORD_BCRYPT),time()+(60*60*24*31),'','localhost',false,true);
  }
}
?>
