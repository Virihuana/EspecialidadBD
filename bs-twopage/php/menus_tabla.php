<?php
include "conexionOracle.php";

if (!$conn) {    
    $m = oci_error();    
    echo $m['message'], "n";    
    exit; 
} else {    
    //echo "Conexión con éxito a Oracle!";
    $sql = oci_parse($conn, 'SELECT * FROM menus ORDER BY tipo DESC');    // select to_char(fcreacion, 'DD/MON/YYYY HH24:MI:SS') from menus;
    oci_execute($sql,OCI_DEFAULT);

        $tabla="<table id='TAB_MEN' class='table table-striped table-bordered table-hover'>".
        "<thead><tr>".
            "<th> ID </th>".
            "<th> Fecha </th>".
            "<th> Precio $ </th>".
            "<th> Tipo </th>".
            "<th> </th>".
            "<th> </th>".
            "<th> </th>".
        "</tr></thead>";
        while (($row = oci_fetch_assoc($sql)) != false) {
            $ID=$row["IDMENU"];
            $tabla .="<tbody><tr>".
                    "<td>".$ID."</td>".
                    "<td>".$row["FCREACION"]."</td>".
                    "<td>".$row["PRECIO"]."</td>".
                    "<td>".$row["TIPO"]."</td>".
                    "<td><button type='button' value='1' style=' box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);' onclick='seleccionarMenu(".$ID.");'>Seleccionar</button></td>".
                    "<td><button type='button' value='1' style=' box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);' onclick='eliminarMenu(".$ID.");'>Eliminar</button></td>".
                    "<td><button type='button' value='1' style=' box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);' onclick='modificarMenu(".$ID.");'>Modificar</button></td>".
                    "</tr></tbody>";
        }
        $tabla .="</table>";
        echo $tabla;
} 
 
// Close the Oracle connection 
oci_close($conn); 
?>
