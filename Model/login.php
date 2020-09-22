<?php
include dirname(__FILE__,2)."/Model/classConnectionMySQL.php";


class login
{
    private $conn;
    private $link;

    function __construct()
    {
        $this->conn   = new ConnectionMySQL;
        $this->link   = $this->conn->CreateConnection();

    }
     public function Login($data){
        $query = "SELECT * FROM users WHERE Usuario = '".$data['user']."'";
         $result =mysqli_query($this->link,$query);
         $fila = mysqli_fetch_assoc($result);
         if ($fila && password_verify($data['pass'], $fila['Pass'])) { 
            session_start();             
             $_SESSION['usuario']= $data['user'];
             $_SESSION['idTipoUsuario'] = $fila['tipoUsuario'];
            return true;
         } else {
            return false;
         }
     }

}