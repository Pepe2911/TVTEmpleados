<?php
session_start();
if (isset($_GET['logout'])){
    session_destroy();
    header('location: /tvtempleados/login.php');
    exit();
}
if (isset($_SESSION['usuario'])){
    header('location: /tvtempleados/index.php');
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login TVTEmpleados</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<div class="row">
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default">
               <img src="assets/img/LogoTVT.JPG" width="100%">
            </div>
			<div class="login-panel panel panel-default">
				<div class="panel-heading">Iniciar Sesion</div>
				<div class="panel-body">
					<form role="form" action="./Controller/loginController.php" method="post">
						<fieldset>
							<div class="form-group">
								<input class="form-control" placeholder="Usuario" name="user" type="text" autofocus="">
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Password" name="pass" type="password" value="">
							</div>

							<input type="submit" class="btn btn-primary" value="Iniciar Sesion"></fieldset>
					</form>
				</div>
			</div>
		</div><!-- /.col-->
	</div><!-- /.row -->	
	

<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>
