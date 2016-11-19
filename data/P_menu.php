<?php
$user = "postgres";
$password = "relova";
$dbname = "dbsoporte";
$port = "5432";
$host = "192.168.110.252";

$cadenaConexion = "host=$host port=$port dbname=$dbname user=$user password=$password";

$conexion = pg_connect($cadenaConexion) or die("Error en la Conexión: ".pg_last_error());

// add the header line to specify that the content type is JSON
header("Content-type: application/json");

// determine the request type
$verb = $_SERVER["REQUEST_METHOD"];

// handle a GET
if ($verb == "GET") {
	$arr = array();

	$rs = pg_query("SELECT cm.idcargomod, cm.idcargo, cm.idmodulo, m.idmodulo,m.nombmod FROM cargomodulo cm INNER JOIN modulo m ON cm.idmodulo = m.idmodulo");
	
	while($obj = pg_fetch_object($rs)) {
		$arr[] = $obj;
	}
	
	echo "{\"data\":" .json_encode($arr). "}";	
}

?>