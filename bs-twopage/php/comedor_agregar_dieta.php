<?php
	include "conexionOracle.php";

	if(isset($_POST['insert'])) {
// 2.- preparar el insert con los datos de POST
		$sql = oci_parse($conn,'INSERT INTO dietas VALUES (:idaux1, :idaux2, sysdate)');
		$idM=$_POST["IDM"];
		$idN=$_POST["IDNINO"];
		oci_bind_by_name($sql, ":idaux1", $idN);
		oci_bind_by_name($sql, ":idaux2", $idM);

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
