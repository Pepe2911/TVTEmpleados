<?php 
include dirname(__FILE__,2).'/Model/vacaciones.php';
$vacaciones = new vacaciones();

if (isset($_POST['newV'])) {
	if($vacaciones->newSolicitud($_POST)){
        //echo $_GET['page'];
        //die();
       echo true;
    }else{
        echo false;
    }
}
if (isset($_POST['update'])) {
	if($vacaciones->updateStatus($_POST)){
       echo true;
    }else{
        echo false;
    }
}
 ?>