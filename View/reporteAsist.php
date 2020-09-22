<?php 

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
        <h1 class="page-header">Reporte</h1>
    </div>
</div><!--/.row-->
<div class="row">
    <div class="col-md-3">
        <label>Fecha de Asistencia</label>
        <input  type="date" id="fecha" class="form-control">
    </div>
    <div class="col-md-12">
        <button class="btn btn-primary" onclick="validarReporte()" >Buscar</button>
    </div>
</div>
<div id="div-results">

</div>
<script>
    function validarReporte(){
        var fecha = document.getElementById("fecha").value;
        
        if(fecha != '')
        {
            generarReporte(fecha);
        }
        else{
            alert("Favor de ingresar una fecha");
            document.getElementById("fecha").focus();
        }
    }
    function generarReporte(fecha) {                
        var url = "./ajax/ajaxReporteAsist.php"
        $.ajax({
            type: 'POST',
            url: url,
            data: {'F' : fecha},
            success: function (response) {
                $('#div-results').html(response);
            },
            error: function (error) {
                alert("Error contacte al administrador");
            }
        })
    }
</script>