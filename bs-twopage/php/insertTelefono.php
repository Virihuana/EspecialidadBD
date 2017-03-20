<?php
include "conexionOracle.php";

 if(isset($_POST['insert'])){
	
    $sql = oci_parse($conn,"INSERT INTO telefonos
    						 VALUES ( :telefono,:tipoTel, (SELECT MAX(idtut) FROM tutores) )");

	$tel=$_POST["tel"];
	$tipoTel=$_POST["tipoTel"];

	oci_bind_by_name($sql, ":telefono", $tel);
    oci_bind_by_name($sql, ":tipoTel", $tipoTel);

    $r=oci_execute($sql);

	if ($r) {
	    print "Un telefono registrado";
	}
	
	oci_commit($conn); // Consigna la transacción pendiente de la base de datos
	oci_free_statement($sql); // Libera todos los recursos asociados con una sentencia o cursor
	oci_close($conn); // Cierra una conexión a Oracle
	  
 }else{
 	echo "ERROR EN INSERT TELEFONO";
 }
 
 ?>
