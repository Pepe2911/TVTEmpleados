<?php 
include dirname(__FILE__,2)."/Model/classConnectionMySQL.php";

	class vacaciones
	{		
		private $conn;
	    private $link;

	    function __construct()
	    {
	        $this->conn   = new ConnectionMySQL;
	        $this->link   = $this->conn->CreateConnection();
	    }
	    function getSolicitudes($tipo = null){
	    	$query = "SELECT * FROM vacaciones INNER JOIN empleado ON empleado.idEmpleado = vacaciones.idEmpleado WHERE vacaciones.estatus = ".$tipo;
	    	$result = mysqli_query($this->link,$query);
	        $data = array();
	        while ($data[]=mysqli_fetch_assoc($result));
	        array_pop($data);
	        return $data;
		}
		function getSolicitudesById($id = null){
			$query = "SELECT * FROM vacaciones RIGHT JOIN empleado ON empleado.idEmpleado = vacaciones.idEmpleado WHERE empleado.idEmpleado = ".$id;
			//echo $query;
			$result = mysqli_query($this->link,$query);
			
	        $data = array();
	        while ($data[]=mysqli_fetch_assoc($result));
	        array_pop($data);
	        return $data;
		}
		function getSolicitudesBy($id = null, $idV = NULL){
		$query = "SELECT * FROM vacaciones RIGHT JOIN empleado ON empleado.idEmpleado = vacaciones.idEmpleado WHERE empleado.idEmpleado = ".$id." AND vacaciones.idVacaciones = ".$idV;
			//echo $query;
			$result = mysqli_query($this->link,$query);
			
	        $data = array();
	        while ($data[]=mysqli_fetch_assoc($result));
	        array_pop($data);
	        return $data;
		}
		function diasTomados($id = null){
	    	$query = "SELECT SUM(TIMESTAMPDIFF(DAY, inicio, fin)+1) AS Dias_transcurridos FROM vacaciones WHERE estatus = 1 AND idEmpleado = ".$id." GROUP BY idEmpleado";
			//echo $query;
			$result = mysqli_query($this->link,$query);
	        $data = array();
	        while ($data[]=mysqli_fetch_assoc($result));
	        array_pop($data);
	        return $data;
	    }
		function newSolicitud($data){		
		    	$query = "INSERT INTO vacaciones (idEmpleado,fecha, inicio, fin, estatus) VALUES (".$data['Empleado'].",'".date("Y-m-d")."','".$data['Desde']."', '".$data['Hasta']."', 2)";
		    	$result = mysqli_query($this->link,$query);		    	
		    	if (mysqli_affected_rows($this->link)>0){
	            	return true;
	        }
		        else{
		            return false;
	        }
		}
		function updateStatus($data){
			session_start();		
			$query = "UPDATE vacaciones SET estatus = ".$data['estatus'].", actualizadaEL = '".date("Y-m-d")."', actualizadaPor = '".$_SESSION['usuario']."' WHERE idVacaciones = ".$data['id'];
			echo $query;
			//die();
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