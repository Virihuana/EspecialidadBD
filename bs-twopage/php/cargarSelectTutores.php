<?php


include "conexionOracle.php";

$sql = oci_parse($conn, 'SELECT IDTUT,NOMBRES,APATERNO,AMATERNO FROM TUTORES');
oci_execute($sql,OCI_DEFAULT);

    while (($row = oci_fetch_assoc($sql)) != false) {      	     
       $select .="<option value=".$row["IDTUT"].">"
       		   .$row["NOMBRES"]." ".$row["APATERNO"]." ".$row["AMATERNO"].
       		   "</option>";
    }
    echo $select;

?>

