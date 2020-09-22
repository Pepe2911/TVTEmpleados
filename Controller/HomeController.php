<?php
include dirname(__FILE__,2).'/Model/Empleado.php';
$users = new Empleado();

if(isset($_POST['Empleado']))
{   
    
        if($users->newEmpleado($_POST)){
        $tmpFilePath = $_FILES['uploadedfile']['tmp_name'];
        //Make sure we have a file path
        if ($tmpFilePath != ""){
            //Setup our new file path
            $newFilePath = "../assets/img/users/" . $_FILES['uploadedfile']['name'];

            //Upload the file into the temp dir
            if(move_uploaded_file($tmpFilePath, $newFilePath)) {
                
                header('location: ../index.php?page='.$_GET['page'].'&success=true');
            }
            else{
                
                header('location: ../index.php?page='.$_GET['page'].'&success=true');
            }
        }else{
            header('location: ../index.php?page='.$_GET['page'].'&success=true');
        }

    }else{
            header('location: ../index.php?page='.$_GET['page'].'&error=true');
    }
}
if(isset($_POST['info']))
{
        echo json_encode($users->getUserById($_POST['eventID']));
}
if(isset($_POST['delete']))
{
    if($users->deleteUser($_POST['eventID'])){
        echo json_encode(["successDelete"=>true]);
    }else{
        echo json_encode(["errorDelete"=>true]);
    }
}
if(isset($_POST['infoE']))
{
    echo json_encode($users->getEmpleadoById($_POST['eventID']));
}
if(isset($_POST['observacion']))
{
    if($users->createObservacion($_POST)){
        $tmpFilePath = $_FILES['uploadedfile']['tmp_name'];

        //Make sure we have a file path
        if ($tmpFilePath != ""){
            //Setup our new file path
            $newFilePath = "../assets/img/Evidencia/" . $_FILES['uploadedfile']['name'];

            //Upload the file into the temp dir
            if(move_uploaded_file($tmpFilePath, $newFilePath)) {
                header('location: ../index.php?page='.$_GET['page'].'&successObservacion=true');
            }
            else{
                header('location: ../index.php?page='.$_GET['page'].'&errorObservacionNoImagen=true');
            }
        }else{
            header('location: ../index.php?page='.$_GET['page'].'&successObservacion=true');
        }

    }else{
        header('location: ../index.php?page='.$_GET['page'].'&errorObservacion=true');
    }



}
if(isset($_POST['observaciones']))
{
    echo json_encode($users->getObservacionById($_POST['eventID']));
}
if(isset($_POST['obs']))
{
    echo json_encode($users->getObsById($_POST['eventID']));
}
if(isset($_POST['UpdateObs']))
{
    if($users->updateChofer($_POST)){
       header('location: ../index.php?page='.$_GET['page'].'&successEditObs=true');
    }else{
        header('location: ../index.php?page='.$_GET['page'].'&errorEditObs=true');
    }
}
if(isset($_POST['deleteObs']))
{
    if($users->deleteObs($_POST['eventID'])){
        echo json_encode(["success"=>true]);
    }else{
        echo json_encode(["error"=>true]);
    }
}
if(isset($_POST['evidencia']))
{
    echo json_encode($users->getEvidencia($_POST['eventID']));
}
if(isset($_POST['updateEmpleado']))
{
    $tmpFilePath = $_FILES['uploadedfile']['tmp_name'];
    $newFilePath = "../assets/img/users/" . $_FILES['uploadedfile']['name'];
    //Upload the file into the temp dir
    move_uploaded_file($tmpFilePath, $newFilePath);
    if($users->updateEmpleado($_POST)){
        header('location: ../index.php?page='.$_GET['page'].'&successEdit=true');
    }else{
        header('location: ../index.php?page='.$_GET['page'].'&errorEdit=true');
    }

}
if(isset($_POST['deleteEvidencia']))
{
    if($users->deleteEvidencia($_POST['eventID'])){
        echo json_encode(["successDelete"=>true]);
    }else{
        echo json_encode(["errorDelete"=>true]);
    }

}
if(isset($_POST['evidenciaAdd'])){
    $tmpFilePath = $_FILES['uploadedfile']['tmp_name'];
    $newFilePath = "../assets/img/Evidencia/" . $_FILES['uploadedfile']['name'];
    $tamano_archivo = $_FILES['uploadedfile']['size'];

    //Upload the file into the temp dir
    if(move_uploaded_file($tmpFilePath, $newFilePath)){
        if($users->AddEvidencia($_POST)){
            header('location: ../index.php?page='.$_GET['page'].'&successEvidencia=true');
        }else{
            header('location: ../index.php?page='.$_GET['page'].'&errorEvidencia=true');
        }
    }else{

        header('location: ../index.php?page='.$_GET['page'].'&errorEvidenciass=true');
    }

}

