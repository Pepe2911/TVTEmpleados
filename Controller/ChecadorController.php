<?php
include dirname(__FILE__, 2). './Model/checador.php';
$registro = new checador();

if(isset($_POST['New'])){

    echo json_encode($registro->newRegistro($_POST));
}