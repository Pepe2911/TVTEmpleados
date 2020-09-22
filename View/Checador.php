
<div align="center" style="padding-top: 20px;">
    <fieldset style="width: 50%;">
            <div class="row">
                <div class="row col-6" style="border: #0b2e13 solid" align="center">
                    <div class="col-1"></div>
                    <div class="col-10" >
                        <img src="./assets/img/users/default.jpg" style="width: 100%; height: auto;">
                    </div>
                    <div class="col-12">
                        <label>Nombre del Empleado:</label>
                        <input type="text" id="EmpleadoRegistrado" class="form-control" disabled >
                    </div>
                    <div class="col-12">
                        <label>Hora de Registro: </label>
                        <input type="text" id="HoraRegistro" class="form-control" disabled >
                    </div>
                    <div class="col-12" id="Estatus">

                    </div>
                </div>
                <div class="row col-6">
                    <div class="col-12">
                        <label>Fecha:</label>
                        <input type="date" id="Fecha2" class="form-control" style="text-align: center;" disabled>
                    </div>
                    <div class="col-12">
                        <label>Hora:</label>
                        <input type="text" id="reloj2" class="form-control" style="font-family: 'DS-Digital'; text-align: center; " disabled>
                    </div>
                    <div class="col-12">
                        <label>Numero de Empleado:</label>
                        <input type="text"onsubmit="checar()" value="" id="NumeroEmpleado" class="form-control">
                        <input type="submit" onclick="checar()"  value="Registrar" class="btn" id="boton">
                    </div>
                    <div class="col-12" style="padding-top: 5px;">
                        <button type="button" class="btn btn-secondary" onclick="agregar(1)">1</button>
                        <button type="button" class="btn btn-secondary" onclick="agregar(2)">2</button>
                        <button type="button" class="btn btn-secondary" onclick="agregar(3)">3</button>
                    </div>
                    <div class="col-12" style="padding-top: 5px;">
                        <button type="button" class="btn btn-secondary" onclick="agregar(4)">4</button>
                        <button type="button" class="btn btn-secondary" onclick="agregar(5)">5</button>
                        <button type="button" class="btn btn-secondary" onclick="agregar(6)">6</button>
                    </div>
                    <div class="col-12" style="padding-top: 5px;">
                        <button type="button" class="btn btn-secondary" onclick="agregar(7)">7</button>
                        <button type="button" class="btn btn-secondary" onclick="agregar(8)">8</button>
                        <button type="button" class="btn btn-secondary" onclick="agregar(9)">9</button>
                    </div>
                    <div class="col-12" style="padding-top: 5px;">
                        <button type="button" class="btn btn-secondary" onclick="empty()">C</button>
                        <button type="button" class="btn btn-secondary" onclick="agregar(0)">0</button>
                        <button type="button" class="btn btn-secondary" onclick="borrarUno()"> < </button>
                    </div>
                </div>
            </div>
    </fieldset>
</div>
    <script type="text/javascript">
    var  today = new Date();
    var m = today.getMonth() + 1;
    var mes = (m < 10) ? '0' + m : m;
    document.getElementById("Fecha2").value = today.getFullYear()+'-'+mes+'-'+today.getDate();

    //var FechaActual = today.getFullYear(),'-' +mes,'-'+today.getDate();
    //document.getElementById("Fecha").value = FechaActual;
    //document.getElementById("Fecha2").value = FechaActual;
</script>

<script type="text/javascript">
    if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
        window.location.assign("Index.php?page=Empleados")
    }

function startTime(){

today=new Date();

h=today.getHours();

m=today.getMinutes();

s=today.getSeconds();

m=checkTime(m);

s=checkTime(s);

//document.getElementById('reloj').innerHTML=h+":"+m+":"+s;
document.getElementById('reloj2').value = h+":"+m+":"+s;

t=setTimeout('startTime()',500);}

function checkTime(i)

{if (i<10) {i="0" + i;}return i;}

window.onload=function(){startTime();}
// Function to add event listener to t

    function agregar(nuevoNumero) {
        var t2 = document.getElementById("NumeroEmpleado").value;
        document.getElementById("NumeroEmpleado").value = t2+nuevoNumero;
    }
function borrarUno() {
    var t2 = document.getElementById("NumeroEmpleado").value;
    document.getElementById("NumeroEmpleado").value = t2.substring(0, t2.length - 1);
}
function empty() {
    var t2 = document.getElementById("NumeroEmpleado");
     t2.value =  document.getElementById("NumeroEmpleado").value = "";
}
function checar() {
    var empleado = document.getElementById("NumeroEmpleado").value;
    var fecha = document.getElementById("Fecha2").value;
    var hora = document.getElementById("reloj2").value;
    //alert("Empleado: "+empleado+" Fecha: "+fecha+" Hora: "+hora)
    $.ajax({
        type: 'POST',
        url: './Controller/ChecadorController.php',
        dataType: 'json',
        data: {'E': empleado, 'F': fecha, 'H': hora, 'New': true},
        success: function (data) {
            $("#Estatus").empty();
            if (data != false) {

                if (data.length > 1) {
                    empty();
                    document.getElementById("EmpleadoRegistrado").value = data[0].NombreEmpleado;
                    document.getElementById("HoraRegistro").value = hora;
                    $("#Estatus").append("<div class=\"alert alert-success\">\n" +
                        "                            Registro de <strong>Salida</strong> Exitoso.\n" +
                        "                        </div>");
                } else {
                    empty();
                    document.getElementById("EmpleadoRegistrado").value = data[0].NombreEmpleado;
                    document.getElementById("HoraRegistro").value = data[0].HoraRegistro;
                    $("#Estatus").append("<div class=\"alert alert-success\">\n" +
                        "                            Registro de <strong>Entrada</strong> Exitoso.\n" +
                        "                        </div>");
                }
            }
            else {
                $("#Estatus").append("<div class=\"alert alert-danger\">\n" +
                    "                            Error al registrar, intente de nuevo.\n" +
                    "                        </div>");
            }
        },
        error: function (error) {
            alert("Error");
        }
    })
}
$(document).on('keypress',function(e) {
    if(e.which === 13) {
        checar();
    }
});
</script>

