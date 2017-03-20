<?php


include "conexionOracle.php";
$sql = oci_parse($conn, 'SELECT MATRICULA,NOMBRES,APATERNO,AMATERNO FROM NINOS');
oci_execute($sql,OCI_DEFAULT);

    while (($row = oci_fetch_assoc($sql)) != false) {      	     
       $select .="<option value=".$row["MATRICULA"].">"
       		   .$row["NOMBRES"]." ".$row["APATERNO"]." ".$row["AMATERNO"].
       		   "</option>";
    }
    echo $select;

?>

