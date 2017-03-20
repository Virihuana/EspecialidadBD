<?php
include "conexionOracle.php";

if(isset($_POST['busqueda'])) {
    $sql = oci_parse($conn, 'SELECT idmenu, tipo
                            FROM menus
                            WHERE idmenu NOT IN (SELECT distinct(idmenu)
                                                    FROM menus, menuplatillos
                                                    WHERE idmenu=menuid
                                                    AND platilloid IN (SELECT idplat
                                                                            FROM platillos, recetas
                                                                            WHERE idplat=platilloid
                                                                            AND ingredienteid IN (SELECT idingre
                                                                                                    FROM ingredientes, alergias, ninos
                                                                                                    WHERE matricula=:IDaux
                                                                                                    AND matricula=ninoID
                                                                                                    AND ingredienteid=idingre)))
                            AND tipo LIKE :TIPaux');
    
    $IDn=$_POST["IDNINO"];
    $TIP=$_POST["TIPO"];
    oci_bind_by_name($sql, ":IDaux", $IDn);
    oci_bind_by_name($sql, ":TIPaux", $TIP);
    oci_execute($sql,OCI_DEFAULT);

        echo "Menus que puede Consumir el Niño:";

        $tabla="<table id='TAB_CoMe' class='table table-striped table-bordered table-hover'>".
        "<thead><tr>".
            "<th> ID Menu </th>".
            "<th> Tipo </th>".
            "<th> </th>".
        "</tr></thead>";      
        while (($row = oci_fetch_assoc($sql)) != false) {
          $tabla .="<tbody><tr>".
                    "<td>".$row["IDMENU"]."</td>".
                    "<td>".$row["TIPO"]."</td>".
                    "<td><button type='button' value='1' style=' box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);' onclick='comprarMenu(".$row["IDMENU"].");'> Comprar Menú </button></td>".
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
