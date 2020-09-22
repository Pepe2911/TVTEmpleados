<?php
/**
 * Created by PhpStorm.
 * User: jjzavala
 * Date: 26/06/2020
 * Time: 10:08 AM
 */
if(class_exists (ConnectionMySQL::class)){

}
else {
    class ConnectionMySQL
    {
        public function __construct()
        {
            $this->host = "localhost"; //
            $this->user = "root"; //Usuario Base de datos
            $this->password = ""; //Contraseña de usuario de base de datos
            $this->dataBase = "mydb"; //Nombre de la base de datos
        }

        public function CreateConnection()
        {
            $enlace = mysqli_connect($this->host, $this->user, $this->password, $this->dataBase);
            if ($enlace) {
                // echo "Conexion exitosa";	//si la conexion fue exitosa nos muestra este mensaje como prueba, despues lo puedes poner comentarios de nuevo: //
            } else {
                die('Error de Conexión (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
            }
            return ($enlace);
            // mysqli_close($enlace); //cierra la conexion a nuestra base de datos, un ounto de seguridad importante.
        }
    }
}