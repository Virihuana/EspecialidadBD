dojo.require("dojox.json.schema");

    dojo.ready(function() {
      dojo.xhrGet({
        url: 'http://localhost/JSONSchema/schemaLibros.json',
        handleAs: 'json',
        load: function(schema) {
          dojo.xhrGet({
            url: 'http://localhost/JSONSchema/libros.json',
            handleAs: 'json',
            load: function(users) {
              var result = dojox.json.schema.validate(users,schema);
              if(result.errors==""){
                alert("EXITO");
              }else{
                alert("FALLO");
                          (result.errors).forEach( function(e){
                            ant=document.getElementById("res").innerHTML;
                            document.getElementById("res").innerHTML=ant+"<br>"+e.message;
                          });
              } 
            }
          });
        }
      });
    });
/**********************************************************************************/
/*     NIÑOS Y TUTORES     */
/**********************************************************************************/
  
  //BUSCAR TUTOR
 function buscarTutor() {
    var arreglo;
    var idtut=document.getElementById("tutorSelectEditar").value; //PARA BUSCAR SUS TELEFONOS DE ESE TUTOR    
    var dataString="idtut="+document.getElementById("tutorSelectEditar").value+                         
                  "&get=";                  
        $.ajax({
              type: "POST",
              url: "./php/buscarTutor.php",
              data: dataString,
              crossDomain: true,
              cache: false,
              success: function(response) {
              alert(response)     
              arreglo = JSON.parse(response);
              document.getElementById("inputECurp").value=arreglo[0].CURP;
              document.getElementById("inputEINE").value=arreglo[0].INE;
              document.getElementById("inputERFC").value=arreglo[0].RFC;
              document.getElementById("inputENombre").value=arreglo[0].NOMBRES;
              document.getElementById("inputEApaterno").value=arreglo[0].APATERNO;
              document.getElementById("inputEAmaterno").value=arreglo[0].AMATERNO;
              document.getElementById("inputEEmail").value=arreglo[0].EMAIL;
              document.getElementById("inputECalle").value=arreglo[0].CALLE;
              document.getElementById("inputEDelega").value=arreglo[0].DELEGACION;
              document.getElementById("inputEColonia").value=arreglo[0].COLONIA;
              document.getElementById("inputECP").value=arreglo[0].CPOSTAL;
              document.getElementById("inputEBanco").value=arreglo[0].BANCO;
              document.getElementById("inputENC").value=arreglo[0].CUENTA;
              },
              error: function() {
                  alert("ERROR AJAX: buscarTutor");
              }
         });         
  }









//MOSTRAR TODOS NINOS
 function getAllNinos() {
        $.ajax({
              type: "POST",
              url: "./php/getAllNinos.php",
              data: "",
              crossDomain: true,
              cache: false,
              success: function(response) {                                  
                 document.getElementById("divTablaNinos").innerHTML=response;
              },
              error: function() {
                  alert("ERROR AJAX: getAllNinos");
              }
         });         
  }
  //MOSTRAR TODOS EMPLEADOS
 function getAllAlergias() {
      cargarSelectNinos();
      var dataString="matricula="+document.getElementById("ninosAlergias").value+                         
                     "&get=";        
        $.ajax({
              type: "POST",
              url: "./php/getAllAlergias.php",
              data: dataString,
              crossDomain: true,
              cache: false,
              success: function(response) {  
              // alert(response);            
                 document.getElementById("divTablaAlergias").innerHTML =response;

              },
              error: function() {
                  alert("ERROR AJAX: buscarResponsables");
              }
         });      
  }



