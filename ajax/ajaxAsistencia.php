<?php
include '../Model/Empleado.php';
$empleado = new Empleado();
$empleadoAsis = $empleado->getEmpleadoAsist();
$hoy = date("Y-m-d");
if(isset($_POST['F']) && $_POST['F'] != ''){
    $fecha = $_POST['F'];
}
else{
    $fecha = $hoy;
}
?>
<div align="center">
    <h3>Asistencia del dia: <?php echo $fecha ?></h3>
</div>
<div class="form-group text-center">
    <?php
    if(isset($_GET['successAsist'])){
        ?>
        <div class="alert alert-success">
            Se han guardado las Asistencias <strong>Exitosamente</strong>
        </div>
        <?php
    }else if(isset($_GET['errorAsist'])){
        ?>
        <div class="alert alert-danger">
            Ha ocurrido un <strong>ERROR</strong> al guardar las asistencias, por favor intente de nuevo.
        </div>
        <?php
    }
    ?>
</div>
<form action="./Controller/AsistenciasController.php?page=bitacoraAsistencia&fecha=<?php echo $fecha ?>&create=true" method="post">
    <table class="table">
        <thead class="table-info">
        <tr>
            <th>Nombre del Empleado</th>
            <th>Punto</th>
            <th>Entrada</th>
            <th>Salida</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if(count($empleadoAsis)>0){
            $i=0;

            foreach ($empleadoAsis as $column =>$value) {
                $asist = $empleado->getasist($value['idEmpleado'],$fecha);
                ?>
                <tr>
                    <input type="hidden" id="idEmpleado" name="Empleado<?= $i."[]" ?>" value="<?= $value['idEmpleado'];?>">
                    <td><?= $value['NombreEmpleado'].' '.$value['ApellidosEmpleado']; ?></td>
                    <td>
                        <input type="text" value="<?= $value['Ubicacion'];?>" id="punto" disabled class="form-control">
                    </td>
                    <td><input type="time" class="form-control" name="Empleado<?= $i."[]" ?>" value="<?php if(isset($asist[0]['entrada'])){ echo $asist[0]['entrada'];} ?>"></td>
                    <td><input type="time" class="form-control" name="Empleado<?= $i."[]" ?>" value="<?php if(isset($asist[0]['salida'])) {echo $asist[0]['salida'];} ?>"></td>
                </tr>
                <?php
                $i++; }
        }
        ?>
        </tbody>
    </table>
    <button class="btn btn-success">Guardar</button>
</form>
