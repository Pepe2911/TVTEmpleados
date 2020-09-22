<?php
include './Model/Empleado.php';
$Empleado = new Empleado();
$tipo = $Empleado->getTipos();
$empleado = $Empleado->getEmpleadoAsist();
$hoy = date("Y-m-d");
?>
<div class="row">
    <ol class="breadcrumb">
        <li><a href="#">
                <em class="fa fa-calendar-check-o "></em>
            </a></li>
        <li class="active">Asistencias</li>
    </ol>
</div><!--/.row-->

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Modificar</h1>
    </div>
</div><!--/.row-->
<div class="row">
    <div class="col-md-6"></div>
</div>
<div class="form-group text-center">
    <?php
    if(isset($_GET['successUpdate'])){
        ?>
        <div class="alert alert-success">
            <h3><strong>Modificado</strong></h3>
            La asistencia ha sido modificada con exito
        </div>
        <?php
    }else if(isset($_GET['errorUpdate'])){
        ?>
        <div class="alert alert-danger">
            <h3><strong>Error</strong></h3>
            Ha ocurrido un error al modificar la asistencia, por favor intente de nuevo.
        </div>
        <?php
    }
    ?>
</div>
<div class="row">
    <div class="col-md-3">
        <label>Fecha Inicio</label>
        <input type="date" id="FechaI" name="FechaI" class="form-control" required>
    </div>
    <div class="col-md-3">
        <label>Fecha Final</label>
        <input type="date" id="FechaF" name="FechaF" class="form-control">
        <input type="hidden" value="<?= $hoy ?>" id="today">
    </div>
    <div class="col-md-3">
        <label>Empleado</label>
        <select class="form-control" id="Empleado" name="Empleado">
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
<div class="row">
    <div class="col-md-1">
        <button onclick="validaReporte()" class="btn btn-success">Buscar</button>
    </div>
    <div class="col-md-3">
        <button onclick="restaurar()" class="btn btn-info">Restaurar</button>
    </div>
</div>

<div id="Reporte" style="display: none">  <!--style="display: none" --->
    <table class="table">
        <thead class="table-info">
        <tr>
            <th>#</th>
            <th>Numero de Empleado</th>
            <th>Nombre</th>
            <th>Fecha</th>
            <th>Entrada</th>
            <th>Salida</th>
            <th>Tipo de empleado</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody id="Incidencias">
        </tbody>
    </table>
</div>

<!-- Modal Editar -->
<div class="modal fade" id="modalEditarAsist" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form enctype="multipart/form-data" action="./Controller/AsistenciasController.php?page=ModificarAsist" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nueva Observacion</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <label>Nombre</label>
                            <input type="text" name="NameEdit" id="NameEdit" class="form-control" disabled>
                        </div>
                        <div class="col-md-6">
                            <label>Fecha</label>
                            <input type="date" name="FechaEdit" id="FechaEdit" class="form-control" disabled>
                        </div>
                        <div class="col-md-12">
                            <label>Entrada</label>
                            <input type="time" name="EntradaEdit"  id="EntradaEdit" class="form-control">
                        </div>
                        <div class="col-md-12">
                            <label>Salida</label>
                            <input type="time" name="SalidaEdit" id="SalidaEdit" class="form-control">
                        </div>
                        <input type="hidden" name="idAsist" id="idAsist">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" name="UpdateAsist" class="btn btn-success">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function restaurar() {
        location.reload();
    }
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
            cargarEmpleados(FechaInicio,FechaFinal,Emplea,Tipe);
        }
    }
    function cargarEmpleados(Inicio,Fin,Emp,Type) {
        $.ajax({
            type: "POST",
            url: "./Controller/AsistenciasController.php",
            dataType: 'json',
            data: {'I': Inicio, 'F': Fin, 'E': Emp, 'T':Type, 'SpReporte': true},
            success: function (data) {
                $("#Incidencias").empty();
                if (data.length > 0){
                    $.each(data, function (i, v) {
                        $("#Incidencias").append("<tr>");
                        $("#Incidencias").append("<th>"+(i+1)+"</th>");
                        $("#Incidencias").append("<td>"+v.idEmpleado +"</td>");
                        $("#Incidencias").append("<td>"+v.NombreEmpleado+" "+v.ApellidosEmpleado+"</td>");
                        $("#Incidencias").append("<td>"+v.fecha+"</td>");
                        $("#Incidencias").append("<td>"+v.entrada+"</td>");
                        $("#Incidencias").append("<td>"+v.salida+"</td>");
                        $("#Incidencias").append("<td>"+v.Tipo+"</td>");
                        $("#Incidencias").append("<td><button class='btn-success' onclick='modalEdit("+v.idAsistencia+")'><i class='fa fa-edit'></i></button></td>");
                        $("#Incidencias").append("</tr>");
                    });
                }
                else{
                    $("#Incidencias").append("<tr>");
                    $("#Incidencias").append("<th style='text-align: center;' colspan='8' class='alert alert-info'>No se encontraron resultados</th>");
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
    function modalEdit(id) {
        $.ajax({
            type: 'POST',
            url: './Controller/AsistenciasController.php',
            dataType: 'json',
            data: {'EventID' : id, 'getAsist': true},
            success:function (data) {
                if (data.length > 0){
                    document.getElementById("NameEdit").value = data[0].NombreEmpleado+" "+data[0].ApellidosEmpleado;
                    document.getElementById("FechaEdit").value = data[0].fecha;
                    document.getElementById("EntradaEdit").value = data[0].entrada;
                    document.getElementById("SalidaEdit").value = data[0].salida;
                    document.getElementById("idAsist").value = data[0].idAsistencia;
                    $("#modalEditarAsist").modal("show");
                }
                else {

                }
            },
            error: function (error) {

            }
        })
    }
</script>