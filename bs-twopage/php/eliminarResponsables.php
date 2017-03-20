<?php


include "conexionOracle.php";

 if(isset($_POST['delete']))
 {
	  $ninoid=$_POST['ninoid'];
	  $tutorid=$_POST['tutorid'];            


	  $sql=oci_parse($conn,"DELETE FROM RESPONSABLES WHERE NINOID=".$ninoid." "."AND TUTORID=".$tutorid);
	  $r=oci_execute($sql,OCI_DEFAULT);
	  
	  if ($r) {
	    print "EXITO";	    
	  }
	oci_commit($conn); // Consigna la transacción pendiente de la base de datos
	oci_free_statement($sql); // Libera todos los recursos asociados con una sentencia o cursor
	oci_close($conn); // Cierra una conexión a Oracle
	  
 } 
?>
