<?php
    include './Model/Empleado.php';
    include './Model/Chofer.php';
    include './Model/Avisos.php';
    $empleado = new Empleado();
    $chofer = new Chofer();
    $Avisos= new Avisos();
    $incidencias =$empleado->getIncidencias();
    $birthday =$empleado->getBirthday();
    $licencias =$chofer->getLicencias();
    $descanso = $empleado->getDescansos();
    $totalBol = count($empleado->getBoletero());
    $totalChofer = count($chofer->getChoferes());
    $totalInsp = count($empleado->getInspectores());
    $totalAdmin = count($empleado->getAdministrativos());
    $News = $Avisos->getAviso();
?>
<style>

</style>
<div class="row">
    <ol class="breadcrumb">
        <li><a href="#">
                <em class="fa fa-home"></em>
            </a></li>
        <li class="active">Inicio</li>
    </ol>
</div><!--/.row-->

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Dashboard</h1>
    </div>
</div><!--/.row-->

<div class="panel panel-container">
    <div class="row">
        <div class="col-xs-6 col-md-3 col-lg-3 no-padding">
            <div class="panel panel-teal panel-widget border-right">
                <div class="row no-padding"><em class="fa fa-xl fa fa-id-card-o color-blue"></em>
                    <div class="large"><?php echo $totalChofer ?></div>
                    <div class="text-muted">Operadores</div>
                </div>
            </div>
        </div>
        <div class="col-xs-6 col-md-3 col-lg-3 no-padding">
            <div class="panel panel-blue panel-widget border-right">
                <div class="row no-padding"><em class="fa fa-xl fa-ticket color-orange"></em>
                    <div class="large"><?php echo $totalBol ?> </div>
                    <div class="text-muted">Boleteros</div>
                </div>
            </div>
        </div>
        <div class="col-xs-6 col-md-3 col-lg-3 no-padding">
            <div class="panel panel-orange panel-widget border-right">
                <div class="row no-padding"><em class="fa fa-xl fa-search color-teal"></em>
                    <div class="large"><?php echo $totalInsp ?></div>
                    <div class="text-muted">Inspectores</div>
                </div>
            </div>
        </div>
        <div class="col-xs-6 col-md-3 col-lg-3 no-padding">
            <div class="panel panel-red panel-widget ">
                <div class="row no-padding"><em class="fa fa-xl fa-user-circle-o color-red"></em>
                    <div class="large"><?php echo $totalAdmin ?></div>
                    <div class="text-muted">Administrativo</div>
                </div>
            </div>
        </div>

    </div><!--/.row-->
</div>
    <!-- AVISOS -->
<div class="row">
    <div class="col-md-6 ex3">
        <div class="panel panel-default articles chat">
            <div class="panel-heading">
                Avisos
                <span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span></div>
            <div class="panel-body articles-container ">
                <?php
                if (count($News)>0){
                    foreach ($News as $column => $value){
                        $objFecha = new DateTime($value['fechaAviso'], new DateTimeZone('America/Mexico_City'));
                        $mes= $objFecha->format('M');
                        $dia= $objFecha->format('d');
                        $string= substr($value['descripcionAviso'], 0, 250)
                        ?>
                <div class="article border-bottom">
                    <div class="col-xs-12">
                        <div class="row">
                            <div class="col-xs-2 col-md-2 date">
                                <div class="large"><?= $dia ?></div>
                                <div class="text-muted"><?= $mes ?></div>
                            </div>
                            <div class="col-xs-10 col-md-10">
                                <h4><a href="./index.php?page=Avisos&id=<?= $value['idAviso'] ?>"><?= $value['tituloAvis'] ?></a></h4>
                                <p><?= $string ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div><!--End .article-->
                <?php
                }
                }
                ?>
            </div>
        </div><!--End .articles-->
    </div>
    <div class="col-md-6 ex3">
        <div class="panel panel-default">
            <div class="panel-heading">
                Calendar
                <span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span></div>
            <div class="panel-body">
                <div id="calendar"></div>
            </div>
        </div>
    </div>
    <div class="col-md-6 ex3">
        <div class="panel panel-default chat">
            <div class="panel-heading">
                Descansos de hoy
                <span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span>
            </div>
            <div class="panel-body">
                <div id="table">
                    <table class="table">
                        <thead class="table-info">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>


                        </tr>
                        </thead>
                        <tbody>
                        <?php

                        if(count($descanso)>0){
                            $i=1;

                            foreach ($descanso as $column =>$value) {
                                ?>
                                <tr>
                                    <th scope="row"><?= $i; ?></th>
                                    <td><?= $value['NombreEmpleado']." ".$value['ApellidosEmpleado']; ?></td>

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
        </div>
    </div>
    <div class="col-md-6 ex3">
        <div class="panel panel-default chat">
            <div class="panel-heading">
                Incidencias
                <span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span>
            </div>
            <div class="panel-body">
                <table class="table">
                    <thead class="table-info">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Insidencia</th>
                        <th scope="col">Fecha</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php

                    if(count($incidencias)>0){
                        $i=1;

                        foreach ($incidencias as $column =>$value) {
                            ?>
                            <tr>
                                <th scope="row"><?= $i; ?></th>
                                <td><?= $value['NombreEmpleado']." ".$value['ApellidosEmpleado']; ?></td>
                                <td><?= $value['Titulo']; ?></td>
                                <td><?= $value['FechaInsidencia']; ?></td>
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
    </div>
    <div class="col-md-6 ex3">
        <div class="panel panel-default chat">
            <div class="panel-heading">
                Operadores
                <span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span>
            </div>
            <div class="panel-body">
                <div id="table">
                    <table class="table">
                        <thead class="table-info">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Tipo de licencia</th>
                            <th scope="col">Vencimiento Licencia</th>
                            <th scope="col">Vencimiento Parte Medico</th>
                        </tr>
                        </thead>
                        <tbody id="table">
                        <?php

                        if(count($licencias)>0){
                            $i=1;

                            foreach ($licencias as $column =>$value) {
                                ?>
                                <tr>
                                    <th scope="row"><?= $i; ?></th>
                                    <td><?= $value['NombreEmpleado']." ".$value['ApellidosEmpleado']; ?></td>
                                    <td><?= $value['TipoLicencia']; ?></td>
                                    <td><?= $value['VencimientoLicencia']; ?></td>
                                    <td><?= $value['VencimientoLicencia']; ?></td>
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

        </div>
    </div>
    <div class="col-md-6 ex3">
        <div class="panel panel-default chat">
            <div class="panel-heading">
                Cumpleaños
                <span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span>
            </div>
            <div class="panel-body">
                <div id="table" >
                    <table class="table">
                        <thead class="table-info">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Cumpleaños</th>

                        </tr>
                        </thead>
                        <tbody>
                        <?php

                        if(count($birthday)>0){
                            $i=1;

                            foreach ($birthday as $column =>$value) {
                                ?>
                                <tr>
                                    <th scope="row"><?= $i; ?></th>
                                    <td><?= $value['NombreEmpleado']." ".$value['ApellidosEmpleado']; ?></td>
                                    <td><?= $value['FechaNacimiento']; ?></td>
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
        </div>
    </div>

</div>
