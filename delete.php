<?php

session_start();
if(!isset($_SESSION["user"]) or $_SESSION["user"] !== 'admin'){
    header("location: login.php");
}

function __autoload($class){
    include_once($class.".php");
}
$obj = new admin();

if(!empty($_GET['id'])){
    $id = $_GET['id'];
    if($obj->deleteStudent($id))
        header("location: adminHome.php");
}

?>