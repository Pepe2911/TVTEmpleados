<?php 
if($_POST['id'] == 0){
    exit();
}
include '../Model/vacaciones.php';
include '../Model/Empleado.php';
$empleadoV =0;
$diasTomados = 0;
$restantes = 0;
$EmpleadoV = new vacaciones();
$empleadoV = $EmpleadoV->getSolicitudesById($_POST['id']);
$diasTomados = $EmpleadoV->diasTomados($_POST['id']);
$nombre = $empleadoV[0]['NombreEmpleado']." ".$empleadoV[0]['ApellidosEmpleado'];
//print_r($empleadoV);
if(isset($diasTomados[0]['Dias_transcurridos'])){
   $restantes = $empleadoV[0]['diasVacaciones'] - $diasTomados[0]['Dias_transcurridos'] ;
}
else{
    $diasTomados[0]['Dias_transcurridos'] = 0;
    $restantes = $empleadoV[0]['diasVacaciones'];
}
    
?>
 
<center> <h2><?= $nombre ?></h2></center>
<table class="table">
    <thead>
        <th>Dias de vacaciones</th>
        <th>Dias Tomados</th>
        <th>Dias Restantes</th>
    </thead>
    <tbody>
        <tr>
            <td><?= $empleadoV[0]['diasVacaciones'] ?></td>
            <td><?= $diasTomados[0]['Dias_transcurridos'] ?></td>
            <td><?= $restantes ?></td>
        </tr>
    </tbody>
</table>
<h3>Solicitudes enviadas</h3>
<table class="table">
    <thead>
        <th>Fecha solicitud</th>
        <th>Periodo</th>
        <th>Estatus</th>
        <th>Motivo</th>
    </thead>
    <tbody>
    <?php
            if(count($empleadoV)>0){


                foreach ($empleadoV as $column =>$value) {
                    ?>
        <tr>
            <td><?= $value['fecha'] ?></td>
            <td><?= $value['inicio']." / ".$value['fin'] ?></td>
            <?php if($value['estatus'] == 1){echo "<td style='background-color: green;'><a href='reportes/solicitud_Vacaciones.php?c=".$value['idEmpleado']."&a=".$value['idVacaciones']."' style='color: white;' target='blank'>Aprobado <i class='fa fa-file-pdf-o' aria-hidden='true'></i></a></td>";} 
             else if($value['estatus'] == 0 && $value['estatus'] != NULL){echo "<td style='background-color: red;'>Rechazado</td>";}
             else if($value['estatus'] == 2){echo "<td style='background-color: yellow;'>Pendiente</td>";} 
             else{echo "<td></td>";}
             ?>
            <td><?= $value['Motivo'] ?></td>
        </tr>
        <?php
                }
            }else{
                ?>
                <option>No se encontraron Empleados</option>
                <?php
            }
            ?>
    </tbody>
</table>