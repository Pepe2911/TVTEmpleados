<?php 
if(!isset($_POST['id'])){
    echo "Error. favor de contactar al administrados";
    exit();
}
else if($_POST['id'] == 0 ){
    exit();
}
$dia = date("d-m-Y");
$dias = strtotime($dia."- 7 days");	
$dia = date("d-m-Y",$dias);
$mod_date = strtotime($dia."+ 6 days");	
//echo date("Y-m-d",$mod_date) . "\n";

include '../Model/Empleado.php';
include '../Model/asistencia.php';
$empleado = new Empleado();
$asist = new asistencia();
$horario[] =  $asist->getHorarioByNumEmp($_POST['id']);
if(isset($horario[0][0]['entrada'])){
$entrada =$horario[0][0]['entrada'];
$salida = $horario[0][0]['salida'];
}
else{
    echo "<center><h2>El empleado no tiene un horario asignado o no esta asignado para registrar asistencia</h2></center>";
    exit();
}

?>
<table class="table" border="">
    <caption>Reporte de Faltas y retardos De: <?= $dia ?> Hasta: <?= date("d-m-Y",$mod_date) ?></caption>
    <thead>
    <tr>
      <th scope="col">Fecha</th>
      <th scope="col">Entrada</th>
      <th scope="col">Salida</th>      
      <th scope="col">Justificar</th>
    </tr>
    </thead>
    <tbody>            
                <?php                
                while($dias <= $mod_date ){
                    
                    //echo "<br>".date("d-m-Y",$mod_date)." | ". date("d-m-Y",$dias)."<br>"; 
                    unset($boletero);
                    $boletero[] =$empleado->getEmpleadoAsistById($_POST['id'], date("Y-m-d",$dias));
                    //print_r($boletero[0][0]['idAsistencia']);
                    //echo "<br><br>";
                    $fecha = date("d-m-Y",$dias);
                    ?>
            <tr>

                <td><?=  date("d-m-Y",$dias) ?></td> 
                <?php 
                    if(isset($boletero[0][0]['idAsistencia'])){
                        echo "<td>".$boletero[0][0]['entrada']."</td>";
                        echo "<td>".$boletero[0][0]['salida']."</td>";
                        if($boletero[0][0]['entrada'] > $entrada || $boletero[0][0]['salida'] < $salida){?>
                            <td><button class="btn btn-info" onclick="justificar( <?= $_POST['id']?> , '<?= $fecha ?>')">Justificar</button></td>
                        <?php }else{
                            echo"<td></td>";
                        }
                        
                    }
                    else{?>
                        <td>N/A</td>
                        <td>N/A</td>
                        <td><button class="btn btn-info" onclick="justificar( <?= $_POST['id']?> , '<?= $fecha ?>')">Justificar</button></td>
                    <?php }
                ?>  
                 
            </tr>
                <?php 
                    $dias += 86400;
                //$dia = strtotime($dia."+ 1 days");
                //$dia = date("d-m-Y",$dia);
                }
                ?>
                 
           
                
    </tbody>
</table>
<!-- Modal Justificar  -->
<div class="modal fade" id="modalJsutificar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form enctype="multipart/form-data" id="formUser" onsubmit="return validaUser()" action="./Controller/UsersController.php?page=justificarAsist" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Justificar Faltas y Retardos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">  
                    <label>Justificante para el dia: <strong><input type="text" name="fecha_" id="fecha_" disabled></strong></label>                  
                    <textarea name="descripcion" id="descripcion" class="form-control" rows="10" cols="50"></textarea>
                    <br>
                    <input name="evidencia" id="evidencia" type="file" class="form-control">                    
                    <input type="hidden" name="idEmp" id="idEmp">
                    <input type="hidden" name="fecha" id="fecha">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" name="justi" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>  
<script>
    function justificar(id, fecha){       
        var salida = formato(fecha);
        document.getElementById("fecha_").value = salida;
        document.getElementById("fecha").value = salida;
        document.getElementById("idEmp").value = id;
        $("#modalJsutificar").modal("show");
    }
    function formato(texto){
    return texto.replace(/^(\d{2})-(\d{2})-(\d{4})$/g,'$3/$2/$1');
    }	
    

</script>

