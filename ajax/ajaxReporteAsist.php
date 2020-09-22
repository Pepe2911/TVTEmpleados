<?php 

$dia = date($_POST['F']);
$mod_date = strtotime($dia."+ 6 days");	
//echo date("Y-m-d",$mod_date) . "\n";

include '../Model/Empleado.php';
include '../Model/asistencia.php';
$empleado = new Empleado();
$asist = new asistencia();
$boletero =$empleado->getEmpleadoAsist();
?>
<table class="table">
    <caption>Reporte de Faltas y retardos De: <?= $dia?> Hasta: <?= date("d-m-Y",$mod_date) ?></caption>
    <thead>
    <tr>
      <th scope="col">Nombre</th>
      <th scope="col">Fechas</th>
      <th scope="col">Faltas</th>
      <th scope="col">Minutos de retardo</th>
    </tr>
    </thead>
    <tbody>
        <?php 
        if(count($boletero)>0){
            foreach ($boletero as $column => $value){ 
                $faltas = 7;
                $asistencia = $asist->getAsistRep($value['NumeroEmpleado'],$dia, date("Y-m-d",$mod_date));
                $rest = new DateTime('00:00'); 
                $rest = $rest->format('%H:%I');
                $mins = 0; 
                unset ($fechaSalida);                            
                ?>
            <tr>
                <td><?= $value['NombreEmpleado']." ".$value['ApellidosEmpleado']?></td>
                <td><?= $dia."/".date("Y-m-d",$mod_date) ?></td>
            <?php 
            foreach($asistencia as $column2 => $value2){
            if(isset($value2['entrada'])){
                $faltas = $faltas-1;
                
            }
            $horario = $asist->getHorario($value2['idUbicacion']); 
            $mifecha = new DateTime(); 
                               
            foreach($horario as $column3 => $value3){  
                $f1 = new DateTime($value2['entrada']);
                $f2 = new DateTime($value3['entrada']);
                $d = $f1->diff($f2);
                $dif = $d->format('%H:%I');

                $start = strtotime($value3['entrada']);
                $end = strtotime($value2['entrada']);
                
                if(($end - $start) / 60 < 0){
                    $mins += 0;
                }              
                else{
                    $mins += ($end - $start) / 60; 
                } 
                $startS = strtotime($value3['salida']);
                $endS = strtotime($value2['salida']);
                if(($endS - $startS) / 60 > 0){
                    $mins +=0;
                }else{
                    $mins -= ($endS - $startS) / 60;
                }
                
                //echo "<br>".$mins;
                $rest    = strtotime($mins." minutes", strtotime($rest));
                $fechaSalida  = date('H:i', $rest);  
                //echo "<br>".$fechaSalida;          
            }
        }
            ?>
            <td><?= $faltas-1 ?></td>
            <?php
            if(isset($fechaSalida)){?>
                <td><?= $mins ?> Minutos</td>
            <?php }            
            else{ ?>
                <td>0 Minutos</td>
            <?php }       
            
        }
    }
        ?>       
    </tbody>
</table>



