<?php
include "conexionOracle.php";

$sql = oci_parse($conn, 'SELECT IDPLAT, NOMBRE FROM platillos ORDER BY 2');
oci_execute($sql,OCI_DEFAULT);

    while (($row = oci_fetch_assoc($sql)) != false) {
       $select .="<option value=".$row["IDPLAT"].">"
       		   		.$row["NOMBRE"].
       		   	"</option>";
    }
    echo $select;

?>

