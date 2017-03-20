<?php
include "conexionOracle.php";

$sql = oci_parse($conn, 'SELECT IDINGRE, NOMBRE FROM ingredientes ORDER BY 2');
oci_execute($sql,OCI_DEFAULT);

    while (($row = oci_fetch_assoc($sql)) != false) {      	     
       $select .="<option value=".$row["IDINGRE"].">"
       		   		.$row["NOMBRE"].
       		   	"</option>";
    }
    echo $select;

?>