//BUSCAR NINO
 function buscarNino() {
    var arreglo;
    var dataString="matricula="+document.getElementById("ninoSelectEditar").value+                         
                  "&get="; 
        $.ajax({
              type: "POST",
              url: "./php/buscarNino.php",
              data: dataString,
              crossDomain: true,
              cache: false,
              success: function(response) {
              alert(response+"HOLAAAAAAAAAAAAAAAASJHDAJSKDKAJSDHASJF")     
              arreglo = JSON.parse(response);
              //alert(arreglo[0].MATRICULA);
              document.getElementById("inputENombreNino").value=arreglo[0].NOMBRES;
              document.getElementById("inputEApaternoNino").value=arreglo[0].APATERNO;
              document.getElementById("inputEAmaternoNino").value=arreglo[0].AMATERNO;
              document.getElementById("inputEfnNino").value=arreglo[0].FNACIMIENTO;
              document.getElementById("inputEfiNino").value=arreglo[0].FINGRESO;
              document.getElementById("inputEfeNino").value=arreglo[0].FEGRESO;
              document.getElementById("inputECole").value=arreglo[0].COLEGIATURA;
              document.getElementById("tutorESelect").value=arreglo[0].PAGACUOTAID;
              },
              error: function() {
                  alert("ERROR AJAX: buscarTutor");
              }
         });         
  }

  function eliminarNino(MATRICULA){
   // alert(MATRICULA);
     var dataString="matricula="+MATRICULA+                         
                    "&delete=";   
        $.ajax({
              type: "POST",
              url: "./php/eliminarNino.php",
              data: dataString,
              crossDomain: true,
              cache: false,
              success: function(response) { 
                  //alert(response);
                  if(response!="EXITO"){
                    alert("ERROR, VIOLACION DE INTEGRIDAD");
                  }else
                    alert("EXITO AJAX: eliminarNino");              
                  getAllNinos();   
                  cargarSelectNinos();                                    
              },
              error: function() {
                  alert("ERROR AJAX: eliminarNino");
              }
         });     
}

//ELIMINAR RESPONSABLE
  function eliminarResponsable(NINOID,TUTORID){
   // alert(NINOID+" "+TUTORID);

     var dataString="ninoid="+NINOID+                         
                    "&tutorid="+TUTORID+  
                    "&delete=";   
        $.ajax({
              type: "POST",
              url: "./php/eliminarResponsables.php",
              data: dataString,
              crossDomain: true,
              cache: false,
              success: function(response) { 
                  alert(response); 
                  buscarResponsables();                                  
              },
              error: function() {
                  alert("ERROR AJAX: eliminarResponsable");
              }
         });     
}


 function cargarSelectTutores() {         
        $.ajax({
              type: "POST",
              url: "./php/cargarSelectTutores.php",
              data: "",
              crossDomain: true,
              cache: false,
              success: function(response) {        
                 document.getElementById("tutorSelect").innerHTML =response;
                 document.getElementById("tutoresResponAgregar").innerHTML=response;
                 document.getElementById("tutorSelectEditar").innerHTML =response;
                 document.getElementById("tutorESelect").innerHTML =response;
              },
              error: function() {
                  alert("ERROR AJAX: cargarSelectNinos");
              }
         });         
  }

 function cargarSelectNinos() {         
        $.ajax({
              type: "POST",
              url: "./php/cargarSelectNinos.php",
              data: "",
              crossDomain: true,
              cache: false,
              success: function(response) {        
                 document.getElementById("ninosRespon").innerHTML =response;
                 document.getElementById("ninosResponAgregar").innerHTML =response;
                 document.getElementById("ninoSelectEditar").innerHTML =response;
                 document.getElementById("ninosAlergias").innerHTML =response;
              },
              error: function() {
                  alert("ERROR AJAX: cargarSelectNinos");
              }
         });         
  }

 function cargarSelectIngredientes() {         
        $.ajax({
              type: "POST",
              url: "./php/cargarSelectIngredientes.php",
              data: "",
              crossDomain: true,
              cache: false,
              success: function(response) { 
              //alert(response)       
                 document.getElementById("ingredientesAlergias").innerHTML =response;                 
              },
              error: function() {
                  alert("ERROR AJAX: cargarSelectIngredientes");
              }
         });         
  }


  function buscarResponsables(){
    cargarSelectNinos();
      var dataString="matricula="+document.getElementById("ninosRespon").value+                         
                          "&insert=";        
        $.ajax({
              type: "POST",
              url: "./php/getResponsables.php",
              data: dataString,
              crossDomain: true,
              cache: false,
              success: function(response) {  
              // alert(response);            
                 document.getElementById("divTablaResponsables").innerHTML =response;

              },
              error: function() {
                  alert("ERROR AJAX: buscarResponsables");
              }
         });       
  }
