<?php 
include './Model/Empleado.php';
$Empleado = new Empleado();
$empleado = $Empleado->getAllEmpleados();
 ?>
 <div class="row">
        <ol class="breadcrumb">
            <li><a href="#">
                    <em class="fa fa-calendar-check-o"></em>
                </a></li>
            <li class="active">Justificar Asistencia</li>
        </ol>
    </div>
<div class="row">	
	<fieldset>
		<legend>Justificar Asistencia</legend>
		<div class="col-lg-4">
		
	
		<p>Seleciones un empleado</p>
		<select name="empleado" id="empleado" class="form-control" onchange="solicitar()">
			 <option value="0">Selecciona un Empleado</option>
            <?php
            if(count($empleado)>0){


                foreach ($empleado as $column =>$value) {
                    ?>
                    <option value="<?= $value['NumeroEmpleado'];?>" name="<?= $value['NumeroEmpleado'];?>"><?= $value['NombreEmpleado']." ".$value['ApellidosEmpleado'];?></option>
                    <?php
                }
            }else{
                ?>
                <option>No se encontraron Empleados</option>
                <?php
            }
            ?>
		</select>
	</div>	
	</fieldset>
</div>
<div id="div-results" style="margin-left: 20">

</div>

<script>
	function solicitar(){
		var id = document.getElementById("empleado").value;
		
			$.ajax({
            type: 'POST',
            url: './ajax/ajaxJustificar.php',
            data: {'id':id},
            success: function (response) {
                $('#div-results').html(response);
            },
            error: function (error) {
                alert("Error contacte al administrador");
            }
        });	
	}
    
	   
</script>