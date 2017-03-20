<?php
	include "conexionOracle.php";

	if(isset($_POST['insert'])) {
// 2.- preparar el insert con los datos de POST
		$sql = oci_parse($conn,'INSERT INTO menuplatillos VALUES (:idmen, :idpla)');
		$id1=$_POST["IDM"];
		$id2=$_POST["IDP"];
		oci_bind_by_name($sql, ":idmen", $id1);
		oci_bind_by_name($sql, ":idpla", $id2);

		$r=oci_execute($sql);
		if ($r) {
			print "Registrado";
		}

		oci_commit($conn); // Consigna la transacción pendiente de la base de datos
		oci_free_statement($sql); // Libera todos los recursos asociados con una sentencia o cursor
		oci_close($conn); // Cierra una conexión a Oracle

	}else{
		echo "ERROR: conexionOracle.php";
	}
?>
