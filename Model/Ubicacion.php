<?php
include dirname(__FILE__,2)."/Model/classConnectionMySQL.php";

class Ubicacion
{
    private $conn;
    private $link;

    function __construct()
    {
        $this->conn   = new ConnectionMySQL;
        $this->link   = $this->conn->CreateConnection();
    }
    function NewUbicacion($data){
        $query = "INSERT INTO ubicacion(Ubicacion)VALUES('".$data['Punto']."')";
        $result = mysqli_query($this->link,$query);
        if (mysqli_affected_rows($this->link)>0){
            return true;
        }
        else{
            return false;
        }
    }
    function getUbicacionById($id = NULL){
        $query = "SELECT * FROM ubicacion WHERE idUbicacion= ".$id;
        $result = mysqli_query($this->link,$query);
        $data = array();
        while ($data[]=mysqli_fetch_assoc($result));
        array_pop($data);
        return $data;
    }
    function deletePunto($id = NULL){
        $query ="DELETE FROM ubicacion WHERE idUbicacion = ".$id;
        $result= mysqli_query($this->link,$query);
        if (mysqli_affected_rows($this->link)>0){
            return true;
        }
        else{
            return false;
        }
    }
    function updatePunto($data){
        $query="UPDATE ubicacion SET Ubicacion='".$data['PuntoEdit']."' WHERE idUbicacion =  ".$data['idPuntoEdit'];
        $result = mysqli_query($this->link,$query);
        if (mysqli_affected_rows($this->link)>0){
            return true;
        }
        else{
            return false;
        }
    }
}