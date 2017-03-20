<?php
include "conexionOracle.php";

 if(isset($_POST['insert']))
 {
 	/*$sql = oci_parse($conn,"INSERT INTO tutores
VALUES (:id,:curp,:ine,:nombre,:apaterno,:amaterno,:calle,:delegacion,:colonia,:cp,:rfc,:email,:banco,:nc)");
*/
$sql = oci_parse($conn,"INSERT INTO tutores
						VALUES (sec_tutores.nextval,
								:curp,
								:ine,
								:nombre,
								:apaterno,
								:amaterno,
								:calle,
								:delegacion,
								:colonia,
								:cp,
								:rfc,
								:email,
								:banco,
								:nc)");


	  $curp=$_POST["curp"];
	  $ine=$_POST["ine"];
	  $rfc=$_POST["rfc"];
	  $nombre=$_POST["nombre"];
	  $apaterno=$_POST["apaterno"];
	  $amaterno=$_POST["amaterno"];
	  $email=$_POST["email"];
	  $calle=$_POST["calle"];
	  $delegacion=$_POST["delegacion"];
	  $colonia=$_POST["colonia"];
	  $cp=$_POST["cp"];
	  $banco=$_POST["banco"];
	  $nc=$_POST["nc"];
	 /* $tel=$_POST["tel"];
	  $tipoTel=$_POST["tipoTel"];*/

	//oci_bind_by_name($sql, ":id", $id_tutor);
	oci_bind_by_name($sql, ":curp", $curp);
	oci_bind_by_name($sql, ":ine", $ine);
	oci_bind_by_name($sql, ":nombre", $nombre);
	oci_bind_by_name($sql, ":apaterno", $apaterno);
	oci_bind_by_name($sql, ":amaterno", $amaterno);
	oci_bind_by_name($sql, ":calle", $calle);
	oci_bind_by_name($sql, ":delegacion", $delegacion);
	oci_bind_by_name($sql, ":colonia", $colonia);
	oci_bind_by_name($sql, ":cp", $cp);
	oci_bind_by_name($sql, ":rfc", $rfc);
	oci_bind_by_name($sql, ":email", $email);
	oci_bind_by_name($sql, ":banco", $banco);
	oci_bind_by_name($sql, ":nc", $nc);

	$r=oci_execute($sql);

	if ($r) {
	    print "Un tutor registrado";
	    /*$sql2 = oci_parse($conn,"INSERT INTO telefonos
	    						 VALUES (:telefono,:tipoTel, (SELECT MAX(idtut) FROM tutores) )");

	    oci_bind_by_name($sql2, ":telefono", $tel);
	    oci_bind_by_name($sql2, ":tipoTel", $tipoTel);

	    $r1=oci_execute($sql2);*/

	}
	
	oci_commit($conn); // Consigna la transacción pendiente de la base de datos
	oci_free_statement($sql); // Libera todos los recursos asociados con una sentencia o cursor
	oci_close($conn); // Cierra una conexión a Oracle
	  
 }else{
 	echo "ERROR EN INSERT TUTOR";
 }
 ?>
