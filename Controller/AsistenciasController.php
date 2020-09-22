<?php
include dirname(__FILE__, 2).'/Model/asistencia.php';
include dirname(__FILE__, 2).'/Model/SpReporte.php';
$asist = new asistencia();
$reporte = new SpReporte();
if(isset($_GET['create'])){
            if($asist->asistencias($_POST,$_GET['fecha'])){
                header('location: ../index.php?page='.$_GET['page'].'&successAsist=true');
            }else{
               header('location: ../index.php?page='.$_GET['page'].'&errorAsist=true');
            }
}
if(isset($_POST['SpReporte']))
{
    echo json_encode( $reporte->getSpReporteAsist($_POST));
}
if(isset($_POST['getAsist'])){
    echo json_encode( $asist->getAsist($_POST['EventID']));
}
if(isset($_POST['UpdateAsist'])){
    if($asist->UpdateAsist($_POST)){
        header('location: ../index.php?page='.$_GET['page'].'&successUpdate=true');
    }else{
        header('location: ../index.php?page='.$_GET['page'].'&errorUpdate=true');
    }
}
if (isset($_POST['NewUserAsist'])){
    if($asist->newUserAsist($_POST)){
        header('location: ../index.php?page='.$_GET['page'].'&successAsist=true');
    }else{
        header('location: ../index.php?page='.$_GET['page'].'&errorAsist=true');
    }
}
if (isset($_POST['deleteUserAsist'])){
    if($asist->deleteUserAsist($_POST['EventID'])){
        echo json_encode(["success"=>true]);
    }else{
        echo json_encode(["error"=>true]);
    }
}
