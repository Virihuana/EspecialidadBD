<?php
include "conexionOracle.php";

 if(isset($_POST['insert']))
 {


 	/*$sql1 = oci_parse($conn,'SELECT IDTUT FROM TUTORES WHERE IDTUT = (SELECT MAX(IDTUT) FROM TUTORES)');

 	$r1=oci_execute($sql1);

 	$idTut = oci_fetch_assoc($sql1);
	$idtutor = $idTut["IDTUT"];
	echo $idtutor;*/

 	$sql = oci_parse($conn,'INSERT INTO ninos VALUES (sec_ninos.nextval,:nombre,:apaterno,:amaterno,:fn,:fi,:fe,:colegiatura,:pagacuota)');

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
	oci_bind_by_name($sql, ":pagacuota", $idtut);

	$r=oci_execute($sql);

	if ($r) {
	    print "Una fila insertada";
	}
	
	oci_commit($conn); // Consigna la transacción pendiente de la base de datos
	oci_free_statement($sql); // Libera todos los recursos asociados con una sentencia o cursor
	oci_close($conn); // Cierra una conexión a Oracle
	  
 }else{
 	echo "ERROR EN INSERT TUTOR";
 }
 ?>
