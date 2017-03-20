<?php
	include "conexionOracle.php";

	if(isset($_POST['insert'])) {
		$sql = oci_parse($conn,'INSERT INTO menus VALUES (sec_menus.nextval,sysdate,:precio,:tipo)');
		// select to_char(fcreacion, 'DD/MON/YYYY HH24:MI:SS') from menus;
		$precio=$_POST["precio"];
		$tipo=$_POST["tipo"];
		oci_bind_by_name($sql, ":precio", $precio);
		oci_bind_by_name($sql, ":tipo", $tipo);

		$r=oci_execute($sql);
		if ($r) {
			print "Menú Almacenado";
		}

		oci_commit($conn); // Consigna la transacción pendiente de la base de datos
		oci_free_statement($sql); // Libera todos los recursos asociados con una sentencia o cursor
		oci_close($conn); // Cierra una conexión a Oracle

	}else{
		echo "ERROR: conexionOracle.php";
	}
?>
