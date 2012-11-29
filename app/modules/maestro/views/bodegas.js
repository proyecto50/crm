    $( function(){

    var reglas_bodegas = {rules:{
                        "bodegas[bode_codigo]":{required:true},
                        "bodegas[bode_nombre]":{required:true}
                       },
                        messages:{
                        "bodegas[bode_codigo]":{required:"Digite un codigo"},
                        "bodegas[bode_nombre]":{required:"Digite un nombre"}
                        }
                    };


    $("#btnguardar_bodega").click(function(e){

        submit_formui(e,"#form_nueva_bodega" , reglas_bodegas,
       function(j){
           if(j.ret)
            {
               $("#div_nueva_bodega").dialog("close");          
               add_fill_bodega(j.bode_codigo,j.bode_nombre,j.bode_telefono,j.bode_direccion,j.bode_descripcion, j.bode_id);
               $.unblockUI();
            }else
                {
                  $.unblockUI();
                   alerta(j.msg);
                }
       }
        );
        mostrar_tip();
    });

    $("#btneditar_bodega").click(function(e){

       submit_formui(e,"#form_editar_bodega" , reglas_bodegas,
       function(j){
          if(j.ret)
            {
               $("#div_editar_bodega").dialog("close");          
               edit_fill_bodega(j.bode_codigo,j.bode_nombre,j.bode_telefono,j.bode_direccion,j.bode_descripcion, j.bode_estado ,j.bode_id);
               $.unblockUI();
            }else { $.unblockUI(); alerta(j.msg); }
       }
        );
        mostrar_tip();
    });

    });//fin de la funcion principal


    function nueva_bodega(){
       new_boxui('','#div_nueva_bodega','Nuevo bodega',320,340);
    }

    function editar_bodega(codigo,nombre,telefono,direccion,descripcion,estado,id)
    {
        $("#txtcodigo_editar_bodega").val(codigo);
        $("#txtnombre_editar_bodega").val(nombre);
        $("#txttelefono_editar_bodega").val(telefono);
        $("#txtdireccion_editar_bodega").val(direccion);
        $("#txtdescripcion_editar_bodega").val(descripcion);
        $("#selectestado_editar_bodega").val(estado);
        $("#txtid_editar_bodega").val(id);

        new_boxui('','#div_editar_bodega','Editar bodega',320,380);

    }

    function buscar_bodega(){

     new_boxui('','#div_buscar_bodega','Buscar bodega',320,220);

    }
    
    function  add_fill_bodega(codigo,nombre,telefono,direccion,descripcion,bode_id)
    {
         var row = "<tr id='rowbode"+bode_id+"'>"+
                      '<td id="tdbode_cod'+bode_id+'" align="center">'+
                         '<label  for="cod_bode">'+codigo+'</label>'+
                      '</td>'+
                      
                       '<td id="tdbode_nom'+bode_id+'" align="center">'+
                         '<label  for="nom_bode">'+nombre+'</label>'+
                      '</td>'+
                       
                        '<td id="tdbode_tel'+bode_id+'" align="center">'+
                         '<label  for="tel_bode">'+telefono+'</label>'+
                      '</td>'+
                      
                       '<td id="tdbode_dir'+bode_id+'" align="center">'+
                         '<label  for="dir_bode">'+direccion+'</label>'+
                      '</td>'+
                      
                       '<td id="tdbode_estado'+bode_id+'" align="center">'+
                         '<label  for="estado_bode">'+'Activo'+'</label>'+
                      '</td>'+
                      
                       '<td id="tdbode_desc'+bode_id+'" align="center">'+
                         '<label  for="desc_bode">'+descripcion+'</label>'+
                      '</td>'+
                                              
                      '<td  id="tdbode_edit'+bode_id+'" align="center">'+
                      "<a href='#' onClick='editar_bodega(\""+codigo+"\",\""+nombre+"\",\""+telefono+"\",\""+direccion+"\",\""+descripcion+"\",\""+'A'+"\",\""+bode_id+"\"); return false;'><img src='<?=base_url()?>/assets/images/edit.png' title='Editar bodega'/></a>"+
                    '</td>'+'<tr>';
          $("#n_grid tbody").append(row);
        
        
    }
   function  edit_fill_bodega(codigo,nombre,telefono,direccion,descripcion,estado,bode_id)
   {
       est= (estado=='A')?'Activo':'Inactivo';
       
       str_estado = '<label for="estado_bode">'+est+'</label>';
      
       str_edit =  "<a href='#' onClick='editar_bodega(\""+codigo+"\",\""+nombre+"\",\""+telefono+"\",\""+direccion+"\",\""+descripcion+"\",\""+estado+"\",\""+bode_id+"\"); return false;'><img src='<?=base_url()?>/assets/images/edit.png' title='Editar bodega'/></a>";
                    
       $("#tdbode_cod"+bode_id).html('<label  for="cod_bode">'+codigo+'</label>');    
       $("#tdbode_nom"+bode_id).html('<label  for="nom_bode">'+nombre+'</label>');    
       $("#tdbode_tel"+bode_id).html('<label  for="tel_bode">'+telefono+'</label>');    
       $("#tdbode_dir"+bode_id).html('<label  for="dir_bode">'+direccion+'</label>');    
       $("#tdbode_estado"+bode_id).html(str_estado);    
       $("#tdbode_desc"+bode_id).html('<label  for="desc_bode">'+descripcion+'</label>');    
       
       $("#tdbode_edit"+bode_id).html(str_edit);
       
   }
                         