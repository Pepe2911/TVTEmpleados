<?php 
include './Model/justificantes.php';
$just = new justificar();
$justificantes =$just->getJustificantes();
?>

<div class="row">
    <ol class="breadcrumb">
        <li><a href="#">
                <em class="fa fa-id-card-o"></em>
            </a></li>
        <li class="active">Justificar</li>
    </ol>
</div><!--/.row-->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Reporte Justificantes</h1>
    </div>
</div><!--/.row-->
<table class="table" id="tabla">
    <thead>
        <tr>
            <td colspan="5">
                <input id="buscar" type="text" class="form-control" placeholder="Buscar..." />
            </td>
        </tr>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nombre</th>
            <th scope="col">Fecha</th>            
            <th scope="col">Ver</th>
            <th scope="col">Estatus</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            if(count($justificantes) > 0){
                $i=1;
                foreach($justificantes as $column =>$value){?>
                <tr>
                    <th scope="row"><?= $i; ?></th>
                    <td><?= $value['NombreEmpleado']." ".$value['ApellidosEmpleado']; ?></td>
                    <td><?= $value['fecha'] ?></td>
                    <td><button class="btn btn-primary" onclick="abrirModal(<?= $value['idJustificante']?>)">Ver</button></td>
                    <td><?php if($value['estatus'] == "0"){ echo "<label style='color:orange;'>En Espera</label>"; }else if($value['estatus']=="1"){ echo "<label style='color:green;'>Aceptado</label>";}else{echo "<label style='color:red;'>Rechazado<label>";}?></td>
                </tr>
                
                <?php
                }
            }
        ?>
    </tbody>
</table>

<!-- Modal Ver -->
<div class="modal fade" id="modalVer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Justificante</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <label>Nombre:</label>
                                <input type="text" id="nombre" class="form-control" disabled>
                            </div>
                            <div class="col-md-12">
                                <label>Descripcion</label>
                                <textarea id="descrip" class="form-control" disabled></textarea>
                            </div>
                            <div class="col-md-12">
                                <a id="imagenL" href="" target="_blank"><img id="imagenE" style="max-width: 60%;" height="200px" src=""></a>
                            </div>
                            <input type="hidden" id="idJustificante" name="idJustificante">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button onclick="aceptar()" name="Empleado" class="btn btn-primary">Aceptar</button>
                        <button onclick="cancelar()" type="submit" name="Empleado" class="btn btn-danger">Rechazar</button>
                    </div>          
            </div>
        </div>
</div>
<script>
    function abrirModal(id){
        $.ajax({
            url: './Controller/JustificanteController.php',
            type: 'POST',
            dataType:'json',
            data:{'EventID':id, 'Consulta':true },
            success:function (data) {
                if (data.length > 0){
                    document.getElementById("nombre").value = data[0].NombreEmpleado+" "+data[0].ApellidosEmpleado ;
                    document.getElementById("descrip").value = data[0].descripcion;
                    document.getElementById("idJustificante").value = data[0].idJustificante;
                    $("#imagenE").attr("src","./assets/img/justificante/"+data[0].evidencia);
                    $("#imagenL").attr("href","./assets/img/justificante/"+data[0].evidencia);
                    $("#modalEditPunto").modal("show");
                }
            },
            error:function (error) {

            }
        })       
        $("#modalVer").modal("show");
    }
    function aceptar(){        
        var id= document.getElementById("idJustificante").value;
        $.ajax({
            url: './Controller/JustificanteController.php',
            type: 'POST',
            dataType:'json',
            data:{'EventID':id, 'aceptar':true },
            success:function (data) {                 
                alert("Justificante Aceptado");   
                location.reload();             
            },
            error:function (error) {
                alert("Error");  
            }
        })
    }
    function cancelar(){
        var id= document.getElementById("idJustificante").value;    
        $.ajax({
            url: './Controller/JustificanteController.php',
            type: 'POST',
            dataType:'json',
            data:{'EventID':id, 'cancelar':true },
            success:function (data) {                 
                alert("Justificante Rechazado");   
                location.reload();                               
            },
            error:function (error) {
                alert("Error");  
            }
        })
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