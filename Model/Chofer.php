<?php
include dirname(__FILE__,2)."/Model/classConnectionMySQL.php";

class Chofer
{
    private $conn;
    private $link;

    function __construct()
    {
        $this->conn   = new ConnectionMySQL;
        $this->link   = $this->conn->CreateConnection();

    }
    public function updateChofer($data){
        if($data['salidaEdit'] == ''){
            $data['salidaEdit'] ='0000/00/00';
        }
        if($data['caducidadParteMEdit'] == ''){
            $data['caducidadParteMEdit'] ='0000/00/00';
        }
        if($data['caducidadLEdit'] == ''){
            $data['caducidadLEdit'] ='0000/00/00';
        }
        if($data['NacimientoEdit'] == ''){
            $data['NacimientoEdit'] ='0000/00/00';
        }
        if ($_FILES['uploadedfile']['name'] == ''){
            $query = "UPDATE empleado E INNER JOIN chofer C ON E.idEmpleado = C.idEmpleado SET E.NumeroEmpleado='".$data['EmpleadoNumEdit']."', E.NombreEmpleado = '".$data['nameEdit']."', E.ApellidosEmpleado = '".$data['apellidoEdit']."', E.EstatusEmpleado = ".$data['estatusEdit'].", E.SalidaEmpleado = '".$data['salidaEdit']."', E.TelefonoEmpleado = '".$data['personalEdit']."', E.FechaNacimiento = '".$data['NacimientoEdit']."', E.TelefonoTrabajo = '".$data['empresaEdit']."', E.Direccion = '".$data['domicilioEdit']."', E.Ciudad = '".$data['ciudadEdit']."', C.NumeroLicencia = '".$data['numeroLEdit']."',  C.VencimientoLicencia = '".$data['caducidadLEdit']."', C.ParteMedico = '".$data['caducidadParteMEdit']."' ";
           //echo $query;
           //die();
        }
        else if ($_FILES['uploadedfile']['name'] != ''){
            $query = "UPDATE empleado E INNER JOIN chofer C ON E.idEmpleado = C.idEmpleado SET E.NumeroEmpleado='".$data['EmpleadoNumEdit']."', E.NombreEmpleado = '".$data['nameEdit']."', E.ApellidosEmpleado = '".$data['apellidoEdit']."', E.EstatusEmpleado = ".$data['estatusEdit'].", E.SalidaEmpleado = '".$data['salidaEdit']."', E.TelefonoEmpleado = '".$data['personalEdit']."', E.FechaNacimiento = '".$data['NacimientoEdit']."', E.TelefonoTrabajo = '".$data['empresaEdit']."', E.Direccion = '".$data['domicilioEdit']."', E.Ciudad = '".$data['ciudadEdit']."', C.NumeroLicencia = '".$data['numeroLEdit']."', C.VencimientoLicencia = '".$data['caducidadLEdit']."', C.ParteMedico = '".$data['caducidadParteMEdit']."', E.Foto = './assets/img/users/".$_FILES['uploadedfile']['name']."' ";
        }
        if($_FILES['AptoEdit']['name'] == '' && $_FILES['LicenciaEdit']['name'] == ''){

        }else if($_FILES['AptoEdit']['name'] == '' && $_FILES['LicenciaEdit']['name'] != ''){
            $query .= ", FotoLicencia = './assets/img/licencia/".$_FILES['Licencia']['name']."'";
        }else if($_FILES['AptoEdit']['name'] != '' && $_FILES['LicenciaEdit']['name'] == ''){
            $query .= ", FotoApto = './assets/img/apto/".$_FILES['AptoEdit']['name']."'";
        }else{
            $query .= ", FotoLicencia = './assets/img/licencia/".$_FILES['LicenciaEdit']['name']."', FotoApto= './assets/img/apto/".$_FILES['AptoEdit']['name']."'" ;
        }
        $query .=" WHERE E.idEmpleado =".$data['IdEmp'];
        //echo $query;
        //die();
        $result =mysqli_query($this->link,$query);
        if(mysqli_affected_rows($this->link)>0){ 
                return true;         
        }else{            
            return false;
        }
    }
    public function newUserChofer($data){
        if ($_FILES['uploadedfile']['name'] == ''){
            $query  ="INSERT INTO empleado (NombreEmpleado,ApellidosEmpleado, IngresoEmpleado, idTipoEmpleado,TelefonoEmpleado,TelefonoTrabajo,FechaNacimiento, Direccion,Ciudad,NumeroEmpleado) VALUES ('".$data['nombre']."','".$data['apellidos']."','".$data['ingreso']."',1,'".$data['telefono']."','".$data['Telefono2']."','".$data['nacimiento']."','".$data['direccion']."','".$data['ciudad']."','".$data['EmpleadoNum']."')";
        }
        else{
            $query  ="INSERT INTO empleado (NombreEmpleado,ApellidosEmpleado, IngresoEmpleado, idTipoEmpleado,TelefonoEmpleado,TelefonoTrabajo,FechaNacimiento, Direccion,Ciudad, foto,NumeroEmpleado) VALUES ('".$data['nombre']."','".$data['apellidos']."','".$data['ingreso']."',1,'".$data['telefono']."','".$data['Telefono2']."','".$data['nacimiento']."','".$data['direccion']."','".$data['ciudad']."','./assets/img/users/".$_FILES['uploadedfile']['name']."','".$data['EmpleadoNum']."')";
        }
        //echo $query;
   
        $result =mysqli_query($this->link,$query);
        if(mysqli_affected_rows($this->link)>0){
            $id =mysqli_insert_id($this->link);
            if($_FILES['Apto']['name'] == '' && $_FILES['Licencia']['name'] == ''){
                $query2 = "INSERT INTO chofer (NumeroLicencia, idEmpleado, VencimientoLicencia, ParteMedico) VALUES ('".$data['licencia']."','".$id."','".$data['caducidad']."','".$data['caducidadMedico']."')";            
            }else if($_FILES['Apto']['name'] == '' && $_FILES['Licencia']['name'] != ''){
                $query2 = "INSERT INTO chofer (NumeroLicencia, idEmpleado, VencimientoLicencia, ParteMedico, FotoLicencia) VALUES ('".$data['licencia']."','".$id."','".$data['caducidad']."','".$data['caducidadMedico']."','./assets/img/licencia/".$_FILES['Licencia']['name']."')";            
            }else if($_FILES['Apto']['name'] != '' && $_FILES['Licencia']['name'] == ''){
                $query2 = "INSERT INTO chofer (NumeroLicencia, idEmpleado, VencimientoLicencia, ParteMedico, FotoApto) VALUES ('".$data['licencia']."','".$id."','".$data['caducidad']."','".$data['caducidadMedico']."','./assets/img/apto/".$_FILES['Apto']['name']."')";            
            }else{
                $query2 = "INSERT INTO chofer (NumeroLicencia, idEmpleado, VencimientoLicencia, ParteMedico, FotoLicencia, FotoApto) VALUES ('".$data['licencia']."','".$id."','".$data['caducidad']."','".$data['caducidadMedico']."','./assets/img/licencia/".$_FILES['Licencia']['name']."','./assets/img/apto/".$_FILES['Apto']['name']."')";                         
            }
            //echo $query2;    
            //die();
            $result2 =mysqli_query($this->link,$query2);
            if(mysqli_affected_rows($this->link)>0) {
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
    public function getLicencias()
    {
        $query  ="SELECT empleado.NombreEmpleado, empleado.ApellidosEmpleado, chofer.TipoLicencia, chofer.VencimientoLicencia FROM empleado INNER JOIN chofer ON chofer.idEmpleado = empleado.idEmpleado WHERE empleado.EstatusEmpleado = 1 ORDER BY chofer.VencimientoLicencia ASC";
        $result =mysqli_query($this->link,$query);
        $data   =array();
        while ($data[]=mysqli_fetch_assoc($result));
        array_pop($data);
        return $data;
    }
    public function getChoferes()
    {
        $query  ="SELECT empleado.idEmpleado, empleado.NombreEmpleado, empleado.ApellidosEmpleado, chofer.NumeroLicencia, chofer.TipoLicencia, chofer.VencimientoLicencia FROM empleado INNER JOIN chofer on empleado.idEmpleado = chofer.idEmpleado WHERE empleado.idTipoEmpleado=1 AND empleado.EstatusEmpleado= 1";
        $result =mysqli_query($this->link,$query);
        $data   =array();
        while ($data[]=mysqli_fetch_assoc($result));
        array_pop($data);
        return $data;
    }
    public function deleteChofer($id = NULL)
    {
        $query = "UPDATE empleado SET EstatusEmpleado = 0 WHERE idEmpleado = ".$id;
        $result =mysqli_query($this->link,$query);
        if(mysqli_affected_rows($this->link)>0){
            return true;
        }else{
            return false;
        }
    }
    public function Choferes(){
        return $query  ="SELECT empleado.idEmpleado, empleado.NombreEmpleado, empleado.ApellidosEmpleado, chofer.NumeroLicencia, chofer.TipoLicencia, chofer.VencimientoLicencia FROM empleado INNER JOIN chofer on empleado.idEmpleado = chofer.idEmpleado WHERE empleado.idTipoEmpleado=1";
        $result =mysqli_query($this->link,$query);
        $data   =array();
        while ($data[]=mysqli_fetch_assoc($result));
        array_pop($data);
        return $data;
    }
}