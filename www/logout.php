<?php
setcookie('AUTH','',time()-3600,'','localhost',false,true);
unset($_COOKIE['AUTH']);
header('location: http://localhost');
?>
