<?php
session_start();

if(!isset($_SESSION['usuario']))
{
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>TVT - Empleados</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<!--Custom Font-->
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->

</head>
<body>
	<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">

		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse"><span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span></button>
				<a class="navbar-brand" href="#"><span>TVT</span>Empleados</a>
			</div>
		</div><!-- /.container-fluid -->
	</nav>
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<div class="profile-sidebar">
			<div class="profile-userpic">
				<img src="assets/img/logo.png" class="img-responsive" alt="">
			</div>
			<div class="profile-usertitle">
				<div class="profile-usertitle-name"><?= $_SESSION['usuario'] ?></div>
				<div class="profile-usertitle-status"><span class="indicator label-success"></span>Online</div>
			</div>
			<div class="clear"></div>
		</div>
		<ul class="nav menu">
			<li id="Index"><a href="index.php"><em class="fa fa-home">&nbsp;</em> Inicio</a></li>
			<li id="Boletero"><a href="./index.php?page=boleteros"><em class="fa fa-ticket">&nbsp;</em> Boleteros</a></li>
			<li id="Chofer"> <a href="./index.php?page=choferes"><em class="fa fa-id-card-o">&nbsp;</em> Operadores</a></li>
			<li id="Inspector"><a href="./index.php?page=inspectores"><em class="fa fa-search">&nbsp;</em> Inspectores</a></li>
			<li id="Admin"><a href="./index.php?page=administrativo"><em class="fa fa-user-circle-o">&nbsp;</em> Administrativo</a></li>
			<li id="Insidencia"><a href="./index.php?page=incidencias"><em class="fa fa-window-close-o">&nbsp;</em> Insidencias</a></li>
			<?php
			
                if ($_SESSION['idTipoUsuario'] == 1 || $_SESSION['idTipoUsuario'] == 2){

            ?>
			<li class="parent "><a data-toggle="collapse" href="#sub-item-1">
                    <em class="fa fa-calendar-check-o ">&nbsp;</em> Asistencias <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="fa fa-plus"></em></span>
                </a>
                <ul class="children collapse" id="sub-item-1">
                     <li><a class="" href="./index.php?page=justificar">
                            <span class="fa fa-arrow-right">&nbsp;</span> Justificar
                        </a></li> 
                    <li><a class="" href="./index.php?page=ModificarAsist">
                            <span class="fa fa-arrow-right">&nbsp;</span> Justificantes
                        </a></li> 
					<li><a class="" href="./index.php?page=justificarAsist">
                            <span class="fa fa-arrow-right">&nbsp;</span> Justificar Asistencia
                        </a></li>
                    <li><a class="" href="./index.php?page=reporteAsist">
                            <span class="fa fa-arrow-right">&nbsp;</span> Reportes
                        </a></li>
                </ul>
			</li>
			<li class="parent "><a data-toggle="collapse" href="#sub-item-2">
                    <em class="fa fa-calendar-plus-o ">&nbsp;</em> Vacaciones <span data-toggle="collapse" href="#sub-item-2" class="icon pull-right"><em class="fa fa-plus"></em></span>
                </a>
                <ul class="children collapse" id="sub-item-2">
                    <li><a class="" href="./index.php?page=vacaciones">
                            <span class="fa fa-arrow-right">&nbsp;</span> Solicitar
                        </a></li>
                    <li><a class="" href="./index.php?page=vacacionesReporte">
                            <span class="fa fa-arrow-right">&nbsp;</span> Reporte de Vacaciones
						</a></li>					                   
                </ul>
			</li> 
			<?php if($_SESSION['idTipoUsuario'] == 1){?>
				<li id="Insidencia"><a href="./index.php?page=revicionSolicitudes"><em class="fa fa-calendar-times-o">&nbsp;</em>Solicitudes</a></li>
				
						           
            <li><a href="./index.php?page=Admin"><em class="fa fa-cogs">&nbsp;</em>Admin</a></li>
            <?php
			} 
                }
            ?>
			<li><a href="./login.php?logout=true"><em class="fa fa-power-off">&nbsp;</em> Cerrar Sesion</a></li>
		</ul>
	</div><!--/.sidebar-->
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <?php
            define('HOMEDIR',__DIR__);
            $page   =isset($_GET['page'])?$_GET['page']:'Empleados';
            $folder =isset($_GET['folder'])?$_GET['folder']:'Empleados';
            if(isset($_POST['btnSearch'])){
                $search     =true;
                $dataSearch =$_POST['dataSearch'];
			}
			
			
            include 'View/'.$page.'.php';
            include 'View/footer.php';
        ?>
    </div>
    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/moments.js"></script>
    <script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/custom.js"></script>
</body>
</html>

