<?php
include dirname(__FILE__,2).'/Model/Chofer.php';
$choferes = new Chofer();
if(isset($_POST['create']))
{
    /*print_r($_POST);
    echo"<br>";
    print_r($_FILES);
    die();*/
    if($choferes->newUserChofer($_POST)){
        $tmpFilePath = $_FILES['uploadedfile']['tmp_name'];
        $tmpFilePath2 = $_FILES['Licencia']['tmp_name'];
        $tmpFilePath3 = $_FILES['Apto']['tmp_name'];
        //Make sure we have a file path
        if ($tmpFilePath != ""){
            //Setup our new file path
            $newFilePath1 = "../assets/img/users/" . $_FILES['uploadedfile']['name'];

            //Upload the file into the temp dir
            if(move_uploaded_file($tmpFilePath, $newFilePath1)) {
                header('location: ../index.php?page=choferes&success=true');
            }
            else{
                header('location: ../index.php?page=choferes&errorObservacionImage=true');
            }
        }if ($tmpFilePath2 != ""){
            //Setup our new file path
            $newFilePath2 = "../assets/img/licencia/" . $_FILES['Licencia']['name'];

            //Upload the file into the temp dir
            if(move_uploaded_file($tmpFilePath2, $newFilePath2)) {
                header('location: ../index.php?page=choferes&success=true');
            }
            else{
                header('location: ../index.php?page=choferes&errorObservacionImage=true');
            }
        }if ($tmpFilePath3 != ""){
            //Setup our new file path
            $newFilePath3 = "../assets/img/apto/" . $_FILES['Apto']['name'];

            //Upload the file into the temp dir
            if(move_uploaded_file($tmpFilePath3, $newFilePath3)) {
                header('location: ../index.php?page=choferes&success=true');
            }
            else{
                header('location: ../index.php?page=choferes&errorObservacionImage=true');
            }
        }else{
            header('location: ../index.php?page=choferes&success=true');
        }

    }else{
        //die();
        header('location: ../index.php?page=choferes&error=true');
    }

}
if(isset($_POST['delete']))
{
    if($choferes->deleteChofer($_POST['eventID'])){
        echo json_encode(["success"=>true]);
    }else{
        echo json_encode(["error"=>true]);
    }
}
if(isset($_POST['updateChofer']))
{
    $tmpFilePath = $_FILES['uploadedfile']['tmp_name'];
    $newFilePath = "../assets/img/users/" . $_FILES['uploadedfile']['name'];
    //Upload the file into the temp dir
    move_uploaded_file($tmpFilePath, $newFilePath);
    
    $tmpFilePath2 = $_FILES['LicenciaEdit']['tmp_name'];
    $newFilePath2 = "../assets/img/licencia/" . $_FILES['LicenciaEdit']['name'];
    //Upload the file into the temp dir
    move_uploaded_file($tmpFilePath2, $newFilePath2);

    $tmpFilePath3 = $_FILES['AptoEdit']['tmp_name'];
    $newFilePath3 = "../assets/img/apto/" . $_FILES['AptoEdit']['name'];
    //Upload the file into the temp dir
    move_uploaded_file($tmpFilePath3, $newFilePath3);

    if($choferes->updateChofer($_POST)){
       header('location: ../index.php?page=choferes&successUpdate=true');


    }else{        
        header('location: ../index.php?page=choferes&errorUpdate=true');

    }


}