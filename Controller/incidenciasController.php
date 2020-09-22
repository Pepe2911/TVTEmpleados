<?php
include dirname(__FILE__, 2).'/Model/SpReporte.php';
$reporte = new SpReporte();

if(isset($_POST['SpReporte']))
{
    echo json_encode( $reporte->GetSpReporte($_POST));
}
