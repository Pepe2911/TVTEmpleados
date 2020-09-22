<?php
$id = $_GET['id'];
include "./Model/Avisos.php";
$Avisos = new Avisos();
$aviso = $Avisos->getAvisoById($id);
?>
<div class="row">
    <ol class="breadcrumb">
        <li><a href="#">
                <em class="fa fa-home"></em>
            </a></li>
        <li class="active">Avisos</li>
    </ol>
</div><!--/.row-->

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><?php print_r($aviso[0]['tituloAvis']); ?></h1>
    </div>
</div><!--/.row-->
<div>
    <p>
        <?php print_r($aviso[0]['descripcionAviso']); ?>
    </p>
</div>