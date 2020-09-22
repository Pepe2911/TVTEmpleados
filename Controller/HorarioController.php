<?php
include dirname(__FILE__, 2).'/Model/horario.php';
$horario = new Horario();

if(isset($_POST['getHorario'])){
    echo json_encode( $horario->getHorarioById($_POST['EventID']));
}
if(isset($_POST['EditHorario'])){
    if ($horario->UpdateHorario($_POST)){
        header('location: ../index.php?page='.$_GET['page'].'&successuHorario=true');
    }
    else
    {
        header('location: ../index.php?page='.$_GET['page'].'&errorHorario=true');
    }
}
if(isset($_POST['newHorario'])){
    if ($horario->newHorario($_POST)){
        header('location: ../index.php?page='.$_GET['page'].'&successuHorario=true');
    }
    else
    {
        header('location: ../index.php?page='.$_GET['page'].'&errorHorario=true');
    }
}
if(isset($_POST['deleteHorario'])){
    if ($horario->deleteHorario($_POST['EventID'])){
        echo json_encode(["success"=>true]);
    }else{
        json_encode(["error"=>true]);
    }
}
?>