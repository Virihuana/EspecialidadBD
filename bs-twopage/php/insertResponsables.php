<?php
include "conexionOracle.php";

 if(isset($_POST['insert']))
 {


 	$sql = oci_parse($conn,'INSERT INTO RESPONSABLES VALUES (:idNino,:idTutor,:parentesco)');

	  $idNino=$_POST["idNinosRespon"];
	  $idTutor=$_POST["idTutoRespon"];
	  $parentesco=$_POST["parentesco"];
	  


	oci_bind_by_name($sql, ":idNino", $idNino);
	oci_bind_by_name($sql, ":idTutor", $idTutor);
	oci_bind_by_name($sql, ":parentesco", $parentesco);
	
	$r=oci_execute($sql);

	if ($r) {
	    print "Una fila insertada en tabla: Responsables";
	}
	
	oci_commit($conn); // Consigna la transacción pendiente de la base de datos
	oci_free_statement($sql); // Libera todos los recursos asociados con una sentencia o cursor
	oci_close($conn); // Cierra una conexión a Oracle
	  
 }else{
 	echo "ERROR EN INSERT RESPONSABLES";
 }
 ?>