//INSERTAR TUTOR
function insertTutor() {
    cargarSelectTutores();
    if(document.getElementById("inputCurp").value!=""&&
       document.getElementById("inputINE").value!=""&&
       document.getElementById("inputNombre").value!=""&&
       document.getElementById("inputApaterno").value!=""&&
       document.getElementById("inputCalle").value!=""&&
       document.getElementById("inputDelega").value!=""&&
       document.getElementById("inputColonia").value!=""&&
       document.getElementById("inputCP").value!=""){
       
            var dataString="curp="+document.getElementById("inputCurp").value+
                              "&ine="+document.getElementById("inputINE").value+
                              "&rfc="+document.getElementById("inputRFC").value+
                              "&nombre="+document.getElementById("inputNombre").value+
                              "&apaterno="+document.getElementById("inputApaterno").value+
                              "&amaterno="+document.getElementById("inputAmaterno").value+
                              "&email="+document.getElementById("inputEmail").value+
                              "&calle="+document.getElementById("inputCalle").value+
                              "&delegacion="+document.getElementById("inputDelega").value+                          
                              "&colonia="+document.getElementById("inputColonia").value+                          
                              "&cp="+document.getElementById("inputCP").value+                          
                              "&banco="+document.getElementById("inputBanco").value+
                              "&nc="+document.getElementById("inputNC").value+                                                  
                              "&insert=";     
            $.ajax({
                  type: "POST",
                  url: "./php/insertTutor.php",
                  data: dataString,
                  crossDomain: true,
                  cache: false,
                  success: function(response) {
                     alert("EXITO AJAX: insertTutor");
                     cargarSelectTutores();
                  },
                  error: function() {
                      alert("ERROR AJAX: insertTutor");
                  }
             });  
      }else{
        alert("Datos NULOS o INCORRECTOS en el TUTOR");        
      }
  }    


//INSERTAR TELEFONOS
  function insertTelefono() {
    //cargarSelectTutores();
    var bandera=false;
    
    if(document.getElementById("inputCurp").value!=""){
       
      var telefono=document.getElementById("inputTel").value;
      var telefonoAux;
      var tipoTel=document.getElementById("selctTelefonos").value;
      var tipoTelAux;
      alert("TELEFONO: "+telefono+ " " +"TAMANIO: "+telefono.length+ " " +tipoTel);
      if(telefono.length==10){
          telefonoAux=document.getElementById("inputTel").value;
          if(tipoTel=="Casa"||tipoTel=="Oficina"){
              //alert("Exito en el telefono");
              bandera=true;
              tipoTelAux=document.getElementById("selctTelefonos").value;
          }else{
            alert("El telefono registrado no coincide con el formato de telefono de "+tipoTel);
          }          
      }else
        if(telefono.length==13){            
            telefonoAux=document.getElementById("inputTel").value;
            if(tipoTel=="Celular"){
               // alert("Exito en el telefono");
                bandera=true;
                tipoTelAux=document.getElementById("selctTelefonos").value;
            }else{
              alert("El telefono registrado no coincide con el formato de telefono de "+tipoTel);
            }     
        }else
          if(telefono.length>13 || telefono.length<10)
              alert("Formato erróneo de telefono");
          else         
              if(telefono==' '){
                  telefonoAux=" ";
                  bandera=true;
                  //alert("Exito en el telefono");
              }

        if(bandera==true){
            var dataString="tel="+telefonoAux+
                              "&tipoTel="+tipoTelAux+                                                  
                              "&insert=";     
                              alert(document.getElementById("inputCurp").value+" "+telefonoAux+" "+tipoTelAux);
            $.ajax({
                  type: "POST",
                  url: "./php/insertTelefono.php",
                  data: dataString,
                  crossDomain: true,
                  cache: false,
                  success: function(response) {
                     alert("EXITO AJAX: insertTelefono");
                    // alert(response);
                     cargarTelefonos();
                  },
                  error: function() {
                      alert("ERROR AJAX: insertTelefono");
                  }
             });  
        }else
          alert("ERROR EN FORMATO DE TELEFONO, INTENTAR DE NUEVO")
      }else{
        alert("No hay tutor al cual agregarle telefonos");        
      }
  }       

