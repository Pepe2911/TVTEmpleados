<?php
include dirname(__FILE__,2)."/Model/classConnectionMySQL.php";


class SpReporte
{
    private $conn;
    private $link;

    function __construct()
    {
        $this->conn   = new ConnectionMySQL;
        $this->link   = $this->conn->CreateConnection();
    }

    public function GetSpReporte($data){
        $query  ="CALL SpReporteObservaciones('".$data['I']."','".$data['F']."','".$data['E']."', '".$data['T']."')" ;
        $result =mysqli_query($this->link,$query);
        $data   =array();
        while ($data[]=mysqli_fetch_assoc($result));
        array_pop($data);
        return $data;
    }
    public function getSpReporteAsist($data){
        $query  ="CALL 	SpAsistEmpleados('".$data['I']."','".$data['F']."','".$data['E']."', '".$data['T']."')" ;
        $result =mysqli_query($this->link,$query);
        $data   =array();
        while ($data[]=mysqli_fetch_assoc($result));
        array_pop($data);
        return $data;
    }

}