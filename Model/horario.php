<?php
include dirname(__FILE__,2)."/Model/classConnectionMySQL.php";

class Horario
{
    private $conn;
    private $link;

    function __construct()
    {
        $this->conn   = new ConnectionMySQL;
        $this->link   = $this->conn->CreateConnection();
    }
    function getHorarioById($id = NULL){
        if(!empty($id)){
        $query = "SELECT * FROM horario INNER JOIN ubicacion on horario.idPunto = ubicacion.idUbicacion WHERE idHorario = ".$id;
        $result =mysqli_query($this->link,$query);            
        $data =array();
        while ($data[]=mysqli_fetch_assoc($result));
        array_pop($data);            
        return $data;
        }else{
            return false;
        }
    }
    function UpdateHorario($data){
        $query = "UPDATE horario SET entrada = '".$data['entrada']."', salida = '".$data['salida']."', idPunto = '".$data['idUbicacion']."' WHERE idHorario = ".$data['idHorarioEdit'];
        $result = mysqli_query($this->link,$query);
        if (mysqli_affected_rows($this->link)>0){
            return true;
        }
        else{
            return false;
        }
    }
    function deleteHorario($id = null){
        $query = "DELETE FROM horario WHERE idHorario = ".$id;
        $result = mysqli_query($this->link,$query);
        if (mysqli_affected_rows($this->link)>0){
            return true;
        }
        else{
            return false;
        }
    }
    function newHorario($data){
        $query = "INSERT INTO horario ( entrada, salida, idPunto) VALUES ('".$data['entradaNew']."','".$data['salidaNew']."','".$data['idUbicacionNew']."')";
        $result = mysqli_query($this->link,$query);
        if (mysqli_affected_rows($this->link)>0){
            return true;
        }
        else{
            return false;
        }
    }

}

?>