//INSERTAR NIÑO
  function insertNino() {   
      if(document.getElementById("inputNombreNino").value!=""&&
         document.getElementById("inputApaternoNino").value!=""&&
         document.getElementById("inputfnNino").value!=""&&
         document.getElementById("inputfiNino").value!=""&&
         document.getElementById("inputCole").value!=""){         
              var dataString="nombre="+document.getElementById("inputNombreNino").value+
                                    "&apaterno="+document.getElementById("inputApaternoNino").value+
                                    "&amaterno="+document.getElementById("inputAmaternoNino").value+
                                    "&fn="+document.getElementById("inputfnNino").value+
                                    "&fi="+document.getElementById("inputfiNino").value+
                                    "&fe="+document.getElementById("inputfeNino").value+
                                    "&colegiatura="+document.getElementById("inputCole").value+
                                    "&idtut="+document.getElementById("tutorSelect").value+                                                     
                                    "&insert="; 
                  $.ajax({
                        type: "POST",
                        url: "./php/insertNino.php",
                        data: dataString,
                        crossDomain: true,
                        cache: false,
                        success: function(response) {
                        //  alert(response);
                           alert("EXITO AJAX: insertNino");
                           getAllNinos();   
                           cargarSelectNinos();                    
                        },
                        error: function() {
                            alert("ERROR AJAX: insertNino");
                        }
                   });
      }else{
        alert("Datos NULOS o INCORRECTOS en el NIÑO");        
      }
  }  

//INSERTAR USUARIO
  function insertResponsables() {        
      var dataString="idNinosRespon="+document.getElementById("ninosResponAgregar").value+
                            "&idTutoRespon="+document.getElementById("tutoresResponAgregar").value+  
                            "&parentesco="+document.getElementById("responsableSelect").value+                                                                           
                            "&insert="; 
                            alert(document.getElementById("responsableSelect").value);
          $.ajax({
                type: "POST",
                url: "./php/insertResponsables.php",
                data: dataString,
                crossDomain: true,
                cache: false,
                success: function(response) {
                  //alert(response);
                   alert("EXITO AJAX: insertResponsables");
                   getAllNinos();                       
                },
                error: function() {
                    alert("ERROR AJAX: insertResponsables");
                }
           });
  }      
//INSERTAR ALERGIAS
  function insertAlergias() {        
      var dataString="matricula="+document.getElementById("ninosAlergias").value+
                    "&ingredienteid="+document.getElementById("ingredientesAlergias").value+                                                    
                    "&medicamento="+document.getElementById("inputMedica").value+                                                    
                    "&insert="; 
          $.ajax({
                type: "POST",
                url: "./php/insertAlergia.php",
                data: dataString,
                crossDomain: true,
                cache: false,
                success: function(response) {
                  alert(response);
                   alert("EXITO AJAX: insertAlergias");                                  
                },
                error: function() {
                    alert("ERROR AJAX: insertAlergias");
                }
           });
  }  


