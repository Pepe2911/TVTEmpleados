<?php
    include './Model/Empleado.php';
    $Empleado = new Empleado();
    $tipo = $Empleado->getTipos();
    $empleado = $Empleado->getAllEmpleados();
    $hoy = date("Y-m-d");
?>
<div class="row">
    <ol class="breadcrumb">
        <li><a href="#">
                <em class="fa fa-window-close-o"></em>
            </a></li>
        <li class="active">Incidencias</li>
    </ol>
</div><!--/.row-->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Reporte Incidencias</h1>
    </div>
</div><!--/.row-->

    <div class="row">
        <div class="col-md-3">
            <label>Fecha Inicio</label>
            <input type="date" id="FechaI" name="FechaI" class="form-control" required>
        </div>
        <div class="col-md-3">
            <label>Fecha Final</label>
            <input type="date" id="FechaF" name="FechaF" class="form-control">
            <input type="hidden" value="<?php echo $hoy; ?>" id="today">
        </div>
        <div class="col-md-3">
            <label>Empleado</label>
            <select class="form-control" id="Empleado" name="Empleado">
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
        <div class="col-md-3">
            <label>Tipo Empleado</label>
            <select class="form-control" id="Tipo" name="Tipo">
                <option value="0" name="0">Selecciona un tipo de empleado</option>
                <?php
                if(count($tipo)>0){
                foreach ($tipo as $column =>$value) {
                ?>
                <option value="<?= $value['idTipoEmpleado'];?>" name="<?= $value['idTipoEmpleado'];?>"><?= $value['Tipo'];?></option>
                    <?php
                }
                }else{
                ?>
                    <option>No se encontraron tipos de Empleados</option>
                    <?php
                }
                ?>
            </select>
        </div>
    </div>
<br>
    <div class="row">
        <div class="col-md-2">
            <button onclick="validaReporte()" type="submit" class="btn btn-primary" name="SpReporte">Generar Reporte</button>
        </div>
        <div class="col-md-2">
            <button onclick="restaurar()" type="submit" class="btn btn-secondary" name="SpReporte">Restaurar</button>
        </div>
        <div class="col-md-2">
            <label>Generar PDF</label>
            <button onclick="" type="submit" class="btn btn-danger" name="SpReporte"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></button>
        </div>
    </div>


    <div id="Reporte" style="display: none">  <!--style="display: none" --->
        <table class="table">
            <thead class="table-info">
                <tr>
                    <th>#</th>
                    <th>Fecha</th>
                    <th>Nombre</th>
                    <th>Incidencia</th>
                    <th>Descripcion</th>
                    <th>Tipo de Empleado</th>
                </tr>
            </thead>
            <tbody id="Incidencias">
            </tbody>
        </table>
    </div>
<script>
    function validaReporte() {
        var FechaInicio = document.getElementById("FechaI").value;
        var FechaFinal = document.getElementById("FechaF").value;
        var today = document.getElementById("today").value;
        var Emplea = document.getElementById("Empleado").value;
        var Tipe = document.getElementById("Tipo").value;
        if (Emplea == 0){
            Emplea="";
        }
        if (Tipe == 0){
            Tipe="";
        }
        if (FechaFinal != '' && FechaFinal < FechaInicio){
            alert("La fecha inicial no puede ser mayor a la fecha final");
        }
        else if(FechaInicio > today || FechaFinal > today){
            alert("Las fechas no pueden ser mayor a el día de hoy");
        }
        else {
            GenerarReprote(FechaInicio,FechaFinal,Emplea,Tipe);
        }
    }
    function GenerarReprote(Inicio, Fin, Emp, Type) {
        $.ajax({
            type: "POST",
            url: "./Controller/incidenciasController.php",
            dataType: 'json',
            data: {'I': Inicio, 'F': Fin, 'E': Emp, 'T':Type, 'SpReporte': true},
            success: function (data) {
                $("#Incidencias").empty();
                if (data.length > 0){
                $.each(data, function (i, v) {
                    $("#Incidencias").append("<tr>");
                    $("#Incidencias").append("<th>"+(i+1)+"</th>");
                    $("#Incidencias").append("<td>"+v.FechaInsidencia+"</td>");
                    $("#Incidencias").append("<td>"+v.NombreEmpleado+" "+v.ApellidosEmpleado+"</td>");
                    $("#Incidencias").append("<td>"+v.Titulo+"</td>");
                    $("#Incidencias").append("<td>"+v.Observacion+"</td>");
                    $("#Incidencias").append("<td>"+v.Tipo+"</td>");
                    $("#Incidencias").append("</tr>");
                });
                }
                else{
                    $("#Incidencias").append("<tr>");
                    $("#Incidencias").append("<th style='text-align: center;' colspan='6' class='alert alert-info'>No se encontraron resultados</th>");
                    $("#Incidencias").append("</tr>");
                }
                var el = document.getElementById("Reporte");
                el.style.display = 'block';
            },
            error: function (error) {
                alert('Error');
            }
        })
    }
    function restaurar() {
        location.reload();
    }
</script>

