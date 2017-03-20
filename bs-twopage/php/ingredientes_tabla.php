<?php
include "conexionOracle.php";

if (!$conn) {    
    $m = oci_error();    
    echo $m['message'], "n";    
    exit; 
} else {    
    //echo "Conexión con éxito a Oracle!";
    $sql = oci_parse($conn, 'SELECT * FROM ingredientes ORDER BY 2');
    oci_execute($sql,OCI_DEFAULT);

        $tabla="<table id='TAB_ING' class='table table-striped table-bordered table-hover'>".
        "<thead><tr>".
            "<th> ID </th>".
            "<th> Nombres </th>".
            "<th> </th>".
            "<th> </th>".
        "</tr></thead>";
        while (($row = oci_fetch_assoc($sql)) != false) {
            $ID=$row["IDINGRE"];
            $tabla .="<tbody><tr>".
                    "<td>".$row["IDINGRE"]."</td>".
                    "<td>".$row["NOMBRE"]."</td>".
                    "<td><button type='button' value='1' style=' box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);' onclick='eliminarIngrediente(".$ID.");'>Eliminar</button></td>".
                    "<td><button type='button' value='1' style=' box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);' onclick='modificarIngrediente(".$ID.");'>Modificar</button></td>".
                    "</tr></tbody>";
        }
        $tabla .="</table>";
        echo $tabla;
} 
 
// Close the Oracle connection 
oci_close($conn); 
?>
