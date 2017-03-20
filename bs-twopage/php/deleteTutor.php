<?php
include "conexionOracle.php";


 	$sql1 = oci_parse($conn,'SELECT IDTUT FROM TUTORES WHERE IDTUT = (SELECT MAX(IDTUT) FROM TUTORES)');

 	$r1=oci_execute($sql1);

 	$idTut = oci_fetch_assoc($sql1);
	$idtutor = $idTut["IDTUT"];
	echo $idtutor;

 	$sql = oci_parse($conn,'DELETE FROM TUTORES WHERE IDTUT='.$idtutor);

	$r=oci_execute($sql);

	if ($r) {
	    print "Eliminando tutor ultimo";
	}
	
	oci_commit($conn); // Consigna la transacción pendiente de la base de datos
	oci_free_statement($sql); // Libera todos los recursos asociados con una sentencia o cursor
	oci_close($conn); // Cierra una conexión a Oracle
	  
 ?>
