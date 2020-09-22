<?php
include './Model/Empleado.php';
$empleado = new Empleado();
$boletero =$empleado->getInspectores();
$ubicacion = $empleado->getUbicaciones();
?>
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#">
                    <em class="fa fa-search"></em>
                </a></li>
            <li class="active">Inspectores</li>
        </ol>
    </div><!--/.row-->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Reporte General Inspectores</h1>
        </div>
    </div><!--/.row-->
    <div>
        <div><button class="btn btn-primary" data-toggle="modal" data-target="#modalNuevoBoletero">Nuevo Inspector</button></div>
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
            if(isset($_GET['successEdit'])){
                ?>
                <div class="alert alert-success">
                    El usuario ha sido Actualizado.
                </div>
                <?php
            }else if(isset($_GET['errorEdit'])){
                ?>
                <div class="alert alert-danger">
                    Ha ocurrido un error al actualizar el usario, por favor intente de nuevo.
                </div>
                <?php
            }
            else if(isset($_GET['successObservacion'])){
                ?>
                <div class="alert alert-success">
                    La incidencia se ha Guradado con <strong>EXITO</strong>
                </div>
                <?php
            }else if(isset($_GET['errorEditObs'])){
                ?>
                <div class="alert alert-danger">
                    <strong>ERROR</strong> La incidencia no se ha podido modificar
                </div>
                <?php
            }
            else if(isset($_GET['successEditObs'])){
            ?>
            <div class="alert alert-success">
                La Incidencia se ha modificado con <strong>EXITO</strong>
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
                <th scope="col">Ingreso</th>
                <th scope="col">Acciones</th>
            </tr>

            </thead>
            <tbody>
            <?php

            if(count($boletero)>0){
                $i=1;

                foreach ($boletero as $column =>$value) {
                    ?>
                    <tr>
                        <th scope="row"><?= $i; ?></th>
                        <td><?= $value['NombreEmpleado']." ".$value['ApellidosEmpleado']; ?></td>
                        <td><?= $value['IngresoEmpleado'] ?></td>
                        <td>
                            <button onclick="myModaleInfo(<?= $value['idEmpleado'];?>)" class="btn btn-info">
                                <i class="fa fa-address-card-o"></i>
                            </button>
                            <button onclick="myModalEdit(<?= $value['idEmpleado']; ?>)" class="btn btn-success">
                                <i class="fa fa-edit"></i>
                            </button>
                            <button onclick="myModalDelete(<?= $value['idEmpleado']; ?>,'<?= $value['NombreEmpleado']." ".$value['ApellidosEmpleado'];?>')" class="btn btn-danger">
                                <i class="fa fa-trash"></i>
                            </button>
                            <button onclick="mymodalObservacion(<?= $value['idEmpleado'];?>)" class="btn btn-warning">
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
    <!-- Modal Agregar -->
    <div class="modal fade" id="modalNuevoBoletero" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form enctype="multipart/form-data" action="./controller/Homecontroller.php?page=inspectores" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Agregar Personal</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <label>Foto</label>
                                <img src="assets/img/users/default.jpg" style="width: 100%; height: auto;">
                                <input type="file" class="form-control-file" accept="image/*" id="uploadedfile" name="uploadedfile">
                            </div>
                            <div class="row col-md-8">
                                <div class="col-md-6">
                                    <label>Nombre</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                                </div>
                                <div class="col-md-6">
                                    <label>Apellidos</label>
                                    <input type="text" class="form-control" id="apellidos" name="apellidos"  required>
                                </div>
                                <div class="col-md-6">
                                    <label>Fecha de nacimiento</label>
                                    <input type="date" class="form-control"id="nacimiento" name="nacimiento"  required>
                                </div>
                                <div class="col-md-6">
                                            <label>Dia de Descanso</label>
                                            <select id="diaDescanso" name="diaDescanso" class="form-control" require>
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
                                <div class="col-md-6">
                                    <label>Numero de Empleado</label>
                                    <input type="text" class="form-control"id="EmpleadoNumero" name="EmpleadoNumero"  required>
                                </div>
                                <input type="hidden" value="3" name="idTipoEmpleado" name="idTipoEmpleado">
                                <input type="hidden" value="3" id="id" name="id">
                            </div>
                            <div class="row col-md-12">
                                <div class="col-md-4">
                                    <label>Telefono</label>
                                    <input type="tel" class="form-control" id="telefono" name="telefono"  required>
                                </div>
                                <div class="col-md-4">
                                    <label>Telefono Empresa</label>
                                    <input type="tel" class="form-control" id="telefono2" name="telefono2" >
                                </div>
                                <div class="col-md-4">
                                    <label>Ubicacion</label>
                                    <select id="ubicacion" name="ubicacion" class="form-control" required>
                                        <option value="">Selecciona una Ubicacion</option>
                                        <?php
                                        if(count($ubicacion)>0){
                                            foreach ($ubicacion as $column => $value){
                                                ?>
                                                <option value="<?= $value['idUbicacion']; ?>"><?= $value['Ubicacion']; ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-5">
                                    <label>Direccion</label>
                                    <input type="text" class="form-control" id="direccion" name="direccion" >
                                </div>

                                <div class="col-md-3">
                                    <label>Ciudad</label>
                                    <input type="text" class="form-control" id="ciudad" name="ciudad" >
                                </div>
                                <div class="col-md-4">
                                    <label>Ingreso</label>
                                    <input type="date" class="form-control" id="ingreso" name="ingreso"  required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" name="Empleado" class="btn btn-primary">Guardar</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <!-- Modal Editar -->
    <div class="modal fade" id="modalEditBoletero" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form enctype="multipart/form-data" action="./controller/Homecontroller.php?page=inspectores" method="POST">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Agregar Inspector</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <img id="imgEdit" src="assets/img/users/default.jpg" style="width: 100%; height: auto;">
                                <input type="file" class="form-control-file" accept="image/*" id="" name="uploadedfile">
                            </div>
                            <div class="row col-md-8">
                                <div class="col-md-6">
                                    <label>Nombre</label>
                                    <input type="text" class="form-control" id="nombreE" name="nombreE" required>
                                </div>
                                <div class="col-md-6">
                                    <label>Apellidos</label>
                                    <input type="text" class="form-control" id="apellidosE" name="apellidosE"  required>
                                </div>
                                <div class="col-md-6">
                                    <label>Fecha de nacimiento</label>
                                    <input type="date" class="form-control"id="nacimientoE" name="nacimientoE"  required>
                                </div>
                                <div class="col-md-6">
                                            <label>Dia de Descanso</label>
                                            <select id="diaDescansoEdit" name="diaDescansoEdit" class="form-control" require>
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
                                <div class="col-md-6">
                                    <label>Numero de Empleado</label>
                                    <input type="text" class="form-control" id="EmpleadoNumEdit" name="EmpleadoNumEdit"  required>
                                </div>
                            </div>
                            <div class="row col-md-12">
                                <div class="col-md-4">
                                    <label>Telefono</label>
                                    <input type="tel" class="form-control" id="telefonoE" name="telefonoE"  required>
                                </div>
                                <div class="col-md-4">
                                    <label>Telefono Empresa</label>
                                    <input type="tel" class="form-control" id="telefono2E" name="telefono2E" >
                                </div>
                                <div class="col-md-4">
                                    <label>Ubicacion</label>
                                    <select id="ubicacionEdit" name="ubicacionEdit" class="form-control" required>
                                        <option value="">Selecciona una Ubicacion</option>
                                        <?php
                                        if(count($ubicacion)>0){
                                            foreach ($ubicacion as $column => $value){
                                                ?>
                                                <option value="<?= $value['idUbicacion']; ?>"><?= $value['Ubicacion']; ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-5">
                                    <label>Direccion</label>
                                    <input type="text" class="form-control" id="direccionE" name="direccionE" >
                                </div>
                                <div class="col-md-3">
                                    <label>Ciudad</label>
                                    <input type="text" class="form-control" id="ciudadE" name="ciudadE" >
                                </div>
                                <div class="col-md-4">
                                    <label>Ingreso</label>
                                    <input type="date" class="form-control" id="ingresoE" name="ingresoE"  required>
                                </div>
                                <input type="hidden" id="idEdit" name="idEdit">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" name="updateEmpleado" class="btn btn-primary">Guardar</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <!-- Modal Info -->
    <div class="modal fade" id="modalInfoBoletero" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Informacion de Personal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Nav tabs -->
                    <div role="tabpanel">
                        <ul class="nav nav-tabs" id="nav-tab" role="tablist">
                            <li role="presentation" class="nav-item">
                                <a class="nav-link active" href="#uploadTab1" aria-controls="uploadTab1" role="tab" data-toggle="tab">
                                    Informacion
                                </a>
                            </li>
                            <li role="presentation" class="nav-item">
                                <a class="nav-link" href="#uploadTab2" aria-controls="uploadTab2" role="tab" data-toggle="tab">
                                    Incidencias
                                </a>
                            </li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="uploadTab1">
                                <div class="row">
                                    <div class="col-md-4">
                                        <img src=""  id="imgInfoE" style="width: 100%; height: auto;">
                                    </div>
                                    <div class="row col-md-8">
                                        <div class="col-md-12">
                                            <label>Nombre</label>
                                            <input type="text" class="form-control" id="nombreInfo" name="nombreInfo" disabled>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Fecha de nacimiento</label>
                                            <input type="date" class="form-control"id="nacimientoInfo" name="nacimientoInfo"  disabled>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Dia de Descanso</label>
                                            <select id="diaDescansoInfo" name="diaDescansoInfo" class="form-control" disabled>
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
                                        <div class="col-md-6">
                                            <label>Numero de Empleado</label>
                                            <input type="text" class="form-control"id="EmpleadoNumInfo" name="EmpleadoNumInfo"  disabled>
                                        </div>

                                        <input type="hidden" value="2" id="tipo" name="tipo">
                                    </div>
                                    <div class="row col-md-12">
                                        <div class="col-md-4">
                                            <label>Telefono</label>
                                            <input type="tel" class="form-control" id="telefonoInfo" name="telefonoInfo"  disabled>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Telefono Empresa</label>
                                            <input type="tel" class="form-control" id="telefono2Info" name="telefono2Info" disabled>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Ubicacion</label>
                                            <input type="text" class="form-control" id="ubicacionInfo" name="ubicacionInfo" disabled>
                                        </div>
                                        <div class="col-md-5">
                                            <label>Direccion</label>
                                            <input type="text" class="form-control" id="direccionInfo" name="direccionInfo"disabled >
                                        </div>
                                        <div class="col-md-3">
                                            <label>Ciudad</label>
                                            <input type="text" class="form-control" id="ciudadInfo" name="ciudadInfo" disabled>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Ingreso</label>
                                            <input type="date" class="form-control" id="ingresoInfo" name="ingresoInfo"  disabled>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="uploadTab2">
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

    <!-- Modal Incidencias -->
    <div class="modal fade" id="modalObservacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form enctype="multipart/form-data" action="./controller/HomeController.php?page=inspectores" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Nueva Observacion</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <label>Observacion</label>
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
                    <h5 class="modal-title">Observacion</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-7">
                            <label>Observacion</label>
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
                <form action="./Controller/HomeController.php?page=inspectores" method="post">
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
            <form enctype="multipart/form-data" action="./Controller/HomeController.php?page=inspectores" method="post">
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
                                            "<button onclick='deleteEvidencia("+a.idEvidencia+")' class=\"btn btn-danger form-control\">\n" +
                                            "                            <i class=\"fa fa-trash\"></i>\n" +
                                            "                        </button>");
                                    })
                                }
                                else{

                                }
                            },
                            error: function (error) {

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
        function myModalDelete(id, name) {
            if(confirm("Esta Seguro que desea elminar al usuario: "+name)){
                $.ajax({
                    type: "POST",
                    url: "./Controller/HomeController.php",
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
        function mymodalObservacion(id){
            document.getElementById("idEmpO").value = id;
            $("#modalObservacion").modal("show");
        }
        function myModaleInfo(id) {
            $.ajax({
                type: "POST",
                url: "./Controller/HomeController.php",
                dataType: 'json',
                data: {'eventID': id, 'infoE': true},
                success: function (data) {
                    $("#result").empty();
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
                        $("#imgInfoE").attr("src",v.Foto);
                        document.getElementById("nombreInfo").value = v.NombreEmpleado + " " + v.ApellidosEmpleado ;
                        document.getElementById("direccionInfo").value = v.Direccion;
                        document.getElementById("ciudadInfo").value = v.Ciudad;
                        document.getElementById("telefonoInfo").value = v.TelefonoEmpleado;
                        document.getElementById("telefono2Info").value = v.TelefonoTrabajo;
                        document.getElementById("nacimientoInfo").value = v.FechaNacimiento;
                        document.getElementById("ingresoInfo").value = v.IngresoEmpleado;
                        document.getElementById("ubicacionInfo").value = v.Ubicacion;
                        document.getElementById("EmpleadoNumInfo").value = v.NumeroEmpleado;
                        document.getElementById("diaDescansoInfo").value = v.diaDescanso;
                        $("#modalInfoBoletero").modal("show");
                    })
                },
                error: function (error) {
                    alert('failed');
                }
            })

        }
        function myModalEdit(id) {
            $.ajax({
                type: "POST",
                url: "./Controller/HomeController.php",
                dataType: 'json',
                data: {'eventID': id, 'infoE': true},
                success: function (data) {
                    $.each(data, function (i, v) {
                        $("#imgEdit").attr("src",v.Foto);
                        document.getElementById("nombreE").value = v.NombreEmpleado ;
                        document.getElementById("apellidosE").value = v.ApellidosEmpleado ;
                        document.getElementById("direccionE").value = v.Direccion;
                        document.getElementById("ciudadE").value = v.Ciudad;
                        document.getElementById("telefonoE").value = v.TelefonoEmpleado;
                        document.getElementById("telefono2E").value = v.TelefonoTrabajo;
                        document.getElementById("nacimientoE").value = v.FechaNacimiento;
                        document.getElementById("ingresoE").value = v.IngresoEmpleado;
                        document.getElementById("ubicacionEdit").value = v.idUbicacion;
                        document.getElementById("idEdit").value = v.idEmpleado;
                        document.getElementById("EmpleadoNumEdit").value = v.NumeroEmpleado;
                        document.getElementById("diaDescansoEdit").value = v.diaDescanso;
                        $("#modalEditBoletero").modal("show");
                    })
                },
                error: function (error) {
                    alert('failed');
                }
            })

        }
        function myModalDeleteObs(id) {
            if(confirm("Esta Seguro que desea elminar esta Observacion ")){
                $.ajax({
                    type: "POST",
                    url: "./Controller/HomeController.php",
                    dataType: 'json',
                    data: {'eventID': id, 'deleteObs': true},
                    success: function (data) {
                        alert("Insidencia Eliminada");
                        location.reload();
                    },
                    error: function (error) {
                        alert('Error al Eliminar Insidencia');
                    }
                })
            }
            else {

            }
            /* */
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

<?php
