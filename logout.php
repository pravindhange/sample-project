<?php

session_start();


unset($_COOKIE["test"]);
//setcookie("username",'', time()-60);
//setcookie("password",'', time()-60);

session_unset();
session_destroy();
header("location: login.php");


/*unset($_COOKIE["test"]);
unset($_COOKIE["username"]);
unset($_COOKIE["password"]);
setcookie("username",'', time()-60);
setcookie("password",'', time()-60);
session_unset();
session_destroy();
//header("location: login.php");

echo "you are logged out";
print_r($_COOKIE);
print_r($_SESSION);*/
?>