//EDITAR TUTOR
 function editarTutor() {        
  alert("ID TUTOR A EDITAR: "+document.getElementById("tutorSelectEditar").value);
    if(document.getElementById("inputECurp").value!=""&&
       document.getElementById("inputEINE").value!=""&&
       document.getElementById("inputENombre").value!=""&&
       document.getElementById("inputEApaterno").value!=""&&
       document.getElementById("inputECalle").value!=""&&
       document.getElementById("inputEDelega").value!=""&&
       document.getElementById("inputEColonia").value!=""&&
       document.getElementById("inputECP").value!=""){
       
        var dataString="idtut="+document.getElementById("tutorSelectEditar").value+
                          "&curp="+document.getElementById("inputECurp").value+
                          "&ine="+document.getElementById("inputEINE").value+
                          "&rfc="+document.getElementById("inputERFC").value+
                          "&nombre="+document.getElementById("inputENombre").value+
                          "&apaterno="+document.getElementById("inputEApaterno").value+
                          "&amaterno="+document.getElementById("inputEAmaterno").value+
                          "&email="+document.getElementById("inputEEmail").value+
                          "&calle="+document.getElementById("inputECalle").value+
                          "&delegacion="+document.getElementById("inputEDelega").value+                          
                          "&colonia="+document.getElementById("inputEColonia").value+                          
                          "&cp="+document.getElementById("inputECP").value+                          
                          "&banco="+document.getElementById("inputEBanco").value+                          
                          "&nc="+document.getElementById("inputENC").value+                          
                          "&update=";                                      
        
        $.ajax({
              type: "POST",
              url: "./php/updateTutor.php",
              data: dataString,
              crossDomain: true,
              cache: false,
              success: function(response) {
                alert(response);
                 alert("EXITO AJAX: editarTutor");
                 cargarSelectTutores();
              },
              error: function() {
                  alert("ERROR AJAX: editarTutor");
              }
         });  
      }else{
        alert("Datos NULOS o INCORRECTOS en el TUTOR");        
      }
  }  


//EDITAR NINO
 function editarNino() {        
  if(document.getElementById("inputENombreNino").value!=""&&
         document.getElementById("inputEApaternoNino").value!=""&&
         document.getElementById("inputEfnNino").value!=""&&
         document.getElementById("inputEfiNino").value!=""&&
         document.getElementById("inputECole").value!=""){         
              var dataString="matricula="+document.getElementById("ninoSelectEditar").value+
                                    "&nombre="+document.getElementById("inputENombreNino").value+
                                    "&apaterno="+document.getElementById("inputEApaternoNino").value+
                                    "&amaterno="+document.getElementById("inputEAmaternoNino").value+
                                    "&fn="+document.getElementById("inputEfnNino").value+
                                    "&fi="+document.getElementById("inputEfiNino").value+
                                    "&fe="+document.getElementById("inputEfeNino").value+
                                    "&colegiatura="+document.getElementById("inputECole").value+
                                    "&idtut="+document.getElementById("tutorESelect").value+                                                     
                                    "&update="; 
                                  alert(document.getElementById("tutorESelect").value);
                  $.ajax({
                        type: "POST",
                        url: "./php/updateNino.php",
                        data: dataString,
                        crossDomain: true,
                        cache: false,
                        success: function(response) {
                          alert(response);
                           alert("EXITO AJAX: insertNino");
                           getAllNinos();   
                           cargarSelectNinos();                    
                        },
                        error: function() {
                            alert("ERROR AJAX: insertNino");
                        }
                   });
      }else{
        alert("Datos NULOS o INCORRECTOS en el NIÑO");        
      }
  }  

//DELETE TUTOR
    function deleteTutor() {
      $.ajax({
            type: "POST",
            url: "./php/deleteTutor.php",
            data: "",
            crossDomain: true,
            cache: false,
            success: function(response) {
              alert(response);
               alert("EXITO AJAX: deleteTutor")
            },
            error: function() {
                alert("ERROR AJAX: deleteTutor");
            }
       }); 
  }       

