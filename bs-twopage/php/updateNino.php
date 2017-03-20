<?php
include "conexionOracle.php";

 if(isset($_POST['update'])){
	$matricula=$_POST["matricula"]; 
	$sql = oci_parse($conn,"UPDATE NINOS
							SET NOMBRES=:nombre,
								APATERNO=:apaterno,
								AMATERNO=:amaterno,
								FNACIMIENTO=:fn,
								FINGRESO=:fi,
								FEGRESO=:fe,
								COLEGIATURA=:colegiatura,
								PAGACUOTAID=:idtut
							WHERE MATRICULA=".$matricula);

	$nombre=$_POST["nombre"];
	$apaterno=$_POST["apaterno"];
	$amaterno=$_POST["amaterno"];
	$fn=$_POST["fn"];
	$fi=$_POST["fi"];
	$fe=$_POST["fe"];
	$colegiatura=$_POST["colegiatura"];
	$idtut=$_POST["idtut"];

	oci_bind_by_name($sql, ":nombre", $nombre);
	oci_bind_by_name($sql, ":apaterno", $apaterno);
	oci_bind_by_name($sql, ":amaterno", $amaterno);
	oci_bind_by_name($sql, ":fn", $fn);
	oci_bind_by_name($sql, ":fi", $fi);
	oci_bind_by_name($sql, ":fe", $fe);
	oci_bind_by_name($sql, ":colegiatura", $colegiatura);
	oci_bind_by_name($sql, ":idtut", $idtut);

	$r=oci_execute($sql);

	if ($r) {
	    print "nino actualizado";
	}
	
	oci_commit($conn); // Consigna la transacción pendiente de la base de datos
	oci_free_statement($sql); // Libera todos los recursos asociados con una sentencia o cursor
	oci_close($conn); // Cierra una conexión a Oracle
	  
 }else{
 	echo "ERROR EN INSERT TUTOR";
 }
 ?>
