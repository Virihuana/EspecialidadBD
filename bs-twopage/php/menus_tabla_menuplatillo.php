<?php
include "conexionOracle.php";

if (!$conn) {    
    $m = oci_error();    
    echo $m['message'], "n";    
    exit; 
} else {    
    //echo "Conexión con éxito a Oracle!";

    $sql = oci_parse($conn, 'SELECT idmenu, nombre FROM menus, platillos, menuplatillos WHERE idmenu=menuid AND platilloid=idplat AND idmenu=:IDmen ORDER BY 1');
    
    $IDM=$_POST["IDM"];
    oci_bind_by_name($sql, ":IDmen", $IDM);

    echo "El menú ".$IDM." tiene los siguientes platillos:";

    oci_execute($sql,OCI_DEFAULT);

    $tabla="<table id='TAB_MP' class='table table-striped table-bordered table-hover'>".
    "<thead><tr>".
        "<th> Nombre Platillo </th>".
    "</tr></thead>";
    while (($row = oci_fetch_assoc($sql)) != false) {
      $tabla .="<tbody><tr>".
                "<td>".$row["NOMBRE"]."</td>".
                "</tr></tbody>";
    }
    $tabla .="</table>";
    echo $tabla;
} 
 
// Close the Oracle connection 
oci_close($conn); 
?>
