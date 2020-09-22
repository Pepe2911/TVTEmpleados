<?php
include dirname(__FILE__,2)."/Model/classConnectionMySQL.php";

class Avisos
{
    private $conn;
    private $link;

    function __construct()
    {
        $this->conn   = new ConnectionMySQL;
        $this->link   = $this->conn->CreateConnection();
    }
    function newAviso($data){
        $hoy = date("Y-m-d");
        $query="INSERT INTO avisos(fechaAviso,tituloAvis,descripcionAviso)VALUES('".$hoy."','".$data['titulo']."','".$data['aviso']."')";

        $result = mysqli_query($this->link,$query);
        if (mysqli_affected_rows($this->link)>0){
            return true;
        }
        else{
            return false;
        }
    }
    function updateAviso($data){
        $query="UPDATE avisos SET tituloAvis='".$data['tituloEdit']."',descripcionAviso = '".$data['avisoEdit']."' WHERE idAviso =  ".$data['idAvisoEdit'];
        $result = mysqli_query($this->link,$query);
        if (mysqli_affected_rows($this->link)>0){
            return true;
        }
        else{
            return false;
        }
    }
    function getAvisoById($id=null){
        $query = "SELECT * FROM avisos WHERE idAviso = ".$id;
        $result = mysqli_query($this->link,$query);
        $data = array();
        while ($data[]=mysqli_fetch_assoc($result));
        array_pop($data);
        return $data;
    }
    function deleteAviso($id=NULL){
        $query ="DELETE FROM avisos WHERE idAviso = ".$id;
        $result= mysqli_query($this->link,$query);
        if (mysqli_affected_rows($this->link)>0){
            return true;
        }
        else{
            return false;
        }
    }
    function getAviso(){
        $query = "SELECT * FROM avisos ORDER BY fechaAviso DESC";
        $result = mysqli_query($this->link,$query);
        $data = array();
        while ($data[]=mysqli_fetch_assoc($result));
        array_pop($data);
        return $data;
    }
}