<?php
$user = "postgres";
$password = "relova";
$dbname = "dbsoporte";
$port = "5432";
$host = "192.168.110.252";

$cadenaConexion = "host=$host port=$port dbname=$dbname user=$user password=$password";

$conexion = pg_connect($cadenaConexion) or die("Error en la Conexión: ".pg_last_error());
$arr = array();
// add the header line to specify that the content type is JSON


// determine the request type
$idm=$_REQUEST["idmodulo"];


	$rs = pg_query("SELECT idmodulo, idsmodulo,nombsmod,url FROM submodulos WHERE idmodulo=".$idm);
	
	while($obj = pg_fetch_object($rs)) {
		$arr[] = $obj;
	}
	header("Content-type: application/json");
	echo "{\"data\":" .json_encode($arr). "}";	

?>