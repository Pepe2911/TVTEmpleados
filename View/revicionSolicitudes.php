<?php 
if ($_SESSION['idTipoUsuario'] != 1){
    //echo $_SESSION['idTipoUsuario'];
    //header("Location: ../index.php");
    echo "<center><h2>Página no econtrada</h2></center>";
    exit;
}
	include './Model/vacaciones.php';
	$Empleado = new vacaciones();
    $pendientes = $Empleado->getSolicitudes(2);
    $aceptadas = $Empleado->getSolicitudes(1);
    $rechazadas = $Empleado->getSolicitudes(0);
 ?>
 <div class="row">
        <ol class="breadcrumb">
            <li><a href="#">
                    <em class="fa fa-user-circle-o"></em>
                </a></li>
            <li class="active">Solicitudes Vacacionales</li>
        </ol>
    </div><!--/.row-->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Reporte de solicitudes</h1>
        </div>
    </div><!--/.row-->
 <div class="col-md-12" id="contenido">
    <div class="panel panel-default">
        <div class="panel-body tabs">
            <ul class="nav nav-pills">
                <li class="active"><a href="#pilltab1" data-toggle="tab">Pendientes</a></li>                
                <li><a href="#pilltab2" data-toggle="tab">Aceptadas</a></li>
                <li><a href="#pilltab3" data-toggle="tab">Rechazadas</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade in active" id="pilltab1">                    
                    <table class="table">
                        <caption>Solicitudes Pendientes</caption>
                        <thead>
                            <tr>
                                <th>Empleado</th>
                                <th>Periodo</th>
                                <th>Aprobar / Rechazar</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                                <?php

                                if(count($pendientes)>0){


                                    foreach ($pendientes as $column =>$value) {
                                        ?><tr>                
                                        <td><?= $value['NombreEmpleado']." ".$value['ApellidosEmpleado'];?></td>
                                    
                                        
                                        <td><?= $value['inicio'] ?> /  <?= $value['fin'] ?></td>
                                    <?php if($value['inicio'] < date("Y-m-d")){echo "<td style='background-color: yellow;'>Caducada</td>";} else{?><td><button onclick="cambiarStatus(1,'<?= $value['inicio'] ?>','<?= $value['idVacaciones'] ?>','pilltab1')" class="btn btn-success">Aceptar</button><button onclick="cambiarStatus(0,'<?= $value['inicio'] ?>','<?= $value['idVacaciones'] ?>,','pilltab1')" class="btn btn-danger">Rechazar</button></td><?php } ?>
                                        </tr>
                                        <?php
                                    }
                                }else{
                                    ?>
                                <tr>
                                        <td colspan="5">
                                            <div class="alert alert-info">
                                                No se encontraron Empleados.
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                                
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="pilltab2"> 
                <table class="table">
                        <caption>Solicitudes Aprobadas</caption>
                        <thead>
                            <tr>
                                <th>Empleado</th>
                                <th>Periodo</th>
                                <th>Aprobar / Rechazar</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                                <?php

                                if(count($aceptadas)>0){


                                    foreach ($aceptadas as $column =>$value) {
                                        ?><tr>                
                                        <td><?= $value['NombreEmpleado']." ".$value['ApellidosEmpleado'];?></td>
                                    
                                        
                                        <td><?= $value['inicio'] ?> /  <?= $value['fin'] ?></td>
                                    <?php if($value['inicio'] < date("Y-m-d")){echo "<td style='background-color: yellow;'>Caducada</td>";} else{?><td><button onclick="cambiarStatus(0,'<?= $value['inicio'] ?>','<?= $value['idVacaciones'] ?>','pilltab2')" class="btn btn-danger">Rechazar</button></td> <?php }?>
                                        </tr>
                                        <?php
                                    }
                                }else{
                                    ?>
                                <tr>
                                        <td colspan="5">
                                            <div class="alert alert-info">
                                                No se encontraron Empleados.
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                                
                            </tr>
                        </tbody>
                    </table>                               
                </div>
                <div class="tab-pane fade" id="pilltab3"> 
                <table class="table">
                        <caption>Solicitudes Rechazadas</caption>
                        <thead>
                            <tr>
                                <th>Empleado</th>
                                <th>Periodo</th>
                                <th>Aprobar / Rechazar</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                                <?php

                                if(count($rechazadas)>0){


                                    foreach ($rechazadas as $column =>$value) {
                                        ?><tr>                
                                        <td><?= $value['NombreEmpleado']." ".$value['ApellidosEmpleado'];?></td>
                                    
                                        
                                        <td><?= $value['inicio'] ?> /  <?= $value['fin'] ?></td>
                                    <?php if($value['inicio'] < date("Y-m-d")){echo "<td style='background-color: yellow;'>Caducada</td>";} else{?><td><button onclick="cambiarStatus(1,'<?= $value['inicio'] ?>','<?= $value['idVacaciones'] ?>','pilltab3')" class="btn btn-success">Aceptar</button></td><?php }?>
                                        </tr>
                                        <?php
                                    }
                                }else{
                                    ?>
                                <tr>
                                        <td colspan="5">
                                            <div class="alert alert-info">
                                                No se encontraron Empleados.
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                                
                            </tr>
                        </tbody>
                    </table>                                       
                </div>                
            </div>
        </div>
    </div><!--/.panel-->
</div>
<!-- Modal Rechazar -->
<div class="modal fade" id="modalRechazar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="./Controller/HorarioController.php?page=Admin" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Punto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <div class="row">
                        <div class="col-md-6">
                        <label>Motivo de rechazo</label>
                        <input type="text" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" name="newHorario" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    function cambiarStatus(status, inicio, id, div){  
        div = "#"+div;      
        var  today = new Date();
        var m = today.getMonth() + 1;
        var mes = (m < 10) ? '0' + m : m;
        var fecha = today.getFullYear()+'-'+mes+'-'+today.getDate();
       
            $.ajax({
            type: 'POST',
            url: './Controller/VacacionesController.php',
            data: {'estatus':status, 'update': true, 'id':id},
            success: function (response) {
                if(response = true){
                    alert("Estatus actualizado Correctamente");
                    $(div).load(" "+div);
                    
                }
                else{
                    alert("Error al procesar la peticion");
                }
                
            },
            error: function (error) {
                alert("Error contacte al administrador");
            }
        });	           
        
    }
</script>