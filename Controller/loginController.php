<?php
include dirname(__FILE__,2)."/Model/login.php";
$Login = new login();
    if($Login->Login($_POST)){
        header('location: ../index.php');
    }else{
        header('location: ../login.php?error=true');
    }
