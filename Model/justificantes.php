<?php 
include dirname(__FILE__,2)."/Model/classConnectionMySQL.php";

class justificar
{
    private $conn;
    private $link;

    function __construct()
    {
        $this->conn   = new ConnectionMySQL;
        $this->link   = $this->conn->CreateConnection();
    }
    public function getJustificantes(){
        $query = "SELECT * FROM justificante J INNER JOIN empleado E ON J.idEmpleado = E.NumeroEmpleado";
        $result =mysqli_query($this->link,$query);
        $data   =array();
        while ($data[]=mysqli_fetch_assoc($result));
        array_pop($data);
        return $data;
    }
    public function getById($id = null){
        $query = "SELECT * FROM justificante J INNER JOIN empleado E ON J.idEmpleado = E.NumeroEmpleado WHERE idJustificante = ".$id;
        $result =mysqli_query($this->link,$query);
        $data   =array();
        while ($data[]=mysqli_fetch_assoc($result));
        array_pop($data);
        return $data;
    }
    public function updateEstatus($id = null,$estatus){
        $query = "UPDATE justificante SET estatus = ".$estatus." WHERE idJustificante = ".$id;               
        if (mysqli_query($this->link,$query)){
            return true;
        }
        else{
            return false;
        }
    }

}

?>