/**********************************************************************************/
/*     COMEDOR     */
/**********************************************************************************/
function tablaDeMenusComedor(){
  //alert ("tablaDeMenusComedor()");
  var dataString= "IDNINO="+document.getElementById("ninosRespon").value+
          "&TIPO="+document.getElementById("input_tipo2").value+
          "&busqueda=";
  alert ("idNino: "+dataString);
  $.ajax({
    type: "POST",
    url: "./php/comedor_tabla_menus.php",
    data: dataString,
    crossDomain: true,
    cache: false,
    success: function(response) {
      alert ("RESPONSE 1: "+response);
      document.getElementById("div_tabla_comedor_menus").innerHTML=response;
    },
    error: function() {
      alert("ERROR tablaDeMenusComedor");
    }
  });
}

function comprarMenu(id){
  //alert ("comprarMenu(id)");
  var dataString= "IDM="+id+
          "&IDNINO="+document.getElementById("ninosRespon").value+
          "&insert=";         
  alert ("DATA: "+dataString);
  
  $.ajax({
    type: "POST",
    url: "./php/comedor_agregar_dieta.php",
    data: dataString,
    crossDomain: true,
    cache: false,
    success: function(response) {
      alert ("RESPONSE 2: "+response);
      alert ("Se agrego menu a la dieta");
      tablaHistorialConsumo();
    },
    error: function() {
      alert("ERROR comprarMenu");
    }
  })
}

function tablaHistorialConsumo(){
  //alert ("tablaHistorialConsumo");
  var dataString= "IDNINO="+document.getElementById("ninosRespon").value+
          "&busqueda=";
  $.ajax({
    type: "POST",
    url: "./php/comedor_tabla_historial.php",
    data: dataString,
    crossDomain: true,
    cache: false,
    success: function(response) {
      alert ("RESPONSE 3: "+response);
      document.getElementById("div_tabla_historial_consumo").innerHTML=response;
    },
    error: function() {
      alert("ERROR tablaHistorialConsumo");
    }
  })  
}

/**********************************************************************************/
/*     MENUS     */
/**********************************************************************************/
function tablaDeMenus() {
  //alert ("tablaDeMenus");
  $.ajax({
    type: "POST",
    url: "./php/menus_tabla.php",
    data: "",
    crossDomain: true,
    cache: false,
    success: function(response) {
//      alert ("RESPONSE 4: "+response);
      document.getElementById("div_tabla_menus").innerHTML=response;
    },
    error: function() {
      alert("ERROR tablaDemenus");
    }
  });
}

function agregarMenu() {
  //alert ("agregarmenu");
  if(document.getElementById("input_precio").value!=""){
    //cargarDepartamentos();***** CARGAR DEPTOS ANTES QUE TODO
    var dataString= "tipo="+document.getElementById("input_tipo").value+
            "&precio="+document.getElementById("input_precio").value+
            "&insert=";
    $.ajax({
      type: "POST",
      url: "./php/menus_agregar.php",
      data: dataString,
      crossDomain: true,
      cache: false,
      success: function(response) {
        //alert ("RESPONSE 5: "+response);
        alert(response);
        tablaDeMenus();
      },
      error: function() {
        alert("ERROR AL INSERTAR");
      }
    });
  }else{
    alert("ERROR: Campo Vacio");
  }
}

function tablaDeMenuPlatillo(id) {
  var dataString= "IDM="+id+"&insert=";
  $.ajax({
    type: "POST",
    url: "./php/menus_tabla_menuplatillo.php",
    data: dataString,
    crossDomain: true,
    cache: false,
    success: function(response) {
//      alert ("RESPONSE 6: "+response);
      document.getElementById("div_tab_plati").innerHTML=response;
    },
    error: function() {
      alert("ERROR tablaDeplatillos");
    }
  });
}

