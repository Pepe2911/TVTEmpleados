<?php
include './Model/Chofer.php';
$chof = new Chofer();
$choferes =$chof->getChoferes();
?>
<div class="row">
    <ol class="breadcrumb">
        <li><a href="#">
                <em class="fa fa-id-card-o"></em>
            </a></li>
        <li class="active">Operadores</li>
    </ol>
</div><!--/.row-->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Reporte General Operadores</h1>
    </div>
</div><!--/.row-->
<div>
    <div><button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Nuevo Operador</button></div>
    <div class="form-group text-center">
        <?php
        if(isset($_GET['success'])){
            ?>
            <div class="alert alert-success">
                El usuario ha sido creado.
            </div>
            <?php
        }else if(isset($_GET['error'])){
            ?>
            <div class="alert alert-danger">
                Ha ocurrido un error al crear el usario, por favor intente de nuevo.
            </div>
            <?php
        }
        ?>
    </div>
    <div class="form-group text-center">
            <?php
         if(isset($_GET['errorObservacionFoto'])){
            ?>
            <div class="alert alert-danger">
                Ha ocurrido un error al Modificar La imagen, por favor intente de nuevo.
            </div>
            <?php
        }
        ?>

    </div>
    <div class="form-group text-center">
        <?php
        if(isset($_GET['successDelete'])){
            ?>
            <div class="alert alert-success">
                El usuario ha sido Eliminado.
            </div>
            <?php
        }else if(isset($_GET['errorDelete'])){
            ?>
            <div class="alert alert-danger">
                Ha ocurrido un error al eliminar el usario, por favor intente de nuevo.
            </div>
            <?php
        }
        ?>
    </div>
    <div class="form-group text-center">
        <?php
        if(isset($_GET['successObservacion'])){
            ?>
            <div class="alert alert-success">
                incidencia Guardada
            </div>
            <?php
        }else if(isset($_GET['errorObservacion'])){
            ?>
            <div class="alert alert-danger">
                Ha ocurrido un error al eliminar el registro, por favor intente de nuevo.
            </div>
            <?php
        }
        ?>
    </div>
    <div class="form-group text-center">
        <?php
        if(isset($_GET['successEditObs'])){
            ?>
            <div class="alert alert-success">
                incidencia Actualizada
            </div>
            <?php
        }else if(isset($_GET['errorEditObs'])){
            ?>
            <div class="alert alert-danger">
                Ha ocurrido un error al actualizar el registro, por favor intente de nuevo.
            </div>
            <?php
        }else if(isset($_GET['successUpdate'])){
        ?>
        <div class="alert alert-success">
           El usuario se ha modoficado Correctamente
        </div>
        <?php
        }
        ?>
    </div>
    <table class="table" id="tabla">
        <thead class="table-info">
        <tr>
            <td colspan="6">
                <input id="buscar" type="text" class="form-control" placeholder="Buscar..." />
            </td>
        </tr>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nombre</th>
            <th scope="col">Licencia</th>            
            <th scope="col">Vencimiento</th>
            <th scope="col">Acciones</th>
        </tr>

        </thead>
        <tbody>
        <?php

        if(count($choferes)>0){
            $i=1;

            foreach ($choferes as $column =>$value) {
                ?>
                <tr>
                    <th scope="row"><?= $i; ?></th>
                    <td><?= $value['NombreEmpleado']." ".$value['ApellidosEmpleado']; ?></td>
                    <td><?= $value['NumeroLicencia']; ?></td>                    
                    <td><?= $value['VencimientoLicencia']; ?></td>
                    <td>
                        <button onclick="myModalInfo(<?= $value['idEmpleado'];?>)" class="btn btn-info">
                            <i class="fa fa-address-card-o"></i>
                        </button>
                        <button onclick="myModalEdit(<?= $value['idEmpleado']; ?>)" class="btn btn-success">
                            <i class="fa fa-edit"></i>
                        </button>
                        <button onclick="myModalDelete(<?= $value['idEmpleado']; ?>,'<?= $value['NombreEmpleado']." ".$value['ApellidosEmpleado'];?>')" class="btn btn-danger">
                            <i class="fa fa-trash"></i>
                        </button>
                        <button onclick="mymodalObservacion(<?= $value['idEmpleado']; ?>)" class="btn btn-warning">
                            <i class="fa fa-info"></i>
                        </button>
                    </td>

                </tr>
                <?php
                $i++;
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
        </tbody>
    </table>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form enctype="multipart/form-data"  action="./Controller/ChoferController.php?folder=choferes" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Operador</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div role="tabpanel">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li  role="presentation" class="nav-item">
                                <a id="myTab" class="nav-link active" href="#uploadTab" aria-controls="uploadTab" role="tab" data-toggle="tab">
                                    Datos Personales
                                </a>
                            </li>
                            <li role="presentation" class="nav-item">
                                <a href="#browseTab"  class="nav-link" aria-controls="browseTab" role="tab" data-toggle="tab">
                                    Licencia y Acto Medico
                                </a>
                            </li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="uploadTab">
                                <div class="row">
                                    <div class="col-md-5">
                                        <label>Foto</label>
                                        <img src="assets/img/users/default.jpg" style="width: 100%; height: auto;">
                                        <input type="file" class="form-control-file" accept="image/*" id="FotoE" name="uploadedfile">
                                    </div>
                                    <div class="col-md-7 row">
                                        <div class="col-12">
                                                <label>Nombre</label>
                                                <input type="text" class="form-control" id="nombre" name="nombre" required>
                                            </div>
                                        <input type="hidden" value="1" id="id" name="id">
                                        <div class="col-md-12">
                                                <label>Apellidos</label>
                                                <input type="text" class="form-control" id="apellidos" name="apellidos"  required>
                                        </div>
                                        <div class="col-md-6">
                                            <lbel>Fecha de nacimiento</lbel>
                                            <input type="date" class="form-control"id="nacimiento" name="nacimiento"  required>
                                        </div>
                                        
                                    </div>
                                    <div class="col-md-12">
                                        <div class="col-md-6">
                                            <label>Telefono</label>
                                            <input type="tel" class="form-control" id="telefono" name="telefono"  required></div>
                                        <div class="col-md-6">
                                            <label>Telefono 2</label>
                                            <input type="tel" class="form-control" id="Telefono2" name="Telefono2" >
                                        </div>
                                        <div class="col-md-6">
                                            <label>Direccion</label>
                                            <input type="text" class="form-control" id="direccion" name="direccion" >
                                        </div>
                                        <div class="col-md-6">
                                            <label>Ciudad</label>
                                            <input type="text" class="form-control" id="ciudad" name="ciudad" >
                                        </div>
                                        <div class="col-md-6">
                                            <label>Ingreso</label>
                                            <input type="date" class="form-control" id="ingreso" name="ingreso"  required>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Numero de Empleado</label>
                                            <input type="text" class="form-control" id="EmpleadoNum" name="EmpleadoNum">
                                        </div>
                                    </div>

                                </div>

                            </div>
                            <div role="tabpanel" class="tab-pane" id="browseTab">
                                <div class="row">
                                    <div class="col-md-7">
                                        <label>Numero de Licencia</label>
                                        <input type="text" class="form-control" id="licencia" name="licencia"  required>
                                    </div>                                    
                                    <div class="col-md-6">
                                        <label>Vencimiento de licencia</label>
                                        <input type="date" class="form-control" id="caducidad" name="caducidad"  required>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Fotografia Licencia</label>
                                        <input type="file"id="Licencia" name="Licencia" class="form-control" accept="image/*">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Vencimiento de Apto Medico</label>
                                        <input type="date" class="form-control" id="caducidadMedico" name="caducidadMedico"  required>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Fotografia Acto Medico</label>
                                        <input type="file" id="Apto" name="Apto"class="form-control" accept="image/*">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" name="create" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Info-->
<div class="modal fade" id="exampleModalInfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><label id="exampleModalLabelInfo"></label></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div role="tabpanel">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" id="nav-tab" role="tablist">
                        <li role="presentation" class="nav-item">
                            <a class="nav-link active" href="#uploadTab1" aria-controls="uploadTab1" role="tab" data-toggle="tab">
                                Empleado
                            </a>
                        </li>
                        <li role="presentation" class="nav-item">
                            <a class="nav-link" href="#browseTab1" aria-controls="browseTab1" role="tab" data-toggle="tab">
                                Datos
                            </a>
                        </li>
                        <li role="presentation" class="nav-item">
                            <a class="nav-link" href="#browse" aria-controls="browse" role="tab" data-toggle="tab">
                                Incidencias
                            </a>
                        </li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="uploadTab1">
                            <div class="row">
                                <div class="col-md-4">
                                    <img style="width: 100%; height: auto;" id="imgInfo" src="">
                                </div>
                                <div class="row col-md-8">
                                    <div class="col-md-12">
                                        <label>Numero de Empleado</label>
                                        <input type="text" id="EmpleadoNumInfo" name="EmpleadoNumInfo" class="form-control" disabled>
                                    </div>
                                    <div class="col-md-12">
                                        <label>Nombre</label>
                                        <input type="text" id="nameInfo" name="nameInfo" class="form-control" disabled>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Fecha de Nacimiento</label>
                                        <input type="date" id="NacimientoInfo" class="form-control"  disabled>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Dia de Descanso</label>
                                        <input type="text" id="descanso" class="form-control"  disabled>
                                    </div>
                                </div>



                                <div class="col-md-7">
                                    <label>Domicilio</label>
                                    <input type="text" value="" id="domicilioInfo" class="form-control" disabled>
                                </div>
                                <div class="col-md-5">
                                    <label>Ciudad</label>
                                    <input type="text" value="" id="ciudadInfo" class="form-control" disabled>
                                </div>
                                <div class="col-md-6">
                                    <label>Telefono Personal</label>
                                    <input type="text" value="" id="personalInfo" class="form-control" disabled>
                                </div>
                                <div class="col-md-6">
                                    <label>Telefono Empresa</label>
                                    <input type="text" value="" id="empresaInfo" class="form-control" disabled>
                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="browseTab1">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Ingreso</label>
                                        <input type="date" id="ingresoInfo" class="form-control" disabled>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Estatus</label>
                                        <input type="text" value="" id="estatus" class="form-control" disabled>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Salida</label>
                                        <input type="text" value="" id="salida" class="form-control" disabled>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Motivo Salida</label>
                                        <input type="text" value="" id="motivoS" class="form-control" disabled>
                                    </div>
                                    <div class="col-md-12">
                                        <h4>Licencia</h4>
                                    </div>
                                    <div class="col-md-12 row">
                                        <div class="col-md-3">
                                            <label>Numero</label>
                                            <input type="text" value="" id="numeroL" class="form-control" disabled>
                                        </div>    
                                        <div class="col-md-3">
                                            <label>Vencimiento Licencia</label>
                                            <input type="date" value="" id="caducidadL" class="form-control" disabled>
                                        </div>
                                        <div class="col-md-5">                                            
                                            <a href="assets/img/licencia/licencia.jpg" target="_blank"><img style="width: 100%; height: 30%;" id="imgLicencia" src=""></a>
                                        </div>
                                    </div>                                                                        
                                    <div class="col-md-12 row">
                                        <div class="col-md-6">
                                            <label>Vencimiento Acto Medico</label>
                                            <input type="date" value="" id="caducidadParteMedico" class="form-control" disabled>
                                        </div> 
                                        <div class="col-md-5">
                                        <a target="_blank" href="assets/img/apto/medico.jpg"><img style="width: 100%; height: 30%;" id="imgApto" src=""></a>
                                        </div>                                    
                                    </div>
                                    
                                </div>
                            </div>
                        <div role="tabpanel" class="tab-pane" id="browse">
                            <table class="table">
                                <thead class="table-info">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Fecha</th>
                                    <th scope="col">Incidencia</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                                </thead>
                                <tbody id="result">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="exampleModalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form enctype="multipart/form-data" action="./Controller/ChoferController.php?folder=choferes" method="post">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><label id="exampleModalLabelInfo"></label> </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div role="tabpanel">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs"  role="tablist">
                        <li role="presentation" class="nav-item">
                            <a class="nav-link active" id="myTab" href="#uploadTab2" aria-controls="uploadTab2" role="tab" data-toggle="tab">
                                Empleado
                            </a>
                        </li>
                        <li role="presentation" class="nav-item">
                            <a class="nav-link" href="#browseTab2" aria-controls="browseTab2" role="tab" data-toggle="tab">
                                Datos
                            </a>
                        </li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="uploadTab2">
                            <div class="row">
                                <div class="col-md-4">
                                    <img style="width: 100%; height: auto;" id="imgInfoE" src="">
                                    <input style="width: 100%; height: auto;" id="imgFileE" type="file"accept="image/*" name="uploadedfile" class="form-control-file">

                                </div>

                                <div class="col-md-8 row">
                                    <div class="col-md-6">
                                        <label>Numero de Empleado</label>
                                        <input type="text" id="EmpleadoNumEdit" name="EmpleadoNumEdit" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Dia de Descanso</label>
                                        <select id="descansoEdit" name="descansoEdit" class="form-control">
                                            <option value=""></option>
                                            <option value="1">Lunes</option>
                                            <option value="2">Martes</option>
                                            <option value="3">Miercoles</option>
                                            <option value="4">Jueves</option>
                                            <option value="5">Viernes</option>
                                            <option value="6">Sabado</option>
                                            <option value="0">Domingo</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12">
                                        <label>Fecha de Nacimiento</label>
                                        <input type="date" id="NacimientoEdit" name="NacimientoEdit" value="" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Nombre</label>
                                        <input type="text" id="nameEdit" name="nameEdit" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Apellidos</label>
                                        <input type="text" id="apellidoEdit" name="apellidoEdit" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12 row"></div>
                                <div class="col-md-7">
                                    <label>Domicilio</label>
                                    <input type="text" value="" id="domicilioEdit" name="domicilioEdit" class="form-control">
                                </div>
                                <div class="col-md-5">
                                    <label>Ciudad</label>
                                    <input type="text" value="" id="ciudadEdit" name="ciudadEdit" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label>Telefono Personal</label>
                                    <input type="text" value="" id="personalEdit" name="personalEdit" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label>Telefono Empresa</label>
                                    <input type="text" value="" id="empresaEdit" name="empresaEdit" class="form-control">
                                </div>

                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="browseTab2">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Ingreso</label>
                                    <input type="date" value="" id="ingresoEdit" name="ingresoEdit" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label>Estatus</label>
                                    <select name="estatusEdit" id="estatusEdit" class="form-control" >
                                        <option value="1">Activo</option>
                                        <option value="0">Baja</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label>Salida</label>
                                    <input type="date" value="" id="salidaEdit" name="salidaEdit" class="form-control">
                                </div>                                
                                <div class="col-md-12">
                                    <h4>Licencia</h4>
                                </div>
                                <div class="col-md-3">
                                    <label>Numero</label>
                                    <input type="text" value="" id="numeroLEdit" name="numeroLEdit" class="form-control">
                                </div>
                                
                                <div class="col-md-3">
                                    <label>Vencimiento</label>
                                    <input type="date" value="" id="caducidadLEdit" name="caducidadLEdit" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label>Fotografia Licencia</label>
                                    <input type="file" class="form-control" name="LicenciaEdit" accept="image/*">
                                </div>
                                <div class="col-md-12">
                                    <h4>Acto Medico</h4>
                                </div>
                                <div class="col-md-6">
                                    <label>Vencimiento</label>
                                    <input type="date" value="" id="caducidadParteMEdit" name="caducidadParteMEdit" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label>Fotografia Acto Medico</label>
                                    <input type="file" class="form-control" name="AptoEdit" accept="image/*">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

                <input type="hidden" name="IdEmp" id="IdEmp">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" name="updateChofer" id="updateChofer"  class="btn btn-success">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal observacion -->
<div class="modal fade" id="modalObservacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form enctype="multipart/form-data" action="./Controller/HomeController.php?page=choferes" method="post">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nueva incidencia</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <label>incidencia</label>
                        <input type="text" name="observ" class="form-control">
                    </div>
                    <div class="col-md-6">
                        <label>Fecha</label>
                        <input type="date" name="fechaObserv" class="form-control">
                    </div>
                    <div class="col-md-12">
                        <label>Descripcion</label>
                        <textarea name="Descripcion" rows="5" class="form-control"></textarea>
                    </div>
                    <div class="col-md-12">
                        <label>Evidencia</label>
                        <input type="file" name="uploadedfile" class="form-control-file" accept="image/*, video/*">
                    </div>
                    <input type="hidden" name="idEmpO" id="idEmpO">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="submit" name="observacion" class="btn btn-primary">Guardar</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal InfoObservcaion -->
<div class="modal" id="modalObservacionInfo" tabindex="-1" role="dialog">
    <div class="modal-dialog"  role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">incidencia</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
               <div class="row">
                   <div class="col-md-7">
                       <label>incidencia</label>
                       <input type="text" id="tituloObs" class="form-control" disabled>
                   </div>
                   <div class="col-md-5">
                       <label>Fecha</label>
                       <input type="date" id="fechaObs" class="form-control" disabled>
                   </div>
                   <div class="col-md-12">
                       <label>Descripcion</label>
                       <textarea name="DescripcionInfo" id="DescripcionInfo" disabled rows="5" class="form-control"></textarea>
                   </div>
                   <div class="col-md-12">
                       <h4>Evidencia</h4>
                   </div>
                   <div class="col-md-12" id="evidenciasMulti">

                   </div>
               </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal EditObservcaion -->
<div class="modal" id="modalObservacionEdit" tabindex="-1" role="dialog">
    <div class="modal-dialog"  role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Observacion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="./Controller/HomeController.php?page=choferes" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-7">
                            <label>Observacion</label>
                            <input type="text" id="tituloObsEdit" name="tituloObsEdit" class="form-control">
                        </div>
                        <div class="col-md-5">
                            <label>Fecha</label>
                            <input type="date" id="fechaObsEdit" name="fechaObsEdit" class="form-control">
                        </div>
                        <div class="col-md-12">
                            <label>Descripcion</label>
                            <textarea name="DescripcionInfoEdit" id="DescripcionInfoEdit" rows="5" class="form-control"></textarea>
                        </div>
                        <input type="hidden" name="ObsEdit" id="ObsEdit">
                        <div class="col-md-6"></div>
                        <div class="col-md-6">
                            <button type="submit" name="UpdateObs" class="btn btn-primary">Actualizar</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
            </form>
        </div>
        <form enctype="multipart/form-data" action="./Controller/HomeController.php?page=choferes" method="post">
            <div class="row modal-footer">
                <div class="col-md-12">
                    <input type="hidden" id="id_obs" name="id_obs">
                    <h3>Agegar Evidencia</h3>
                    <input type="file" class="form-control" id="uploadedfile" name="uploadedfile">
                </div>
                <div class="modal-footer">
                    <button type="submit" name="evidenciaAdd" class="btn btn-primary">Agregar Evidencia</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    function deleteEvidencia(id) {
        if(confirm("Esta seguro que decea eliminar la evidencia")){
            $.ajax({
                type: 'POST',
                url: './Controller/HomeController.php',
                dataType: 'json',
                data: {'eventID': id, 'deleteEvidencia': true},
                success: function (data) {
                    alert("la evidencia fue borrada exitosamente");
                    location.reload();
                },
                error: function (error) {
                    alert("Error al eliminar evidencia");
                }
            })
        }

    }
    function modalObservacionInfo(id) {
        $.ajax({
            type: "POST",
            url: "./Controller/HomeController.php",
            dataType: "json",
            data: {'eventID':id, 'obs': true},
            success: function (data) {
                if (data.length >0){
                document.getElementById("tituloObs").value = data[0].Titulo;
                document.getElementById("fechaObs").value = data[0].FechaInsidencia;
                document.getElementById("DescripcionInfo").value = data[0].Observacion;
                $.ajax({
                    type: 'POST',
                    url: './Controller/HomeController.php',
                    dataType: "json",
                    data: {'eventID':data[0].idObservaciones, 'evidencia':true},
                    success: function (data) {
                        $("#evidenciasMulti").empty();
                        if(data.length > 0){
                            $.each(data, function (f, a) {
                                $("#evidenciasMulti").append( "<a href='"+a.evidencia+"' class='form-control'>"+a.NombreEvidencia+"</a>" +
                                    "<button onclick='deleteEvidencia("+a.idEvidencia+")' class='btn btn-danger form-control'>" +
                                    "<i class='fa fa-trash'></i>" +
                                    "</button>");
                            })
                        }
                        else{

                        }
                    },
                    error: function (error) {
                        alert("Error");
                    }
                })
                }
            },
            error: function (error) {
            }
        })
        $("#modalObservacionInfo").modal("show");
    }
    function modalObservacionEdit(id) {
        $.ajax({
            type: "POST",
            url: "./Controller/HomeController.php",
            dataType: "json",
            data: {'eventID':id, 'obs': true},
            success: function (data) {
                if (data.length >0){
                    document.getElementById("tituloObsEdit").value = data[0].Titulo;
                    document.getElementById("fechaObsEdit").value = data[0].FechaInsidencia;
                    document.getElementById("DescripcionInfoEdit").value = data[0].Observacion;
                    document.getElementById("ObsEdit").value = data[0].idObservaciones;
                    document.getElementById("id_obs").value = data[0].idObservaciones;
                }
            },
            error: function (error) {
            }
        })
        $("#modalObservacionEdit").modal("show");
    }
    function myModalInfo(id) {
        $("#result").empty();
        $.ajax({
            type: "POST",
            url: "./Controller/HomeController.php",
            dataType: 'json',
            data: {'eventID': id, 'info': true},
            success: function (data) {
                $.ajax({
                    type: "POST",
                    url: "./Controller/HomeController.php",
                    dataType: 'json',
                    data: {'eventID': id, 'observaciones': true},
                    success:function (data) {
                        if (data.length > 0){
                            $("#result").empty();
                            $.each(data, function (f, a) {
                                $("#result").append("<tr>" +
                                    "<th>"+(f+1)+"</th>" +
                                    "<td><label>" + a.FechaInsidencia+ "</label></td>" +
                                    "<td>" + a.Titulo +"</td>" +
                                    "<td id='"+f+"'></td>");
                                    $("#"+f).append("<buttton class='btn btn-info' onclick='modalObservacionInfo("+a.idObservaciones+")'><i class='fa fa-info'></i></button>");
                                    $("#"+f).append("<buttton class='btn btn-success' onclick='modalObservacionEdit("+a.idObservaciones+")'><i class='fa fa-edit'></i></button>");
                                    $("#"+f).append("<buttton class='btn btn-danger' onclick='myModalDeleteObs("+a.idObservaciones+")'><i class='fa fa-trash'></i></button>");
                                $("#result").append( "</tr>");
                            })
                        }
                        else {
                        }
                    },
                    error: function (error) {

                    }
                })
                $.each(data, function (i, v) {
                    var estatus;
                    var salida;
                    var motivo;
                    if(v.EstatusEmpleado == 1){
                        estatus = "Activo";
                    }
                    else {
                        estatus="Baja"
                    }
                    if (v.SalidaEmpleado == null || v.SalidaEmpleado == ""){
                        salida = "N/A";
                    }
                    if (v.MotivoSalida == null || v.MotivoSalida == ""){
                        motivo = "N/A";
                    }
                    $("#imgInfo").attr("src",v.Foto);
                    document.getElementById("nameInfo").value = v.NombreEmpleado +" "+v.ApellidosEmpleado;
                    document.getElementById("domicilioInfo").value = v.Direccion;
                    document.getElementById("ciudadInfo").value = v.Ciudad;
                    document.getElementById("personalInfo").value = v.TelefonoEmpleado;
                    document.getElementById("empresaInfo").value = v.TelefonoTrabajo;
                    document.getElementById("caducidadParteMedico").value = v.ParteMedico;
                    document.getElementById("NacimientoInfo").value = v.FechaNacimiento;
                    document.getElementById("ingresoInfo").value = v.IngresoEmpleado;
                    document.getElementById("estatus").value = estatus;
                    document.getElementById("salida").value = salida;
                    document.getElementById("motivoS").value = motivo;
                    document.getElementById("numeroL").value = v.NumeroLicencia;
                    //document.getElementById("tipoLi").value = v.TipoLicencia;
                    document.getElementById("caducidadL").value = v.VencimientoLicencia;
                    document.getElementById("empresaInfo").value = v.TelefonoTrabajo;
                    document.getElementById("EmpleadoNumInfo").value = v.NumeroEmpleado;
                    $("#imgLicencia").attr("src",v.FotoLicencia);
                    $("#imgApto").attr("src",v.FotoApto);
                    /*switch (v.diaDescanso) {
                        case "1":
                            document.getElementById("descanso").value = "Lunes";
                            break;
                        case "2":
                            document.getElementById("descanso").value = "Martes";
                            break;
                        case "3":
                            document.getElementById("descanso").value = "Miercoles";
                            break;
                        case "4":
                            document.getElementById("descanso").value = "Jueves";
                            break;
                        case "5":
                            document.getElementById("descanso").value = "Viernes";
                            break;
                        case "6":
                            document.getElementById("descanso").value = "Sabado";
                            break;
                        case "0":
                            document.getElementById("descanso").value = "Domingo";
                            break;
                        default:
                            document.getElementById("descanso").value = "No Asignado";
                    }*/
                        $("#exampleModalInfo").modal("show");


                })
            },
            error: function (error) {
                alert('failed');
            }
        })

    }
    function myModalDelete(id, name) {
        if(confirm("Esta Seguro que desea elminar al usuario: "+name)){
            $.ajax({
                type: "POST",
                url: "./Controller/ChoferController.php",
                dataType: 'json',
                data: {'eventID': id, 'delete': true},
                success: function (data) {
                    alert("Usuario Eliminado");
                    location.reload();
                },
                error: function (error) {
                    alert('Error al Eliminar usuario');
                }
            })
        }
        else {

        }
       /* */
    }
    function myModalDeleteObs(id) {
        if(confirm("Esta Seguro que desea elminar esta incidencia ")){
            $.ajax({
                type: "POST",
                url: "./Controller/HomeController.php",
                dataType: 'json',
                data: {'eventID': id, 'deleteObs': true},
                success: function (data) {
                    alert("Incidencia Eliminada");
                    location.reload();
                },
                error: function (error) {
                    alert('Error al Eliminar incidencia');
                }
            })
        }
        else {

        }
        /* */
    }
    function myModalEdit(id) {
        $.ajax({
            type: "POST",
            url: "./Controller/HomeController.php",
            dataType: 'json',
            data: {'eventID': id, 'info': true},
            success: function (data) {
                $.each(data, function (i, v) {
                    $("#imgInfoE").attr("src",v.Foto);
                    document.getElementById("nameEdit").value = v.NombreEmpleado;
                    document.getElementById("apellidoEdit").value =  v.ApellidosEmpleado;
                    document.getElementById("domicilioEdit").value = v.Direccion;
                    document.getElementById("ciudadEdit").value = v.Ciudad;
                    document.getElementById("personalEdit").value = v.TelefonoEmpleado;
                    document.getElementById("empresaEdit").value = v.TelefonoTrabajo;
                    document.getElementById("NacimientoEdit").value = v.FechaNacimiento;
                    document.getElementById("ingresoEdit").value = v.IngresoEmpleado;
                    document.getElementById("estatusEdit").value = v.EstatusEmpleado;
                    document.getElementById("salidaEdit").value = v.SalidaEmpleado;
                    //document.getElementById("motivoSEdit").value = v.MotivoSalida;
                    document.getElementById("numeroLEdit").value = v.NumeroLicencia;
                    //document.getElementById("tipoLiEdit").selectedIndex  = v.TipoLicencia;
                    document.getElementById("caducidadLEdit").value = v.VencimientoLicencia;
                    document.getElementById("caducidadParteMEdit").value = v.ParteMedico;
                    document.getElementById("EmpleadoNumEdit").value = v.NumeroEmpleado;                    
                    document.getElementById("IdEmp").value = v.idEmpleado;
                    document.getElementById("descansoEdit").value = v.diaDescanso;
                    //document.getElementById("imgFileE").value = v.Foto;
                    $("#exampleModalEdit").modal("show");


                })
            },
            error: function (error) {
                alert('failed');
            }
        })

    }
    function mymodalObservacion(id){
        document.getElementById("idEmpO").value = id;
        $("#modalObservacion").modal("show");
    }


    document.querySelector("#buscar").onkeyup = function(){
        $TableFilter("#tabla", this.value);
    }
    $TableFilter = function(id, value){
        var rows = document.querySelectorAll(id + ' tbody tr');

        for(var i = 0; i < rows.length; i++){
            var showRow = false;

            var row = rows[i];
            row.style.display = 'none';

            for(var x = 0; x < row.childElementCount; x++){
                if(row.children[x].textContent.toLowerCase().indexOf(value.toLowerCase().trim()) > -1){
                    showRow = true;
                    break;
                }
            }

            if(showRow){
                row.style.display = null;
            }
        }
    }

</script>