<?php


include "conexionOracle.php";

 if(isset($_POST['delete']))
 {
	  $matricula=$_POST['matricula'];      


	  $sql=oci_parse($conn,"DELETE FROM NINOS WHERE MATRICULA=".$matricula);
	  $r=oci_execute($sql,OCI_DEFAULT);
	  
	  if ($r) {
	    print "EXITO";	    
	  }
	oci_commit($conn); // Consigna la transacción pendiente de la base de datos
	oci_free_statement($sql); // Libera todos los recursos asociados con una sentencia o cursor
	oci_close($conn); // Cierra una conexión a Oracle
	  
 } 
?>