function agre_plati() {
  //alert ("agre_ingre"); 
  var dataString= "IDM="+document.getElementById("set_id_menu").value+
          "&IDP="+document.getElementById("select_platillo").value+
          "&insert=";
  //alert ("DT: "+dataString);

  $.ajax({
    type: "POST",
    url: "./php/menu_agre_plati.php",
    data: dataString,
    crossDomain: true,
    cache: false,
    success: function(response) {
      //alert ("RESPONSE 7: "+response);
      alert ("Platillo agregado al menú.");
      // agregar ejecucion de tabla de recetas
      tablaDeMenuPlatillo(document.getElementById("set_id_menu").value);
      /************************************/
    },
    error: function() {
      alert("ERROR AL INSERTAR");
    }
  });
}

function cargarSelectPlatillos() {
  //alert ("cargando");
  $.ajax({
    type: "POST",
    url: "./php/menus_cargarSelect.php",
    data: "",
    crossDomain: true,
    cache: false,
    success: function(response) {
//      alert ("RESPONSE 8: "+response);
      document.getElementById("select_platillo").innerHTML =response;
    },
    error: function() {
      alert("ERROR AJAX: cargarSelectIngredintes");
    }
  });
}

function eliminarMenu(id) { 
  alert ("Se eliminará el siguiente registro: "+id);
  var dataString="ID="+id+"&delete=";
  $.ajax({
    type: "POST",
    url: "./php/menus_eliminar.php",
    data: dataString,
    crossDomain: true,
    cache: false,
    success: function(response) {
      alert ("RESPONSE 9: "+response);
      //alert("EXITO al eliminar menú.");
      tablaDeMenus();
    },
    error: function() {
      alert("ERROR AL eliminarmenu");
    }
  });
}

function modificarMenu(id) {  
  alert ("Registro: "+id);
}

function seleccionarMenu(id){
  //alert ("ID:"+id);
  document.getElementById("set_id_menu").value = id;
  tablaDeMenuPlatillo(id);
}




/**********************************************************************************/
/*     PLATILLOS     */
/**********************************************************************************/
function tablaDePlatillos() {
  $.ajax({
    type: "POST",
    url: "./php/platillos_tabla.php",
    data: "",
    crossDomain: true,
    cache: false,
    success: function(response) {
//      alert ("RESPONSE 10: "+response);
      document.getElementById("div_tabla_platillos").innerHTML=response;
    },
    error: function() {
      alert("ERROR tablaDeplatillos");
    }
  });
}

function tablaDeRecetas(id) {
  var dataString= "IDP="+id+"&insert=";
  $.ajax({
    type: "POST",
    url: "./php/platillos_tabla_recetas.php",
    data: dataString,
    crossDomain: true,
    cache: false,
    success: function(response) {
//      alert ("RESPONSE 11: "+response);
      document.getElementById("div_tab_ingre").innerHTML=response;
    },
    error: function() {
      alert("ERROR tablaDeplatillos");
    }
  });
}

function cargarSelectIngredintes() {
  //alert ("cargando");
  $.ajax({
    type: "POST",
    url: "./php/platillos_cargarSelect.php",
    data: "",
    crossDomain: true,
    cache: false,
    success: function(response) {
//      alert ("RESPONSE 12: "+response);
      document.getElementById("select_ingrediente").innerHTML =response;
    },
    error: function() {
      alert("ERROR AJAX: cargarSelectIngredintes");
    }
  });
}

function agregarPlatillo() {
  //alert ("agregarplatillo");
  if(document.getElementById("input_Nombre").value!=""){
    //cargarDepartamentos();***** CARGAR DEPTOS ANTES QUE TODO
    var dataString="nombre="+document.getElementById("input_Nombre").value+
            "&insert=";
    $.ajax({
      type: "POST",
      url: "./php/platillos_agregar.php",
      data: dataString,
      crossDomain: true,
      cache: false,
      success: function(response) {
        alert ("RESPONSE 13: "+response);
        //alert("EXITO AL INSERTAR");
        tablaDePlatillos();
        cargarSelectPlatillos();
        document.getElementById("input_Nombre").value="";
      },
      error: function() {
        alert("ERROR AL INSERTAR");
      }
    });
  }else{
    alert("ERROR: Campo Vacio");
  }
}

