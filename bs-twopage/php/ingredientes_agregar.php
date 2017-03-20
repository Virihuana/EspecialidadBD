<?php
	include "conexionOracle.php";

	if(isset($_POST['insert'])) {
		$sql = oci_parse($conn,'INSERT INTO ingredientes VALUES (sec_ingredientes.nextval,:nombre)');
		$nombre=$_POST["nombre"];
		oci_bind_by_name($sql, ":nombre", $nombre);

		$r=oci_execute($sql);
		if ($r) {
			print "Registro Insertado";
		}

		oci_commit($conn); // Consigna la transacción pendiente de la base de datos
		oci_free_statement($sql); // Libera todos los recursos asociados con una sentencia o cursor
		oci_close($conn); // Cierra una conexión a Oracle

	}else{
		echo "ERROR: conexionOracle.php";
	}
?>
