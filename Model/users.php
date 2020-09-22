<?php
include dirname(__FILE__,2)."/Model/classConnectionMySQL.php";

class users
{
    private $conn;
    private $link;

    function __construct()
    {
        $this->conn   = new ConnectionMySQL;
        $this->link   = $this->conn->CreateConnection();
    }
    function getUserByID($id = NULL){
        $query = "SELECT * FROM users WHERE idUsuario = ".$id;
        $result = mysqli_query($this->link,$query);
        $data = array();
        while($data[]=mysqli_fetch_assoc($result));
        array_pop($data);
        return $data;

    }
    function newUser($data){
        $query = sprintf("INSERT INTO users(Usuario, Pass, idEmpleado, tipoUsuario)VALUES('".$data['user']."','%s','".$data['idEmpleado']."','".$data['tipoUsuario']."');", password_hash($data['pass'], PASSWORD_DEFAULT));
        $result = mysqli_query($this->link, $query);
        if (mysqli_affected_rows($this->link)>0){
            return true;
        }
        else{
            return false;
        }
    }
    function deleteUser($id = NULL){
        $query = "DELETE FROM users WHERE idUsuario = ".$id;
        $result = mysqli_query($this->link, $query);
        if (mysqli_affected_rows($this->link)>0){
            return true;
        }
        else{
            return false;
        }
    }
    function updateUser($data){
        $query = sprintf("UPDATE users SET Usuario = '".$data['userEdit']."', Pass = '%s' WHERE idUsuario = ".$data['idUserEdit'].";" ,password_hash($data['pass1Edit'], PASSWORD_DEFAULT));

        $result = mysqli_query($this->link, $query);
        if (mysqli_affected_rows($this->link)>0){
            return true;
        }
        else{
            return false;
        }
    }
    function justificar($data){
        $evidencia = 0;
        if ($_FILES['evidencia']['name'] != ''){
            $evidencia = $_FILES['evidencia']['name'];
        }
        $query = "INSERT INTO justificante(evidencia, descripcion, idEmpleado, estatus, fecha)VALUES('".$evidencia."','".$data['descripcion']."','".$data['idEmp']."', '0', '".$data['fecha']."')";
        echo $query;

        $result = mysqli_query($this->link, $query);
        if (mysqli_affected_rows($this->link)>0){
            return true;
        }
        else{
            return false;
        }
    }

}