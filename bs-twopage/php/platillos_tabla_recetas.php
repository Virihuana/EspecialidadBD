<?php
include "conexionOracle.php";

if (!$conn) {    
    $m = oci_error();    
    echo $m['message'], "n";    
    exit; 
} else {    
    //echo "Conexión con éxito a Oracle!";

    $sql = oci_parse($conn, 'SELECT p.nombre as PLATO, i.nombre as INGRE FROM platillos p, ingredientes i, recetas WHERE idplat=platilloid AND ingredienteid=idingre AND idplat=:IDplt ORDER BY 1');
    
    $IDP=$_POST["IDP"];
    oci_bind_by_name($sql, ":IDplt", $IDP);

    echo " MSJ: ".$IDP;

    oci_execute($sql,OCI_DEFAULT);

        $tabla="<table id='TAB_PI' class='table table-striped table-bordered table-hover'>".
        "<thead><tr>".
            "<th> Platillo </th>".
            "<th> Ingredientes </th>".
        "</tr></thead>";      
        while (($row = oci_fetch_assoc($sql)) != false) {
          $tabla .="<tbody><tr>".
                    "<td>".$row["PLATO"]."</td>".
                    "<td>".$row["INGRE"]."</td>".
                    "</tr></tbody>";
        }
        $tabla .="</table>";
        echo $tabla;
} 
 
// Close the Oracle connection 
oci_close($conn); 
?>
