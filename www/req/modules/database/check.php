<?php
require_once('D:/wamp/www/req/pass.php');
require_once('D:/wamp/www/req/modules/auth.php');

die('Deprecated');

try
{
  $con=new PDO('mysql:host=localhost;dbname=auth;charset=utf8',$dbu,$dbp);
  $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
  $con->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);

  $state=$con->prepare("SELECT id FROM users");
  $result=$state->execute();

  if($result)
  {
    $con=new PDO('mysql:host=localhost;dbname=connector;charset=utf8',$dbu,$dbp);
    $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $con->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);

    $state=$con->prepare("SHOW TABLES LIKE ''");
    $result=$state->execute();

    if($result)
    {
      $values=$state->fetchAll();
      if(!empty($values))
      {
        print_r($values);
      }
      else
      {
        echo 'Unable to retrieve tables';
      }
    }
  }
  else
  {
    echo 'Unable to get user values';
  }
}
catch(PDOException $e)
{
  die($e->getMessage());
}
?>
