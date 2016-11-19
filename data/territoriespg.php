<?php
$employeeID = $_REQUEST["filter"]["filters"][0]["value"];

$user = "santi";
$password = "santi22";
$dbname = "northwind";
$port = "5432";
$host = "192.168.110.252";

$cadenaConexion = "host=$host port=$port dbname=$dbname user=$user password=$password";

$conexion = pg_connect($cadenaConexion) or die("Error en la Conexión: ".pg_last_error());
 
$arr = array();
$rs = pg_query("SELECT TRIM(t.territorydescription) AS territorydescription
				   FROM territories t
				   INNER JOIN employeeterritories et ON t.territoryID = et.territoryid 
				   INNER JOIN employees e ON et.employeeid = e.employeeid
				   WHERE e.employeeid = " .$employeeID);
				    
while($obj = pg_fetch_object($rs)) {
	$arr[] = $obj;
}

// add the header line to specify that the content type is JSON
header("Content-type: application/json"); 

echo "{\"data\":" .json_encode($arr). "}";
?>