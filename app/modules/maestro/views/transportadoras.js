 $( function(){

    var reglas_transportadoras = {rules:{
                        "transportadoras[tran_codigo]":{required:true},
                        "transportadoras[tran_nombre]":{required:true}
                       },
                        messages:{
                        "transportadoras[tran_codigo]":{required:"Digite un codigo"},
                        "transportadoras[tran_nombre]":{required:"Digite un nombre"}
                        }
                    };


    $("#btnguardar_transportadora").click(function(e){

        submit_formui(e,"#form_nueva_transportadora" , reglas_transportadoras,
       function(j){
           if(j.ret)
            {
               $("#div_nueva_transportadora").dialog("close");          
               add_fill_transportadora(j.tran_codigo,j.tran_nombre,j.tran_estado, j.tran_id);
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

    $("#btneditar_transportadora").click(function(e){

       submit_formui(e,"#form_editar_transportadora" , reglas_transportadoras,
       function(j){
          if(j.ret)
            {
               $("#div_editar_transportadora").dialog("close");          
               edit_fill_transportadora(j.tran_codigo,j.tran_nombre, j.tran_estado ,j.tran_id);
               $.unblockUI();
            }else { $.unblockUI(); alerta(j.msg); }
       }
        );
        mostrar_tip();
    });

    });//fin de la funcion principal


    function nueva_transportadora(){
       new_boxui('','#div_nueva_transportadora','Nueva transportadora',320,200);
    }

    function editar_transportadora(codigo,nombre,estado,id)
    {
        $("#txtcodigo_editar_transportadora").val(codigo);
        $("#txtnombre_editar_transportadora").val(nombre);
        $("#selectestado_editar_transportadora").val(estado);
        $("#txtid_editar_transportadora").val(id);

        new_boxui('','#div_editar_transportadora','Editar transportadora',320,200);

    }

    function buscar_transportadora(){

     new_boxui('','#div_buscar_transportadora','Buscar transportadora',320,200);

    }
    
    function  add_fill_transportadora(codigo,nombre,estado,tran_id)
    {
         var row = "<tr id='rowtran"+tran_id+"'>"+
                      '<td id="tdtran_cod'+tran_id+'" align="center">'+
                         '<label  for="cod_tran">'+codigo+'</label>'+
                      '</td>'+
                      
                       '<td id="tdtran_nom'+tran_id+'" align="center">'+
                         '<label  for="nom_tran">'+nombre+'</label>'+
                      '</td>'+
                                            
                       '<td id="tdtran_estado'+tran_id+'" align="center">'+
                         '<label  for="estado_tran"  style="color:green>'+'Activo'+'</label>'+
                      '</td>'+
                                                                 
                      '<td  id="tdtran_edit'+tran_id+'" align="center">'+
                      "<a href='#' onClick='editar_transportadora(\""+codigo+"\",\""+nombre+"\",\""+'A'+"\",\""+tran_id+"\"); return false;'><img src='<?=base_url()?>/assets/images/edit.png' title='Editar transportadora'/></a>"+
                    '</td>'+'<tr>';
          $("#n_grid tbody").append(row);
        
        
    }
   function  edit_fill_transportadora(codigo,nombre,estado,tran_id)
   {
       est= (estado=='A')?'Activo':'Inactivo';
       
       str_estado = '<label for="estado_tran">'+est+'</label>';
      
       str_edit =  "<a href='#' onClick='editar_transportadora(\""+codigo+"\",\""+nombre+"\",\""+estado+"\",\""+tran_id+"\"); return false;'><img src='<?=base_url()?>/assets/images/edit.png' title='Editar transportadora'/></a>";
                    
       $("#tdtran_cod"+tran_id).html('<label  for="cod_tran">'+codigo+'</label>');    
       $("#tdtran_nom"+tran_id).html('<label  for="nom_tran">'+nombre+'</label>');    
       $("#tdtran_estado"+tran_id).html(str_estado);
       
        if(estado=='A'){
             $("#tdtran_estado"+tran_id).html('<label  for="estado_tran" style="color:green">'+str_estado+'</label>');    
       }else if(estado=='I'){
             $("#tdtran_estado"+tran_id).html('<label  for="estado_tran" style="color:red">'+str_estado+'</label>');    
       }
       
       $("#tdtran_edit"+tran_id).html(str_edit);
       
   }
                         