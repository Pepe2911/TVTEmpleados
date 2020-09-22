<?php
include dirname(__FILE__, 2).'/Model/users.php';
$users = new users();
if(isset($_POST['create'])){
    if($users->newUser($_POST)){
        header('location: ../index.php?page='.$_GET['page'].'&successUser=true');
    }else{
        header('location: ../index.php?page='.$_GET['page'].'&errorUser=true');
    }
}
if(isset($_POST['Update'])){
    if($users->updateUser($_POST)){
        header('location: ../index.php?page='.$_GET['page'].'&successUser=true');
    }else{
        header('location: ../index.php?page='.$_GET['page'].'&errorUser=true');
    }
}
if(isset($_POST['deleteUser'])){
    if($users->deleteUser($_POST['idEvent'])){
        echo json_encode(["success"=>true]);
    }else{
        echo json_encode(["error"=>true]);
    }
}
if(isset($_POST['getUserByID'])){
    echo json_encode($users->getUserByID($_POST['EventID']));
}
if(isset($_POST['justi'])){
    $tmpFilePath = $_FILES['evidencia']['tmp_name'];
    $newFilePath = "../assets/img/justificante/" . $_FILES['evidencia']['name'];
    //Upload the file into the temp dir
    if (move_uploaded_file($tmpFilePath, $newFilePath)){
       if($users->justificar($_POST)){
        header('location: ../index.php?page='.$_GET['page'].'&succesJa=true');
        }
        else{            
            unlink($newFilePath);
            //die();
            header('location: ../index.php?page='.$_GET['page'].'&errorJa=true');
        }
    }else{
        header('location: ../index.php?page='.$_GET['page'].'&errorJ=true');
    }
    
}