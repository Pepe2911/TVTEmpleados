<?php
include '../Model/Empleado.php';
$Empleado = new Empleado();
$empleado = $Empleado->getEmpleadoById($_POST['Empleado']);

?>
<style>
    p {
  margin-left: 20px }
</style>
<div style="border: 1px solid; width: 90%; margin: 0 auto;">
    <h1 style="text-align: center;">SOLICITUD DE DESCANSO VACACIONAL</h1>
    <p>Jalisco, <?= date("d-m-Y"); ?></p>
    <p><strong>Asunto: Solicitud de vacaciones</strong></p>
    <p>Mediante la presente, y para que quede constancia por escrito, me dirijo a usted para solicitar con la debida anellacion los dias de vacacions correpondientes a este año</p>
    <p>De acuerdo con la normativa vigente, para este período anual me corresponden <strong><?php echo $empleado[0]['diasVacaciones']; ?></strong> días naturales de descanso. Desearía disfrutar de estos días de vacaciones laborales, a partir del dia: <strong><?= $_POST['Desde'] ?></strong> al día <strong><?= $_POST['Hasta'] ?></strong></p>
    <p>Agradeciendo su atencion y espernado que no exista inconveniente por su parte, quedo a la espera de su contestacion.</p>
    <p style="text-align: center;">Le saluda atentamente<br> <strong><?php echo $empleado[0]['NombreEmpleado']." ".$empleado[0]['ApellidosEmpleado']; ?></strong></p>
    <p><button class="btn btn-success" onclick="save()">Mandar solicitud</button></p>
</div>
<input type="hidden" value="<?= $_POST['Empleado']?>" id="id">
<input type="hidden" value="<?= $_POST['Desde']?>" id="desde">
<input type="hidden" value="<?=$_POST['Hasta']?>" id="hasta">
<script>
    function save(){
        var id = document.getElementById("id").value;
        var desde = document.getElementById("desde").value;
        var hasta = document.getElementById("hasta").value;
        alert(id+" "+desde+" "+hasta);
        $.ajax({
            type: 'POST',
            url: 'Controller/VacacionesController.php?page=vacaciones',
            data: {'Desde' : desde, 'Hasta' : hasta, 'Empleado' : id, 'newV': true},
            success: function (response) {                
                if(response == true){
                    alert("Solicitud enviada Exitosamente");
                }
                else{
                    alert("Hubo un error al ingresar la peticion de vacaciones ");
                }

            },
            error: function (error) {
                alert("Error contacte al administrador");
            }
        });
    }    
</script>
