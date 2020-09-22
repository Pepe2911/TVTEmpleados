<?php 
include './Model/Empleado.php';
$Empleado = new Empleado();
$empleado = $Empleado->getAllEmpleados();
 ?>
<div class="row">	
	<fieldset>
		<legend>Solicituda de vacaciones</legend>
		<div class="col-lg-4">
		
	
		<p>Seleciones un empleado</p>
		<select name="empleado" id="empleado" class="form-control">
			 <option value="0">Selecciona un Empleado</option>
            <?php

            if(count($empleado)>0){


                foreach ($empleado as $column =>$value) {
                    ?>
                    <option value="<?= $value['idEmpleado'];?>" name="<?= $value['idEmpleado'];?>"><?= $value['NombreEmpleado']." ".$value['ApellidosEmpleado'];?></option>
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
	<div class="row col-lg-6">
		
		<div class="col-lg-6">
			<p>De:</p>
			<input type="date" id="fechaDe" name="fechaDe" class="form-control">
		</div>
		<div class="col-lg-6">
			<p>Hasta:</p>
			<input type="date" id="fechaHasta" name="fechaHasta" class="form-control">
		</div>
	</div>
	</fieldset>
</div>
<div class="row">
	<div class="col-lg-4">
		<button type="button" onclick="solicitar()" class="btn btn-primary">Solicitar Vacaciones</button>
	</div>		
</div>
<div id="div-results" style="margin-left: 20">

</div>
<script>
	function solicitar(){

	var FechaDesde = document.getElementById('fechaDe').value;
	var FechaHasta = document.getElementById('fechaHasta').value;
	var Empleado = document.getElementById('empleado').value;
	//alert( FechaDesde+" "+FechaHasta+" "+Empleado);
	if (FechaDesde == ''){
		alert("Ingrese una fecha de inicio de Vacaciones.");
		document.getElementById("fechaDe").focus();
	}
	else if (FechaHasta == ''){
		alert("Ingrese una fecha de fin de Vacaciones.");
		document.getElementById("fechaHasta").focus();
	}
	else{
		$.ajax({
            type: 'POST',
            url: './ajax/solicitudVacaciones.php',
            data: {'Desde' : FechaDesde, 'Hasta' : FechaHasta, 'Empleado' : Empleado},
            success: function (response) {
                $('#div-results').html(response);
            },
            error: function (error) {
                alert("Error contacte al administrador");
            }
        });
	}	
		
	}	
	   
</script>