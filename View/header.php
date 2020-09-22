<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="content-language" content="es">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $title=isset($title)?$title:'TVT Personal'; ?></title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link rel="stylesheet" type="text/css" href="./assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="./assets/css/style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style type="text/css">
        body{
            /*margin-top: 20px;*/
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light nav-bar">
    <a class="navbar-brand list-items" href="index.php"><strong>Administrador TVT</strong></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse text-right" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item dropdown text-right ">
                <a class="nav-link list-items" href="./index.php?page=boleteros" id="navbarDropdown" role="button">
                    Boleteros
                </a>
            </li>
            <li class="nav-item dropdown text-right ">
                <a class="nav-link list-items" href="./index.php?page=choferes" id="navbarDropdown" role="button">
                    Choferes
                </a>
            </li>
            <li class="nav-item dropdown text-right ">
                <a class="nav-link list-items" href="./index.php?page=inspectores" id="navbarDropdown" role="button">
                    Inspectores
                </a>
            </li>
            <li class="nav-item dropdown text-right ">
                <a class="nav-link list-items" href="./index.php?page=administrativo" id="navbarDropdown" role="button">
                    Administrativos
                </a>
            </li>
            <li class="nav-item dropdown text-right ">
                <a class="nav-link list-items" href="./index.php?page=incidencias" id="navbarDropdown" role="button">
                    Incidencias
                </a>
            </li>
            <li class="nav-item dropdown text-right ">
                <a class="nav-link list-items" href="./index.php?page=bitacoraAsistencia" id="navbarDropdown" role="button">
                    Asistencias
                </a>
            </li>
            <li class="nav-item dropdown text-right ">
                <a class="nav-link list-items"  href="./login.php?logout=true" id="navbarDropdown" role="button">
                    Cerrar Sesion
                </a>
            </li>
        </ul>
    </div>
</nav>
<div class="container">
