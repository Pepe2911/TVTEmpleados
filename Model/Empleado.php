<?php
include dirname(__FILE__,2)."/Model/classConnectionMySQL.php";

class Empleado
{
    private $conn;
    private $link;

    function __construct()
    {
        $this->conn   = new ConnectionMySQL;
        $this->link   = $this->conn->CreateConnection();
    }
    public function getEmpleadoAsist()
    {
        $query  ="SELECT empleado.idEmpleado, empleado.NombreEmpleado, empleado.ApellidosEmpleado, empleado.IngresoEmpleado,empleado.NumeroEmpleado, ubicacion.Ubicacion FROM empleado INNER JOIN ubicacion ON ubicacion.idUbicacion = empleado.idUbicacion WHERE empleado.EstatusEmpleado=1 AND empleado.asistencia = 1 ORDER BY empleado.ApellidosEmpleado DESC";
        $result =mysqli_query($this->link,$query);
        $data   =array();
        while ($data[]=mysqli_fetch_assoc($result));
        array_pop($data);
        return $data;
    }
    public function getEmpleadoAsistById($id = null, $inicio)
    {
        $query  ="SELECT asistencia.idAsistencia, empleado.idUbicacion, empleado.NombreEmpleado, empleado.ApellidosEmpleado, empleado.NumeroEmpleado, asistencia.fecha, asistencia.entrada, asistencia.salida FROM empleado INNER JOIN asistencia ON empleado.NumeroEmpleado = asistencia.idEmpleado WHERE asistencia.fecha = '".$inicio."' AND asistencia.idEmpleado = '".$id."' ORDER BY asistencia.fecha DESC";
        $result =mysqli_query($this->link,$query);
        //echo $query."<br>";
        $data   =array();
        while ($data[]=mysqli_fetch_assoc($result));
        array_pop($data);
        return $data;
    }
    public function getEmpleadoNoAsist()
    {
        $query  ="SELECT idEmpleado, NombreEmpleado, ApellidosEmpleado FROM empleado WHERE EstatusEmpleado=1";
        $result =mysqli_query($this->link,$query);
        $data   =array();
        while ($data[]=mysqli_fetch_assoc($result));
        array_pop($data);
        return $data;
    }
    public function getEmpleadoAdmin()
    {
        $query = "SELECT * FROM users U INNER JOIN empleado E ON U.idEmpleado = E.idEmpleado";
        $result =mysqli_query($this->link,$query);
        $data   =array();
        while ($data[]=mysqli_fetch_assoc($result));
        array_pop($data);
        return $data;
    }
    public function getNews()
    {
        $query = "SELECT * FROM avisos";
        $result =mysqli_query($this->link,$query);
        $data   =array();
        while ($data[]=mysqli_fetch_assoc($result));
        array_pop($data);
        return $data;
    }
    public function getasist($id = NULL, $fecha)
    {
        $query  ="SELECT * FROM asistencia WHERE idEmpleado = ".$id." AND fecha = '".$fecha."'";
        $result =mysqli_query($this->link,$query);
        $data   =array();
        while ($data[]=mysqli_fetch_assoc($result));
        array_pop($data);
        return $data;
    }
    public function getAllEmpleados()
    {
        $query  ="SELECT * FROM empleado WHERE EstatusEmpleado = 1";
        $result =mysqli_query($this->link,$query);
        $data   =array();
        while ($data[]=mysqli_fetch_assoc($result));
        array_pop($data);
        return $data;
    }
    //Obtiene el usuario por id
    public function getUserById($id=NULL){
        if(!empty($id)){
            $query  ="SELECT * FROM empleado INNER JOIN chofer ON empleado.idEmpleado = chofer.IdEmpleado WHERE empleado.idEmpleado=".$id  ;
            $result =mysqli_query($this->link,$query);
            $data   =array();
            while ($data[]=mysqli_fetch_assoc($result));
            array_pop($data);
            return $data;
        }else{
            return false;
        }
    }
    public function getEmpleadoById($id=NULL){
        if(!empty($id)){
            $query  ="SELECT * FROM empleado E INNER JOIN ubicacion U ON E.idUbicacion = U.idUbicacion WHERE E.idEmpleado=".$id ;
            $result =mysqli_query($this->link,$query);
            $data   =array();
            while ($data[]=mysqli_fetch_assoc($result));
            array_pop($data);
            return $data;
        }else{
            return false;
        }
    }
    public function getIncidencias()
    {
        $query  ="SELECT empleado.NombreEmpleado, empleado.EstatusEmpleado, empleado.ApellidosEmpleado, observaciones.Titulo, observaciones.FechaInsidencia FROM observaciones INNER JOIN empleado ON observaciones.idEmpleado = empleado.idEmpleado WHERE empleado.EstatusEmpleado=1 ORDER BY FechaInsidencia  DESC LIMIT 10";
        $result =mysqli_query($this->link,$query);
        $data   =array();
        while ($data[]=mysqli_fetch_assoc($result));
        array_pop($data);
        return $data;
    }
    public function getTipos()
    {
        $query  ="SELECT * FROM tipoempleado";
        $result =mysqli_query($this->link,$query);
        $data   =array();
        while ($data[]=mysqli_fetch_assoc($result));
        array_pop($data);
        return $data;
    }
    public function newEmpleado($data){
        if($_FILES['uploadedfile']['name'] == ''){
            $query  ="INSERT INTO empleado (NombreEmpleado,ApellidosEmpleado, IngresoEmpleado, idTipoEmpleado,TelefonoEmpleado,TelefonoTrabajo,FechaNacimiento, Direccion,Ciudad, idUbicacion,NumeroEmpleado,diaDescanso,diasVacaciones) VALUES ('".$data['nombre']."','".$data['apellidos']."','".$data['ingreso']."','".$data['id']."','".$data['telefono']."','".$data['telefono2']."','".$data['nacimiento']."','".$data['direccion']."','".$data['ciudad']."','".$data['ubicacion']."','".$data['EmpleadoNumero']."','".$data['diaDescanso']."',1)";
        }
        else{
            $query  ="INSERT INTO empleado (NombreEmpleado,ApellidosEmpleado, IngresoEmpleado, idTipoEmpleado,TelefonoEmpleado,TelefonoTrabajo,FechaNacimiento, Direccion,Ciudad,Foto, idUbicacion,NumeroEmpleado,diaDescanso, diasVacaciones) VALUES ('".$data['nombre']."','".$data['apellidos']."','".$data['ingreso']."','".$data['id']."','".$data['telefono']."','".$data['telefono2']."','".$data['nacimiento']."','".$data['direccion']."','".$data['ciudad']."','./assets/img/users/".$_FILES['uploadedfile']['name']."','".$data['ubicacion']."','".$data['EmpleadoNumero']."','".$data['diaDescanso']."',1)";
        }
        echo $query;
        $result =mysqli_query($this->link,$query);
        if(mysqli_affected_rows($this->link)>0){
                return true;
        }else{
            return false;
        }
    }
    public function getBirthday()
    {
        $query  ="SELECT empleado.NombreEmpleado, empleado.ApellidosEmpleado, empleado.FechaNacimiento, tipoempleado.Tipo FROM empleado INNER JOIN tipoempleado on tipoempleado.idTipoEmpleado = empleado.idTipoEmpleado WHERE empleado.EstatusEmpleado= 1 AND DATE_ADD(empleado.FechaNacimiento, INTERVAL YEAR(CURDATE())-YEAR(empleado.FechaNacimiento) + IF(DAYOFYEAR(CURDATE()) >= DAYOFYEAR(empleado.FechaNacimiento),1,0) YEAR) BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 31 DAY)";
        $result =mysqli_query($this->link,$query);
        $data   =array();
        while ($data[]=mysqli_fetch_assoc($result));
        array_pop($data);
        return $data;
    }
    public function getBoletero()
    {
        $query  ="SELECT idEmpleado, NombreEmpleado,IngresoEmpleado, ApellidosEmpleado, Foto  FROM empleado  WHERE idTipoEmpleado=2 AND EstatusEmpleado = 1";
        $result =mysqli_query($this->link,$query);
        $data   =array();
        while ($data[]=mysqli_fetch_assoc($result));
        array_pop($data);
        return $data;
    }
    public function getInspectores()
    {
        $query  ="SELECT idEmpleado, NombreEmpleado,IngresoEmpleado, ApellidosEmpleado, Foto  FROM empleado  WHERE idTipoEmpleado=3 AND EstatusEmpleado = 1";
        $result =mysqli_query($this->link,$query);
        $data   =array();
        while ($data[]=mysqli_fetch_assoc($result));
        array_pop($data);
        return $data;
    }
    public function getAdministrativos()
    {
        $query  ="SELECT idEmpleado, NombreEmpleado,IngresoEmpleado, ApellidosEmpleado, Foto  FROM empleado  WHERE idTipoEmpleado = 4 AND EstatusEmpleado = 1";
        $result =mysqli_query($this->link,$query);
        $data   =array();
        while ($data[]=mysqli_fetch_assoc($result));
        array_pop($data);
        return $data;
    }
    public function createObservacion($data){
        $query = "INSERT INTO observaciones (Observacion, idEmpleado,Titulo,FechaInsidencia) VALUES ('".$data['Descripcion']."','".$data['idEmpO']."','".$data['observ']."','".$data['fechaObserv']."')";
        $result =mysqli_query($this->link,$query);
        if(mysqli_affected_rows($this->link)>0){
            $id =mysqli_insert_id($this->link);
                //Get the temp file path
                $tmpFilePath = $_FILES['uploadedfile']['tmp_name'];
                //Make sure we have a file path
                if ($tmpFilePath != ""){
                    //Setup our new file path
                    $newFilePath = "./assets/img/Evidencia/" . $_FILES['uploadedfile']['name'];
                    $query2 = "INSERT INTO evidencia (evidencia, idObservacion, NombreEvidencia) VALUES ('".$newFilePath."',".$id.",'".$_FILES['uploadedfile']['name']."')";

                $result2 =mysqli_multi_query($this->link, $query2);
                if(mysqli_affected_rows($this->link)>0) {
                    return true;
                }else{
                    return false;
                }
            }
            else{
                return true;
            }
        }else{

            return false;
        }
    }
    public function getObservacionById($id = NULL){
        if(!empty($id)){
        $query = "SELECT * FROM observaciones WHERE idEmpleado = ".$id;
        $result =mysqli_query($this->link,$query);
        $data   =array();
        while ($data[]=mysqli_fetch_assoc($result));
        array_pop($data);
        return $data;
    }else{
return false;
}
    }
    public function getObsById($id = NULL){
        if(!empty($id)){
            $query = "SELECT * FROM observaciones WHERE idObservaciones = ".$id;
            $result =mysqli_query($this->link,$query);
            $data   =array();
            while ($data[]=mysqli_fetch_assoc($result));
            array_pop($data);
            return $data;
        }else{
            return false;
        }
    }
    public function updateChofer($data){
        $query = "UPDATE observaciones SET Observacion = '".$data['DescripcionInfoEdit']."', Titulo = '".$data['tituloObsEdit']."', FechaInsidencia = '".$data['fechaObsEdit']."' WHERE idObservaciones = ".$data['ObsEdit'];
        $result =mysqli_query($this->link,$query);
        if(mysqli_affected_rows($this->link)>0){
            return true;
        }else{
            return false;
        }
    }
    public function updateEmpleado($data){
        if($data['nacimientoE'] == ''){
            $data['nacimientoE'] ='0000/00/00';
        }
        if ($_FILES['uploadedfile']['name'] == ''){
            $query = "UPDATE empleado SET NumeroEmpleado='".$data['EmpleadoNumEdit']."', NombreEmpleado = '".$data['nombreE']."', ApellidosEmpleado = '".$data['apellidosE']."', TelefonoEmpleado = '".$data['telefonoE']."', FechaNacimiento = '".$data['nacimientoE']."', TelefonoTrabajo = '".$data['telefono2E']."', Direccion = '".$data['direccionE']."', Ciudad = '".$data['ciudadE']."', IngresoEmpleado = '".$data['ingresoE']."', idUbicacion = '".$data['ubicacionEdit']."', diaDescanso = '".$data['diaDescansoEdit']."' WHERE idEmpleado = ".$data['idEdit'];
            //echo $query;
            //die();
        }
        else if ($_FILES['uploadedfile']['name'] != ''){
            $query = "UPDATE empleado SET NumeroEmpleado='".$data['EmpleadoNumEdit']."', NombreEmpleado = '".$data['nombreE']."', ApellidosEmpleado = '".$data['apellidosE']."', TelefonoEmpleado = '".$data['telefonoE']."', FechaNacimiento = '".$data['nacimientoE']."', TelefonoTrabajo = '".$data['telefono2E']."', Direccion = '".$data['direccionE']."', Ciudad = '".$data['ciudadE']."', Foto = './assets/img/users/".$_FILES['uploadedfile']['name']."', IngresoEmpleado = '".$data['ingresoE']."', idUbicacion = '".$data['ubicacionEdit']."', diaDescanso = '".$data['diaDescansoEdit']."' WHERE idEmpleado = ".$data['idEdit'];
            //echo $query;
            // die();
        }
        
        $result =mysqli_query($this->link,$query);
        if(mysqli_affected_rows($this->link)>0){
            return true;
        }else{
            return false;
        }
    }
    public function deleteEvidencia($id = NULL){
        $evidencia = "SELECT * FROM evidencia WHERE idEvidencia = ".$id;
        $res = mysqli_query($this->link, $evidencia);
        if (mysqli_affected_rows($this->link)>0){
            while ($data=mysqli_fetch_assoc($res)){
                unlink(".".$data['evidencia']);
            }
        }
        $query = "DELETE FROM evidencia WHERE idEvidencia = ".$id;
        $result =mysqli_query($this->link,$query);
        if(mysqli_affected_rows($this->link)>0){
            return true;
        }else{
            return false;
        }
    }
    public  function deleteObs($id = NULL){
        $queryImg = "SELECT * FROM evidencia WHERE idObservacion =".$id;
        $resultImg = mysqli_query($this->link,$queryImg);
        $query = "DELETE FROM observaciones WHERE idObservaciones = ".$id;
        $result =mysqli_query($this->link,$query);
        if(mysqli_affected_rows($this->link)>0){
            while ($data=mysqli_fetch_assoc($resultImg)){
                unlink(".".$data['evidencia']);
            }
            return true;
        }else{
            return false;
        }
    }
    public function getEvidencia($id=NULL){
        if(!empty($id)){
            $query  ="SELECT * FROM evidencia WHERE idObservacion=".$id  ;
            $result =mysqli_query($this->link,$query);
            $data   =array();
            while ($data[]=mysqli_fetch_assoc($result));
            array_pop($data);
            return $data;
        }else{
            return false;
        }
    }
    public function getUbicaciones(){
        $query = "SELECT * FROM ubicacion WHERE idUbicacion != 1";
        $result = mysqli_query($this->link,$query);
        $data   =array();
        while ($data[]=mysqli_fetch_assoc($result));
        array_pop($data);
        return $data;
    }
    public function deleteUser($id = NULL){
        $query = "UPDATE empleado SET EstatusEmpleado = 0 WHERE idEmpleado = ".$id;
        $result =mysqli_query($this->link,$query);
        if(mysqli_affected_rows($this->link)>0){
            return true;
        }else{
            return false;
        }
    }
    public function AddEvidencia($data){
        $query = "INSERT INTO evidencia(evidencia,idObservacion,NombreEvidencia) VALUES ('./assets/img/Evidencia/".$_FILES['uploadedfile']['name']."','".$data['id_obs']."','".$_FILES['uploadedfile']['name']."')";
        $result = mysqli_query($this->link,$query);
        if(mysqli_affected_rows($this->link)>0){
            return true;
        }else{
            return false;
        }
    }
    public function getDescansos(){
        $dia = date("w");
        $query = "SELECT * FROM empleado  WHERE diaDescanso = ".$dia;
        $result =mysqli_query($this->link,$query);
        $data   =array();
        while ($data[]=mysqli_fetch_assoc($result));
        array_pop($data);
        return $data;
    }
    public function getTipoUser(){
        
            $query  ="SELECT * FROM tipousuario";
            $result =mysqli_query($this->link,$query);            
            $data =array();
            while ($data[]=mysqli_fetch_assoc($result));
            array_pop($data);            
            return $data;        
    }
    public function getHorario(){
        
        $query  ="SELECT * FROM horario INNER JOIN ubicacion on horario.idPunto = ubicacion.idUbicacion";
        $result =mysqli_query($this->link,$query);            
        $data =array();
        while ($data[]=mysqli_fetch_assoc($result));
        array_pop($data);            
        return $data;        
}
}