<?php
include "conexionOracle.php";

if(isset($_POST['busqueda'])) {
    $sql = oci_parse($conn, 'SELECT ninoid, menuid, fecha FROM dietas, menus WHERE ninoid=:IDaux AND menuid=idmenu ORDER BY fecha');
    $IDn=$_POST["IDNINO"];
     oci_bind_by_name($sql, ":IDaux", $IDn);
     oci_execute($sql,OCI_DEFAULT);

        $tabla="<table id='TAB_HistoC' class='table table-striped table-bordered table-hover'>".
        "<thead><tr>".
            "<th> ID Niño </th>".
            "<th> Menu Consumido </th>".
            "<th> Fecha </th>".
        "</tr></thead>";
        while (($row = oci_fetch_assoc($sql)) != false) {
            $tabla .="<tbody><tr>".
                    "<td>".$row["NINOID"]."</td>".
                    "<td>".$row["MENUID"]."</td>".
                    "<td>".$row["FECHA"]."</td>".
                    "</tr></tbody>";
        }
        $tabla .="</table>";
        echo $tabla;
}else{
    echo "ERROR: conexionOracle.php";
}
 
// Close the Oracle connection 
oci_close($conn); 
?>
