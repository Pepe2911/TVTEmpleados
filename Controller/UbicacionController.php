<?php
include dirname(__FILE__,2).'/Model/Ubicacion.php';
$punto = new Ubicacion();
if (isset($_POST['NewPunto'])){
    if ($punto->NewUbicacion($_POST)){
        header('location: ../index.php?page='.$_GET['page'].'&successubicacion=true');
    }
    else{
        header('location: ../index.php?page='.$_GET['page'].'&errorUbicacion=true');
    }
}
if (isset($_POST['getPunto'])){
    echo json_encode($punto->getUbicacionById($_POST['EventID']));
}
if (isset($_POST{'deletePunto'})){
    if ($punto->deletePunto($_POST['EventID'])){
        echo json_encode(["success"=>true]);
    }else{
        json_encode(["error"=>true]);
    }
}
if (isset($_POST{'EditPunto'})){
    if($punto->updatePunto($_POST)){
        header('location: ../index.php?page='.$_GET['page'].'&successAsist=true');
    }else{
        header('location: ../index.php?page='.$_GET['page'].'&errorAsist=true');
    }
}