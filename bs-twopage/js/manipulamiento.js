    function irRegistro(){
      document.getElementById("DIVREGISTRONINO").style.display = "inline";
      document.getElementById("divTablaNinos").style.display = "none";  
      document.getElementById("divResponsables").style.display = "none";     
    }

    /*function desplegarTextArea(){            
      $('#textareaDeptos').val(':D\nfsaf\n\nasjfhashfasf');
    }*/

    /*function musica(){
      var playing = false;
          $(this).toggleClass("down");

          if (playing == false) {
              document.getElementById('player').play();
              playing = true;
              $(this).text("Parar Sonido");

          } else {
              document.getElementById('player').pause();
              playing = false;
              $(this).text("Reiniciar Sonido");
          }
    }
   
    function mostrarAgregarDepto(){
        document.getElementById("divMostrarAgregarDepto").style.display = "inline";
        document.getElementById("divMostrarEliminarDepto").style.display = "none";
        document.getElementById("divMostrarEditarDepto").style.display = "none";

    }
    function mostrarEditarDepto(){
        document.getElementById("divMostrarEditarDepto").style.display = "inline";
        document.getElementById("divMostrarEliminarDepto").style.display = "none";
        document.getElementById("divMostrarAgregarDepto").style.display = "none";        
    }
    function mostrarEliminarDepto(){
        document.getElementById("divMostrarEliminarDepto").style.display = "inline";
        document.getElementById("divMostrarAgregarDepto").style.display = "none";
        document.getElementById("divMostrarEditarDepto").style.display = "none";
    }
    function mostrarHorarios(){
        //var nombreEmpleado = document.getElementById("nombredeusuario").value;
        //var nombreEmpleado = document.getElementById("nombredeusuario").value;
        document.getElementById("divEMPLEADOSHORARIOS").style.display = "inline";       
        getUsuario();
       // document.getElementById("EtiquetaNombreEmpleado").innerHTML=nombreEmpleado;
        //document.getElementById("EtiquetaApellidoEmpleado").innerHTML=nombreEmpleado;
    }
    
    /*function cambiarHorario() {
     var horario_Entrada=document.getElementById("horario_Entrada").value;
     var horario_Salida=document.getElementById("horario_Salida").value;

     var cadena="<label>HORARIO DE ENTRADA: "+horario_Entrada+" A.M. </label>".
          "<label>HORARIO DE SALIDA: "+horario_Salida+" P.M </label>";

   
                document.getElementById("div_horarios").innerHTML =cadena;                                               
                
  }*/

  //OBTENER USUARIO
  /*function getUsuario() {
    //cargarDepartamentos();***** CARGAR DEPTOS ANTES QUE TODO
    var dataString="usuario="+document.getElementById("nombredeusuario").value+                                    
                   "&get=";                                        
        $.ajax({
              type: "POST",
              url: "http://pacifico.izt.uam.mx/~usermovil/vdb/getUsuario.php",
              data: dataString,
              crossDomain: true,
              cache: false,
              success: function(response) {
                 document.getElementById("EtiquetaInfoEmpleado").innerHTML =response;
              },
              error: function() {
                  alert("ERROR AJAX POST GET USUARIO");
              }
         });  
  }  



