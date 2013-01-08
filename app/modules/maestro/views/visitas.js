$( function(){

    var reglas_visita = {rules:{
                "visitas[tvis_codigo]":{required:true},
                "visitas[tvis_nombre]":{required:true}
                
             
                },
                messages:{
                "visitas[tvis_codigo]":{required:"Digite el codigo"},
                "visitas[tvis_nombre]":{required:"Digite el nombre"}
                
                }
            };

    $(function (){
    var pickerOpts={
    dateFormat:"yy/mm/dd",
    dayNamesMin: ["Do","Lu","Ma","Mi","Ju","Vi","Sa"],
    monthNames: ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"]
    };
    $(".datepicker").datepicker(pickerOpts)
    });


    $("#btnguardar_visita").click(function(e){
    
    submit_formui(e,"#form_nueva_visita" , reglas_visita,
    function(j){
           if(j.ret)
            {
               $("#div_nueva_visita").dialog("close");          
               add_fill_visita(j.tvis_codigo,j.tvis_nombre,j.tvis_estado,j.tvis_id);
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

    $("#btnedit_visita").click(function(e){

    submit_formui(e,"#form_edit_visita" , reglas_visita,
    function(j){
           if(j.ret)
            {
              $("#div_edit_visita").dialog("close");      
              edit_fill_visita(j.tvis_codigo,j.tvis_nombre,j.tvis_estado,j.tvis_id);
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

    });//fin on ready


    function nueva_visita(){
    new_boxui('','#div_nueva_visita','Nueva visita',320,200);
    }

    function edit_visit(tvis_codigo,tvis_nombre,tvis_estado,tvis_id)
    {
        $("#txtid_edit_visita").val(tvis_id);
        $("#txtcodigo_edit_visita").val(tvis_codigo);
        $("#txtnombre_edit_visita").val(tvis_nombre);
        $("#selectestado_edit_visita").val(tvis_estado);

        new_boxui('','#div_edit_visita','Editar visita',320,200);
    }

    function buscar_visita(){

    new_boxui('','#div_buscar_visita','Buscar visita',320,200);

    }
    
    function  add_fill_visita(tvis_codigo,tvis_nombre,tvis_estado,tvis_id)
    {        
       var row = "<tr id='rowclie"+tvis_id+"'>"+
                      '<td id="tdvisit_cod'+tvis_id+'" align="center">'+
                         '<label  for="cod_visit">'+tvis_codigo+'</label>'+
                      '</td>'+
                      
                       '<td id="tdvisit_nom'+tvis_id+'" align="center">'+
                         '<label  for="nom_visit">'+tvis_nombre+'</label>'+
                      '</td>'+ 
                                                                                                                              
                       '<td id="tdvisit_estado'+tvis_id+'" align="center">'+
                         '<label  for="estado_visit" style="color:green">'+'Activo'+'</label>'+
                      '</td>'+ 
                                              
                      '<td  id="tdvisit_edit'+tvis_id+'" align="center">'+
                      "<a href='#' onClick='edit_visit(\""+tvis_codigo+"\",\""+tvis_nombre+"\",\""+'A'+"\",\""+tvis_id+"\"); return false;'><img src='<?=base_url()?>/assets/images/edit.png' title='Editar'/></a>"+
                    '</td>'+'<tr>';
          $("#n_grid tbody").append(row);
                   
    }
   
   function  edit_fill_visita(tvis_codigo,tvis_nombre,tvis_estado,tvis_id)
   {
       est= (tvis_estado=='A')?'Activo':'Inactivo';
       
       str_estado = '<label for="estado_visit">'+est+'</label>';
               
       str_edit =  "<a href='#' onClick='edit_visit(\""+tvis_codigo+"\",\""+tvis_nombre+"\",\""+tvis_estado+"\",\""+tvis_id+"\"); return false;'><img src='<?=base_url()?>/assets/images/edit.png' title='Editar visita'/></a>";
                    
       $("#tdvisit_cod"+tvis_id).html('<label  for="cod_visit">'+tvis_codigo+'</label>');    
       $("#tdvisit_nom"+tvis_id).html('<label  for="nom_visit">'+tvis_nombre+'</label>');    
       if(tvis_estado=='A'){
             $("#tdvisit_estado"+tvis_id).html('<label  for="estado_visit" style="color:green">'+str_estado+'</label>');    
       }else if(tvis_estado='I'){
             $("#tdvisit_estado"+tvis_id).html('<label  for="estado_visit" style="color:red">'+str_estado+'</label>');    
       }
     
       $("#tdvisit_edit"+tvis_id).html(str_edit);   
   }