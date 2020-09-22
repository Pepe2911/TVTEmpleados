<?php
include dirname(__FILE__,2)."/Model/classConnectionMySQL.php";

class checador
{
    private $conn;
    private $link;

    function __construct()
    {
        $this->conn   = new ConnectionMySQL;
        $this->link   = $this->conn->CreateConnection();

    }
    public function newRegistro($data){
        $query = "INSERT INTO registro (FechaRegistro, HoraRegistro, NumeroEmpleado) VALUES ('".$data['F']."','".$data['H']."',".$data['E'].")";

        $result = mysqli_query($this->link, $query);
        if (mysqli_affected_rows($this->link)>0){
            $query2 = "SELECT * FROM registro R INNER JOIN empleado E ON R.NumeroEmpleado = E.NumeroEmpleado WHERE R.FechaRegistro = '".$data['F']."' AND R.NumeroEmpleado = '".$data['E']."'";
            $result2 = mysqli_query($this->link,$query2);
            if (mysqli_affected_rows($this->link)>0){
                $data   = array();
                while ($data[]=mysqli_fetch_assoc($result2));
                array_pop($data);
                return $data;
            }

        }
        else{
            return false;
        }
    }
}