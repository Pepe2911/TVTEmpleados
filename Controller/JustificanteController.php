<?php
include dirname(__FILE__, 2).'/Model/justificantes.php';
$justific = new justificar();

if(isset($_POST['Consulta'])){
    echo json_encode( $justific->getById($_POST['EventID']));
}
if(isset($_POST['aceptar'])){
      
     if($justific->updateEstatus($_POST['EventID'],1)){
        echo json_encode(["success"=>true]);
    }else{
        echo json_encode(["error"=>true]);
    }
}
if(isset($_POST['cancelar'])){      
    if($justific->updateEstatus($_POST['EventID'],2)){ 
               
        echo json_encode(["success"=>true]);
   }else{
        echo json_encode(["error"=>true]);
   }
}

?>