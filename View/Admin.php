<?php
if ($_SESSION['idTipoUsuario'] != 1){
    //echo $_SESSION['idTipoUsuario'];
    //header("Location: ../index.php");
    echo "<center><h2>Página no econtrada</h2></center>";
    exit();
}
include "./Model/Empleado.php";
$Empleado = new Empleado();
$asist = $Empleado->getEmpleadoAsist();
$admin = $Empleado->getEmpleadoAdmin();
$punto = $Empleado->getUbicaciones();
$new = $Empleado->getNews();
$emp = $Empleado->getEmpleadoNoAsist();
$tipo = $Empleado->getTipoUser();
$horario = $Empleado->getHorario();

?>
<div class="row">
    <ol class="breadcrumb">
        <li><a href="#">
                <em class="fa fa-ticket"></em>
            </a></li>
        <li class="active">Administrador</li>
    </ol>
</div><!--/.row-->

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Administrador TVT</h1>
    </div>
</div><!--/.row-->
<div class="form-group text-center">
    <?php
    if(isset($_GET['successUser'])){
        ?>
        <div class="alert alert-success">
            El usuario ha sido creado.
        </div>
        <?php
    }else if(isset($_GET['errorUser'])){
        ?>
        <div class="alert alert-danger">
            Ha ocurrido un error al crear el usario, por favor intente de nuevo.
        </div>
        <?php
    }
    ?>
