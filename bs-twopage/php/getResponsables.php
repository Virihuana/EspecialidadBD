<?php

include "conexionOracle.php";


if(isset($_POST['insert'])){
		$matricula=$_POST['matricula'];

   
    //echo "Conexión con éxito a Oracle!";
    $sql = oci_parse($conn, 'SELECT nombres, parentesco, apaterno, amaterno, ninoid, tutorid
							FROM tutores, responsables
							WHERE ninoid='.$matricula.'
							AND tutorid=idtut');
    oci_execute($sql,OCI_DEFAULT);
    $sql2 = oci_parse($conn, 'SELECT nombres, apaterno, amaterno FROM ninos WHERE matricula='.$matricula);

    oci_execute($sql2,OCI_DEFAULT);
    $res = oci_fetch_assoc($sql2);

        $tabla="<h5>RESPONSABLES DE RECOGER A: ".$res["NOMBRES"]." ".$res["APATERNO"]." ".$res["AMATERNO"]."</h5><table class='table table-striped table-bordered table-hover'><thead><tr>".
        "<th>Nombre</th>".        
        "<th>Parentezco</th>".
        "<th></th>".
        "</tr></thead>";
      
        while (($row = oci_fetch_assoc($sql)) != false) {
          //echo $row["MATRICULA"];
          $tabla .="<tbody><tr><td>"
                  .$row["NOMBRES"]." ".$row["APATERNO"]." ".$row["AMATERNO"]."</td><td>"
                  .$row["PARENTESCO"] ."</td><td>"."<button type='button' value='1' style=' box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);' onclick='eliminarResponsable(".$row["NINOID"].",".$row["TUTORID"].");'>Eliminar</button>"."</td>"          
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




