<?php

include "conexionOracle.php";


if(isset($_POST['get'])){
    $matricula=$_POST['matricula'];

   
    //echo "Conexión con éxito a Oracle!";
    $sql = oci_parse($conn, 'SELECT ninoid, ingredienteid,nombres, apaterno, amaterno, nombre, medicamento
                              FROM ninos, ingredientes, alergias
                              WHERE matricula='.$matricula.'
                              AND ninoid=matricula
                              AND ingredienteid=idingre');

    oci_execute($sql,OCI_DEFAULT);
    $sql2 = oci_parse($conn, 'SELECT nombres, apaterno, amaterno FROM ninos WHERE matricula='.$matricula);

    oci_execute($sql2,OCI_DEFAULT);
    $res = oci_fetch_assoc($sql2);

        $tabla="<h5>LAS ALERGIAS DE: ".$res["NOMBRES"]." ".$res["APATERNO"]." ".$res["AMATERNO"]." SON: </h5><table class='table table-striped table-bordered table-hover'><thead><tr>".      
        "<th>Ingrediente</th>".
        "<th>Medicamento</th>".
        "</tr></thead>";
      
        while (($row = oci_fetch_assoc($sql)) != false) {
          //echo $row["MATRICULA"];
          $tabla .="<tbody><tr><td>"
                  .$row["NOMBRE"] ."</td><td>"
                  .$row["MEDICAMENTO"] ."</td>"          
                  ."</tr></tbody>";
        }
        $tabla .="</table>";
        echo $tabla;
        // Close the Oracle connection 
    oci_close($conn); 

  
   }else{
  echo "NO SE HIZO EL INSERT";
 }

?>