</div>
<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-body tabs">
            <ul class="nav nav-pills">
                <li class="active"><a href="#pilltab1" data-toggle="tab">Usuarios</a></li>                
                <li><a href="#pilltab2" data-toggle="tab">Asistencias</a></li>
                <li><a href="#pilltab3" data-toggle="tab">Avisos</a></li>
                <li><a href="#pilltab4" data-toggle="tab">Puntos</a></li>
                <li><a href="#pilltab5" data-toggle="tab">Horarios</a></li>             
            </ul>
            <div class="tab-content">
                <div class="tab-pane fade in active" id="pilltab1">
                    <h4>Usuarios</h4>
                    <button class="btn btn-success" data-toggle="modal" data-target="#modalNuevoAdmin">
                        Nuevo Administrador
                    </button>
                    <div>
                        <table class="table">
                            <thead class="table-responsive">
                            <tr>
                                <th>#</th>
                                <th>Empleado</th>
                                <th>Usuario</th>
                                <th>Contraseña</th>
                                <th>Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                                if (count($admin)>0){
                                    $i = 1;
                                    foreach ($admin as $column => $value){
                                        ?>
                            <tr>
                                <td><?= $i ?></td>
                                <td><?= $value['NombreEmpleado']." ",$value['ApellidosEmpleado'] ?></td>
                                <td><?= $value['Usuario'] ?></td>
                                <td>*******</td>
                                <td>
                                    <button class="btn btn-default" onclick="modificarUser(<?= $value['idUsuario'] ?>)"><i class="fa fa-edit"></i></button>
                                    <button class="btn-danger" onclick="eliminarUser(<?= $value['idUsuario'] ?>)"><i class="fa fa-trash"></i></button>
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
                </div>
                <div class="tab-pane fade" id="pilltab2">
                    <h4>Asistencias</h4>
                    <button class="btn btn-success" data-toggle="modal" data-target="#modalUserAsist">
                        Nuevo Empleado
                    </button>
                    <div>
                        <table class="table">
                            <thead class="table-responsive">
                            <tr>
                                <th>#</th>
                                <th>Empleado</th>
                                <th>Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                                if (count($asist)>0){
                                    $i = 1;
                                    foreach ($asist as $column => $value){
                                        ?>
                            <tr>
                                <td><?= $i ?> </td>
                                <td><?= $value['NombreEmpleado']." ".$value['ApellidosEmpleado'] ?></td>
                                <td>
                                    <button onclick="eliminarUserAsist(<?= $value['idEmpleado'] ?>)" class="btn-danger"><i class="fa fa-trash"></i></button>
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
                                                No se encontraron Empleados para registro de asistencia.
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="pilltab3">
                    <h4>Avisos</h4>
                    <button class="btn btn-success" data-toggle="modal" data-target="#modalAvisos">
                        Nuevo Aviso
                    </button>
                    <div>
                        <table class="table">
                            <thead class="table-responsive">
                            <tr>
                                <th>#</th>
                                <th>Titulo</th>
                                <th>Descripcion</th>
                                <th>Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                                if (count($new)){
                                    $i=1;
                                    foreach ($new as $column => $value){
                                        ?>
                            <tr>
                                <td><?= $i ?> </td>
                                <td><?= $value['tituloAvis'] ?></td>
                                <td><p><?= $value['descripcionAviso'] ?></p></td>
                                <td>
                                    <button class="btn-info" onclick="editarAviso(<?= $value['idAviso'] ?>)"><i class="fa fa-edit"></i></button>
                                    <button class="btn-danger" onclick="borrarAviso(<?= $value['idAviso'] ?>)"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                                        <?php
                                    }
                                }else{
                            ?>
                                    <tr>
                                        <td colspan="4">
                                            <div class="alert alert-info">
                                                No se encontraron Avisos.
                                            </div>
                                        </td>
                                    </tr>
                            <?php
                                }?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="pilltab4">
                    <h4>Puntos</h4>
                    <button class="btn btn-success" data-toggle="modal" data-target="#modalNewPunto">
                        Nuevo Punto
                    </button>
                    <div>
                        <table class="table">
                            <thead class="table-responsive">
                            <tr>
                                <th>#</th>
                                <th>Punto</th>
                                <th>Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                                if (count($punto)>0){
                                    $i = 1;
                                    foreach ($punto as $column => $value){
                                        ?>
                            <tr>
                                <td><?= $i ?></td>
                                <td><?= $value['Ubicacion'] ?></td>
                                <td>
                                    <button class="btn-info" onclick="editarPunto(<?= $value['idUbicacion'] ?>)"><i class="fa fa-edit"></i></button>
                                    <button class="btn-danger" onclick="borrarPunto(<?= $value['idUbicacion'] ?>)"><i class="fa fa-trash"></i></button>
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
                                                No se encontraron Puntos.
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane fade" id="pilltab5">
                    <h4>Horarios</h4>
                    <button class="btn btn-success" data-toggle="modal" data-target="#modalAddHorario">
                        Nuevo Horarios
                    </button>
                    <div>
                        <table class="table">
                            <thead class="table-responsive">
                            <tr>
                                <th>#</th>
                                <th>Punto</th>
                                <th>Entrada</th>
                                <th>Salida</th>
                                <th>Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                                if (count($horario)>0){
                                    $i = 1;
                                    foreach ($horario as $column => $value){
                                        ?>
                            <tr>
                                <td><?= $i ?></td>
                                <td><?= $value['Ubicacion'] ?></td>
                                <td><?= $value['entrada'] ?></td>
                                <td><?= $value['salida'] ?></td>
                                <td>
                                    <button class="btn-info" onclick="EditHorario(<?= $value['idHorario'] ?>)"><i class="fa fa-edit"></i></button>
                                    <button class="btn-danger" onclick="borrarHorario(<?= $value['idHorario'] ?>)"><i class="fa fa-trash"></i></button>
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
                                                No se encontraron Puntos.
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>                
            </div>
        </div>
    </div><!--/.panel-->
</div><!-- /.col-->
<!-- Modal New User -->
<div class="modal fade" id="modalNuevoAdmin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form enctype="multipart/form-data" id="formUser" onsubmit="return validaUser()" action="./Controller/UsersController.php?page=Admin" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nuevo Usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-7">
                            <label>Empleado</label>
                            <select name="idEmpleado" class="form-control">
                                <option value="" id="">Seleccione un Empleado</option>
                                <?php
                                 if(count($emp)>0){
                                     foreach ($emp as $column => $value){
                                         ?>
                                         <option value="<?= $value['idEmpleado'] ?>"><?= $value['NombreEmpleado']." ".$value['ApellidosEmpleado'] ?></option>
                                         <?php
                                     }

                                 }else{
                                     ?>
                                     <option value="" id="">No hay Personal</option>
                                     <?php
                                 }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-5">
                            <label>Usuario</label>
                            <input name="user" type="text" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label>Contraseña</label>
                            <input name="pass" id="pass1" type="password" class="form-control" require>
                        </div><div class="col-md-4">
                            <label>Repetir Contraseña</label>
                            <input name="pass2" id="pass2" type="password" class="form-control" require>
                        </div>
                        <div class="col-md-4">
                            <label>Tipo de Usuario</label>
                            <select name="tipoUsuario" class="form-control" require>
                                <option value="0">Seleccione un tipo de usuario</option>
                                <?php
                                 if(count($tipo)>0){
                                     foreach ($tipo as $column2 => $value2){
                                         ?>
                                         <option value="<?= $value2['idTipoUsuario'] ?>"><?= $value2['tipo'] ?></option>
                                         <?php
                                     }

                                 }else{
                                     ?>
                                     <option value="" id="">No hay datos</option>
                                     <?php
                                 }
                                ?>
                            </select>
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
<!-- Modal Edit User -->
<div class="modal fade" id="modalEditAdmin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="formUserEdit" onsubmit="return validarUserEdit()" action="./Controller/UsersController.php?page=Admin" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-7">
                            <label>Empleado</label>
                            <select disabled id="idEmpleadoEdit" class="form-control">
                                <option value="" id="">Seleccione un Empleado</option>
                                <?php
                                if(count($emp)>0){
                                    foreach ($emp as $column => $value){
                                        ?>
                                        <option value="<?= $value['idEmpleado'] ?>"><?= $value['NombreEmpleado']." ".$value['ApellidosEmpleado'] ?></option>
                                        <?php
                                    }

                                }else{
                                    ?>
                                    <option value="" id="">No hay Personal</option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-5">
                            <label>Usuario</label>
                            <input id="userEdit" type="text" name="userEdit" class="form-control">
                        </div>
                        <input type="hidden" name="idUserEdit" id="idUserEdit">
                        <div class="col-md-6">
                            <label>Contraseña</label>
                            <input name="pass1Edit" id="pass1Edit" type="password" class="form-control">
                        </div><div class="col-md-6">
                            <label>Repetir Contraseña</label>
                            <input name="pass2Edit" id="pass2Edit" type="password" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" name="Update" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Asistencias -->
<div class="modal fade" id="modalUserAsist" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form enctype="multipart/form-data" id="formAsist" onsubmit="" action="./Controller/AsistenciasController.php?page=Admin" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nuevo Usuario</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label>Empleado</label>
                            <select name="idEmpleado" class="form-control" required>
                                <option value="" id="">Seleccione un Empleado</option>
                                <?php
                                if(count($emp)>0){
                                    foreach ($emp as $column => $value){
                                        ?>
                                        <option value="<?= $value['idEmpleado'] ?>"><?= $value['NombreEmpleado']." ".$value['ApellidosEmpleado'] ?></option>
                                        <?php
                                    }

                                }else{
                                    ?>
                                    <option value="" id="">No hay Personal</option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" name="NewUserAsist" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Avisos -->
<div class="modal fade" id="modalAvisos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form enctype="multipart/form-data" id="formAvisos" action="./Controller/AvisosController.php?page=Admin" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nuevo Aviso</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label>Titulo</label>
                            <input name="titulo" type="text" class="form-control" >
                        </div>
                        <div class="col-md-12">
                            <label>Aviso</label>
                            <textarea name="aviso" class="form-control" rows="10"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" name="NewAviso" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Editar Aviso -->
<div class="modal fade" id="modalEditAviso" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form enctype="multipart/form-data" action="./Controller/AvisosController.php?page=Admin" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label>Titulo</label>
                            <input name="tituloEdit" id="tituloEdit" type="text" class="form-control" >
                        </div>
                        <div class="col-md-12">
                            <label>Aviso</label>
                            <textarea name="avisoEdit" id="avisoEdit" class="form-control" rows="10"></textarea>
                        </div>
                        <input type="hidden" id="idAvisoEdit" name="idAvisoEdit">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" name="updateAviso" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Nuevo Punto -->
<div class="modal fade" id="modalNewPunto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="./Controller/UbicacionController.php?page=Admin" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nuevo Punto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label>Punto</label>
                            <input name="Punto" id="Punto" type="text" class="form-control" >
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" name="NewPunto" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Modificar Punto -->
<div class="modal fade" id="modalEditPunto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="./Controller/UbicacionController.php?page=Admin" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Punto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label>Punto</label>
                            <input name="PuntoEdit" id="PuntoEdit" type="text" class="form-control" >
                            <input name="idPuntoEdit" id="idPuntoEdit" type="hidden" class="form-control" >
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" name="EditPunto" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Modificar Horario -->
<div class="modal fade" id="modalEditHorario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <div class="col-md-12">
                            <label>Horario</label>
                            <div class="row">
                                <div class="col-md-4">
                                    <select name="idUbicacion" id="idUbicacion" class="form-control">
                                        <option value="0" id="">Seleccione una Ubicacion</option>
                                        <?php
                                        if(count($punto)>0){
                                            foreach ($punto as $column => $value){
                                                ?>
                                                <option value="<?= $value['idUbicacion'] ?>"><?= $value['Ubicacion'] ?></option>
                                                <?php
                                            }

                                        }else{
                                            ?>
                                            <option value="" id="">No hay Personal</option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <input name="entrada" id="entrada" type="time" class="form-control" >
                                </div>
                                <div class="col-md-4">
                                    <input name="salida" id="salida" type="time" class="form-control" >
                                </div>
                            </div>
                            
                            
                            
                            <input name="idHorarioEdit" id="idHorarioEdit" type="hidden" class="form-control" >
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" name="EditHorario" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Nuevo Horario -->
<div class="modal fade" id="modalAddHorario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <div class="col-md-12">
                            <label>Horario</label>
                            <div class="row">
                                <div class="col-md-4">
                                    <select name="idUbicacionNew" id="idUbicacionNew" class="form-control">
                                        <option value="0" id="">Seleccione una Ubicacion</option>
                                        <?php
                                        if(count($punto)>0){
                                            foreach ($punto as $column => $value){
                                                ?>
                                                <option value="<?= $value['idUbicacion'] ?>"><?= $value['Ubicacion'] ?></option>
                                                <?php
                                            }

                                        }else{
                                            ?>
                                            <option value="" id="">No hay Personal</option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <input name="entradaNew" id="entradaNew" type="time" class="form-control" >
                                </div>
                                <div class="col-md-4">
                                    <input name="salidaNew" id="salidaNew" type="time" class="form-control" >
                                </div>
                            </div>
                            
                            
                            
                            <input name="idHorario" id="idHorario" type="hidden" class="form-control" >
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

    function validaUser() {        
        var formulario = document.getElementById("formUser");
        var pass1      = document.getElementById("pass1").value;
        var pass2      = document.getElementById("pass2").value;

        if (pass1 != pass2){
            alert("Contraseñas diferentes");
            return false;
        }else {
            formulario.submit();
            return true;
        }
    }
    function eliminarUser(id) {
        if (confirm("¿Está seguro que desea eliminar este usuario?")){
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: './Controller/UsersController.php',
                data: {'idEvent': id,'deleteUser': true},
                success: function (data) {

                    if (data.success){
                        alert("Usuario Eliminado");
                        location.href ="/TVTEmpleados/index?page=Admin";
                    }
                    else
                        alert("Error al eliminar usuario");

                },
                error: function (error) {
                    alert("Error al eliminar usuario");
                }
            })
        }
    }
    function modificarUser(id) {
        $.ajax({
            type: 'POST',
            url: './Controller/UsersController.php',
            dataType: 'json',
            data: {'EventID': id, 'getUserByID':true},
            success:function (data) {
                if (data.length > 0){
                document.getElementById("idEmpleadoEdit").value=data[0]['idEmpleado'];
                document.getElementById("userEdit").value = data[0]['Usuario'];
                document.getElementById("pass1Edit").value = data[0]['Pass'];
                document.getElementById("pass2Edit").value = data[0]['Pass'];
                document.getElementById("idUserEdit").value = data[0]['idUsuario'];
                $("#modalEditAdmin").modal("show");
                }
            },
            error:function (error) {
            error;
            }
        })
    }
    function validarUserEdit() {
        var formulario = document.getElementById("formUserEdit");
        var pass1 = document.getElementById("pass1Edit").value;
        var pass2 = document.getElementById("pass2Edit").value;

        if (pass1 != pass2){
            alert("Contraseñas diferentes");
            return false;
        }else {
            formulario.submit();
            return true;
        }
    }
    function eliminarUserAsist(id) {
        if (confirm("¿Está seguro que desea eliminar este usuario?")){
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: './Controller/AsistenciasController.php',
                data: {'EventID': id,'deleteUserAsist': true},
                success: function (data) {
                    if (data.success){
                        alert("Usuario Eliminado");
                        location.href ="/TVTEmpleados/index?page=Admin";
                    }
                    else
                        alert("Error al eliminar usuario");

                },
                error: function (error) {
                    alert("Error al eliminar usuario");
                }
            })
        }
    }
    function editarAviso(id) {
        $.ajax({
            url: './Controller/AvisosController.php',
            type: 'POST',
            dataType:'json',
            data:{'EventID':id, 'getAviso':true },
            success:function (data) {
                if (data.length > 0){
                    document.getElementById("tituloEdit").value = data[0].tituloAvis;
                    document.getElementById("avisoEdit").value = data[0].descripcionAviso;
                    document.getElementById("idAvisoEdit").value = data[0].idAviso;
                    $("#modalEditAviso").modal("show");
                }
            },
            error:function (error) {

            }
        })
    }
    function borrarAviso(id) {
        if (confirm("¿Esta seguro que desea eliminar este aviso?")){
            $.ajax({
                url: './Controller/AvisosController.php',
                type: 'POST',
                dataType:'json',
                data:{'EventID':id, 'deleteAviso':true },
                success:function (data) {
                    alert("Aviso eliminado");
                    location.reload();
                },
                error:function (error) {

                }
            })
        }
    }
    function editarPunto(id) {
        $.ajax({
            url: './Controller/UbicacionController.php',
            type: 'POST',
            dataType:'json',
            data:{'EventID':id, 'getPunto':true },
            success:function (data) {
                if (data.length > 0){
                    document.getElementById("PuntoEdit").value = data[0].Ubicacion;
                    document.getElementById("idPuntoEdit").value = data[0].idUbicacion;
                    $("#modalEditPunto").modal("show");
                }
            },
            error:function (error) {

            }
        })
    }
    function borrarPunto(id) {
        if (confirm("¿Esta seguro que desea eliminar este Punto?")){
            $.ajax({
                url: './Controller/UbicacionController.php',
                type: 'POST',
                dataType:'json',
                data:{'EventID':id, 'deletePunto':true },
                success:function (data) {
                    alert("Punto eliminado");
                    location.reload();
                },
                error:function (error) {

                }
            })
        }
    }
    function AddUserAsist(idaah) {
        if (confirm("¿Esta seguro que desea eliminar este Punto?")){
            $.ajax({
                url: './Controller/UbicacionController.php',
                type: 'POST',
                dataType:'json',
                data:{'EventID':id, 'deletePunto':true },
                success:function (data) {
                    alert("Punto eliminado");
                    location.reload();
                },
                error:function (error) {

                }
            })
        }
    }
    function EditHorario(id) {
        $.ajax({
            url: './Controller/HorarioController.php',
            type: 'POST',
            dataType:'json',
            data:{'EventID':id, 'getHorario':true },
            success:function (data) {
                if (data.length > 0){
                    document.getElementById("idUbicacion").value = data[0].idUbicacion;
                    document.getElementById("entrada").value = data[0].entrada;
                    document.getElementById("salida").value = data[0].salida;
                    document.getElementById("idHorarioEdit").value = data[0].idHorario;
                    $("#modalEditHorario").modal("show");
                }
            },
            error:function (error) {

            }
        })
    }
    function borrarHorario(id) {
        if (confirm("¿Esta seguro que desea eliminar este Horario?")){
            $.ajax({
                url: './Controller/HorarioController.php',
                type: 'POST',
                dataType:'json',
                data:{'EventID':id, 'deleteHorario':true },
                success:function (data) {
                    alert("Punto eliminado");
                    location.reload();
                },
                error:function (error) {

                }
            })
        }
    }
</script>
