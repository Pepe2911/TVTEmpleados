<?php
include dirname(__FILE__,2)."/Model/classConnectionMySQL.php";

class asistencia
{
    private $conn;
    private $link;

    function __construct()
    {
        $this->conn   = new ConnectionMySQL;
        $this->link   = $this->conn->CreateConnection();
    }

    function asistencias($data,$fecha){

        foreach ($data as $column => $value){

            $comparar = "SELECT * FROM asistencia WHERE fecha = '".$fecha."' AND idEmpleado = ". $value[0];
            $res = mysqli_query($this->link, $comparar);
            if(mysqli_affected_rows($this->link)>0){
                $row = $res->fetch_row();
                if ($value[1] == ''){
                    $query = "UPDATE asistencia SET salida= '".$value[2]."' WHERE idAsistencia = ".$row[0];
                }
                else if ($value[2] == ''){
                    $query = "UPDATE asistencia SET entrada = '".$value[1]."' WHERE idAsistencia = ".$row[0];
                }
                else{
                    $query = "UPDATE asistencia SET entrada = '".$value[1]."', salida= '".$value[2]."' WHERE idAsistencia = ".$row[0];
                }
            }else{
                if ($value[1] == ''){
                    $query = "INSERT INTO asistencia(salida,fecha,idEmpleado)VALUES('".$value[2]."','".$fecha."','".$value[0]."')";
                }
                else if ($value[2] == ''){
                    $query = "INSERT INTO asistencia(entrada,fecha,idEmpleado)VALUES('".$value[1]."','".$fecha."','".$value[0]."')";
                }
                else{
                    $query = "INSERT INTO asistencia(entrada,salida,fecha,idEmpleado)VALUES('".$value[1]."','".$value[2]."','".$fecha."','".$value[0]."')";
                }
            }
            //echo $query."<br>";
            $result = mysqli_query($this->link,$query);
            if(mysqli_affected_rows($this->link)>0){
            }
        }
        //die();
        return true;
    }
    function getAsist($id=NULL){
        $query = "SELECT * FROM asistencia A INNER JOIN empleado E ON A.idEmpleado = E.idEmpleado WHERE idAsistencia = ".$id;
        $result =mysqli_query($this->link,$query);
        $data   =array();
        while ($data[]=mysqli_fetch_assoc($result));
        array_pop($data);
        return $data;
    }
    function getAsistRep($id=NULL , $fechaI, $fechaF){
        $query = "SELECT * FROM asistencia A INNER JOIN empleado E ON A.idEmpleado = E.NumeroEmpleado WHERE A.idEmpleado = ".$id." AND A.fecha >= '".$fechaI."' AND A.fecha <= '".$fechaF."'";        
        $result =mysqli_query($this->link,$query);
       // echo $query;
        $data   =array();
        while ($data[]=mysqli_fetch_assoc($result));
        array_pop($data);
        return $data;
    }

    function getHorario($id=NULL){
        $query = "SELECT * FROM horario WHERE idPunto =".$id;
        $result =mysqli_query($this->link,$query);
        $data   =array();
        while ($data[]=mysqli_fetch_assoc($result));
        array_pop($data);
        return $data;
    }
    function getHorarioByNumEmp($id=NULL){
        $query = "SELECT h.entrada, h.salida FROM horario h INNER JOIN ubicacion u on u.idUbicacion = h.idPunto INNER JOIN empleado e on u.idUbicacion = e.idUbicacion WHERE e.NumeroEmpleado = ".$id;
        $result =mysqli_query($this->link,$query);
        $data   =array();
        while ($data[]=mysqli_fetch_assoc($result));
        array_pop($data);
        return $data;
    }

    function UpdateAsist($data){
        $query = "UPDATE asistencia SET entrada ='".$data['EntradaEdit']."', salida= '".$data['SalidaEdit']."' WHERE idAsistencia = ".$data['idAsist'];
        $result = mysqli_query($this->link,$query);
        if (mysqli_affected_rows($this->link)>0){
            return true;
        }
        else{
            return false;
        }
    }
    function newUserAsist($data){
        $query = "UPDATE empleado SET asistencia = 1 WHERE idEmpleado = ".$data['idEmpleado'];
        $result = mysqli_query($this->link,$query);
        if (mysqli_affected_rows($this->link)>0){
            return true;
        }
        else{
            return false;
        }
    }
    function deleteUserAsist($id = NULL){
        $query = "UPDATE empleado SET asistencia = 0 WHERE idEmpleado = ".$id;
        $result = mysqli_query($this->link,$query);
        if (mysqli_affected_rows($this->link)>0){
            return true;
        }
        else{
            return false;
        }
    }
}