function agre_ingre() {
  //alert ("agre_ingre"); 
  var dataString= "IDP="+document.getElementById("set_id_paltillo").value+
          "&IDI="+document.getElementById("select_ingrediente").value+
          "&insert=";
  //alert ("DT: "+dataString);

  $.ajax({
    type: "POST",
    url: "./php/platillos_agre_ingre.php",
    data: dataString,
    crossDomain: true,
    cache: false,
    success: function(response) {
      //alert ("RESPONSE 14: "+response);
      // agregar ejecucion de tabla de recetas
      tablaDeRecetas(document.getElementById("set_id_paltillo").value);
    },
    error: function() {
      alert("ERROR AL INSERTAR");
    }
  });
}

function eliminarPlatillo(id) { 
  alert ("Se eliminará el siguiente registro: "+id);
  var dataString="ID="+id+"&delete=";
  $.ajax({
    type: "POST",
    url: "./php/platillos_eliminar.php",
    data: dataString,
    crossDomain: true,
    cache: false,
    success: function(response) {
      alert ("RESPONSE 15: "+response);
      //alert("EXITO AL eliminarplatilloplatillo");
      tablaDePlatillos();
    },
    error: function() {
      alert("ERROR AL eliminarplatillo");
    }
  });
}

function modificarPlatillo(id){
  alert ("ID:"+id);
}

function seleccionarPlatillo(id){
  //alert ("ID:"+id);
  document.getElementById("set_id_paltillo").value = id;
  tablaDeRecetas(id);
}


/**********************************************************************************/
/*     INGREDIENTES     */
/**********************************************************************************/
function tablaDeIngredientes() {
  $.ajax({
    type: "POST",
    url: "./php/ingredientes_tabla.php",
    data: "",
    crossDomain: true,
    cache: false,
    success: function(response) {
//      alert ("RESPONSE 16: "+response);
      document.getElementById("div_tabla_ingredientes").innerHTML=response;
    },
    error: function() {
      alert("ERROR tablaDeIngredientes");
    }
  });
}

function agregarIngrediente() {
  //alert ("agregarIngrediente");
  if(document.getElementById("inputNombre").value!=""){
    //cargarDepartamentos();***** CARGAR DEPTOS ANTES QUE TODO
    var dataString="nombre="+document.getElementById("inputNombre").value+
    "&insert=";
    $.ajax({
      type: "POST",
      url: "./php/ingredientes_agregar.php",
      data: dataString,
      crossDomain: true,
      cache: false,
      success: function(response) {
        alert ("RESPONSE 17: "+response);
        //alert("EXITO AL INSERTAR");
        tablaDeIngredientes();
        document.getElementById("inputNombre").value="";
        cargarSelectIngredintes();

      },
      error: function() {
        alert("ERROR AL INSERTAR");
      }
    });
  }else{
    alert("ERROR: Campo Vacio");
  }
}       

function eliminarIngrediente(id) {  
  alert ("Se eliminará el siguiente registro: "+id);
  var dataString="ID="+id+"&delete=";
  $.ajax({
    type: "POST",
    url: "./php/ingredientes_eliminar.php",
    data: dataString,
    crossDomain: true,
    cache: false,
    success: function(response) {
      alert ("RESPONSE 18: "+response);
      //alert("EXITO AL eliminarIngredienteIngrediente");
      tablaDeIngredientes();
    },
    error: function() {
      alert("ERROR AL eliminarIngrediente");
    }
  });
}

function modificarIngrediente(id){
  alert ("ID: "+id);
}

