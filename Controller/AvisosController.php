<?php
include dirname(__FILE__, 2).'/Model/Avisos.php';
$aviso = new Avisos();

if (isset($_POST['NewAviso'])){
    if($aviso->newAviso($_POST)){
        header('location: ../index.php?page='.$_GET['page'].'&successAsist=true');
    }else{
        header('location: ../index.php?page='.$_GET['page'].'&errorAsist=true');
    }
}
if (isset($_POST['updateAviso'])){
    if($aviso->updateAviso($_POST)){
        header('location: ../index.php?page='.$_GET['page'].'&successAsist=true');
    }else{
        header('location: ../index.php?page='.$_GET['page'].'&errorAsist=true');
    }
}
if (isset($_POST['getAviso'])){
    echo json_encode($aviso->getAvisoById($_POST['EventID']));
}
if (isset($_POST['deleteAviso'])){
    if ($aviso->deleteAviso($_POST['EventID'])){
        echo json_encode(["success"=>true]);
    }else{
        json_encode(["error"=>true]);
    }
}
