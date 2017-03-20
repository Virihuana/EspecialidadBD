<?php
include "conexionOracle.php";

 if(isset($_POST['insert'])){
	
    $sql = oci_parse($conn,"INSERT INTO alergias
    						 VALUES ( :matricula,:ingredienteid,:medicamento)");
	$matricula=$_POST["matricula"];
	$ingredienteid=$_POST["ingredienteid"];
	$medicamento=$_POST["medicamento"];

	oci_bind_by_name($sql, ":matricula", $matricula);
    oci_bind_by_name($sql, ":ingredienteid", $ingredienteid);
	oci_bind_by_name($sql, ":medicamento", $medicamento);

    $r=oci_execute($sql);

	if ($r) {
	    print "Una alergia registrada";
	}
	
	oci_commit($conn); // Consigna la transacción pendiente de la base de datos
	oci_free_statement($sql); // Libera todos los recursos asociados con una sentencia o cursor
	oci_close($conn); // Cierra una conexión a Oracle
	  
 }else{
 	echo "ERROR EN INSERT ALERGIA";
 }
 
 ?>
