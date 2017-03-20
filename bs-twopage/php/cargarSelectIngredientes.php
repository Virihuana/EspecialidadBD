<?php


include "conexionOracle.php";

$sql = oci_parse($conn, 'SELECT * FROM INGREDIENTES');
oci_execute($sql,OCI_DEFAULT);

    while (($row = oci_fetch_assoc($sql)) != false) {      	     
       $select .="<option value=".$row["IDINGRE"].">"
       		   .$row["NOMBRE"].
       		   "</option>";
    }
    echo $select;

?>

