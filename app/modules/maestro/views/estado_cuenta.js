$( function(){

    var reglas_estc = {rules:{
                "estados_cuenta[estc_clie_cedula]":{required:true},
                "estados_cuenta[estc_saldo]":{number:true, required:true},
                "estados_cuenta[estc_dias_vencimiento]":{number:true}
               },
                messages:{
                "estados_cuenta[estc_clie_cedula]":{required:"Digite la cedula"},
                "estados_cuenta[estc_saldo]":{number:"Digite un valor numerico", required:"Digite el saldo"},
                "estados_cuenta[estc_dias_vencimiento]":{number:"Digite un valor numerico"}
               }
            };

   
    $("#btnguardar_estc").click(function(e){
    
    submit_formui(e,"#form_new_estado_cuenta" , reglas_estc,
    function(j){
           if(j.ret)
            {
               $("#div_new_estado_cuenta").dialog("close");          
               add_fill_estc(j.estc_clie_cedula,j.clie_cliente,j.estc_tipo_documento,j.estc_factura,j.estc_fecha,j.estc_fecha_vencimiento,j.estc_dias_mora,j.estc_saldo,j.estc_fechasistema,j.estc_usua_id,j.estc_id);
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

    $("#btneditarestc").click(function(e){

    submit_formui(e,"#form_editar_estado_cuenta" , reglas_estc,
    function(j){
           if(j.ret)
            {
              $("#div_editar_estado_cuenta").dialog("close");      
              edit_fill_estc(j.estc_clie_cedula,j.clie_cliente,j.estc_tipo_documento,j.estc_factura,j.estc_fecha,j.estc_fecha_vencimiento,j.estc_dias_mora,j.estc_saldo,j.estc_fechasistema,j.estc_usua_id,j.estc_id);
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


    function nuevo_estado_cuenta(){
    new_boxui('','#div_new_estado_cuenta','Nueva cartera',360,400);
    }

    function editar_estc(estc_clie_cedula,clie_cliente,estc_tipo_documento,estc_factura,estc_fecha,estc_fecha_vencimiento,estc_dias_mora,estc_saldo,estc_fechasistema,estc_usua_id,estc_id)
    {
        $("#txtid_editar_estado_cuenta").val(estc_id);
        $("#txtestc_clie_cedula").val(estc_clie_cedula);
        $("#txtestc_tipo_doc").val(estc_tipo_documento);
        $("#txtestc_factura").val(estc_factura);
        $("#txtestc_fecha").val(estc_fecha);
        $("#txtestc_fechafin").val(estc_fecha_vencimiento);
        $("#txtestc_diasmora").val(estc_dias_mora);
        $("#txtestc_saldo").val(estc_saldo);
       
        new_boxui('','#div_editar_estado_cuenta','Editar cartera',360,400);
    }

    function buscar_estc(){

    new_boxui('','#div_search_estc','Buscar cartera',400,470);

    }
                                    
    function  add_fill_estc(estc_clie_cedula,clie_cliente,estc_tipo_documento,estc_factura,estc_fecha,estc_fecha_vencimiento,estc_dias_mora,estc_saldo,estc_fechasistema,estc_usua_id,estc_id)
    {        
       var new_name= '';
       
       if(clie_cliente==''){
           new_name='<label  for="nom_estc" style="color:red" >Pendiente</label>';
       }else{
            new_name='<label  for="nom_estc">'+clie_cliente+'</label>';
       }
                          
       var row = "<tr id='rowestc"+estc_id+"'>"+
                      '<td id="tdestc_ced'+estc_id+'" align="center">'+
                         '<label  for="cedula_estc">'+estc_clie_cedula+'</label>'+
                         '<input type="hidden" id="txtrow_estcid'+estc_id+'" value="'+estc_id+'"/>'+
                      '</td>'+
                       '<td id="tdestc_nom'+estc_id+'" align="center">'+ new_name+
                       
                      '</td>'+
                        '<td id="tdestc_tipodoc'+estc_id+'" align="center">'+
                         '<label  for="tipodoc_estc">'+estc_tipo_documento+'</label>'+
                      '</td>'+
                      
                       '<td id="tdestc_factura'+estc_id+'" align="center">'+
                         '<label  for="factura_estc">'+estc_factura+'</label>'+
                      '</td>'+ 
                      
                      '<td id="tdestc_fechini'+estc_id+'" align="center">'+
                         '<label  for="fechini_estc">'+estc_fecha+'</label>'+
                      '</td>'+
                      
                      '<td id="tdestc_fechfin'+estc_id+'" align="center">'+
                         '<label  for="fechfin_estc">'+estc_fecha_vencimiento+'</label>'+
                      '</td>'+
                      
                      '<td id="tdestc_mora'+estc_id+'" align="center">'+
                         '<label  for="mora_estc">'+estc_dias_mora+'</label>'+
                      '</td>'+
                                 
                      '<td id="tdestc_sald'+estc_id+'" align="center">'+
                         '<label  for="saldo_estc">'+formatCurrency(estc_saldo)+'</label>'+
                         '<input type="hidden" name="saldo_estc[]" value="'+estc_saldo+'" />'+
                      '</td>'+ 
                      '<td id="tdestc_fechactu'+estc_id+'" align="center">'+
                         '<label  for="fechactu_estc">'+estc_fechasistema+'</label>'+
                      '</td>'+ 
                                                                                   
                      '<td  id="tdestc_edit'+estc_id+'" align="center">'+
                      "<a href='#' onClick='editar_estc(\""+estc_clie_cedula+"\",\""+clie_cliente+"\",\""+estc_tipo_documento+"\",\""+estc_factura+"\",\""+estc_fecha+"\",\""+estc_fecha_vencimiento+"\",\""+estc_dias_mora+"\",\""+estc_saldo+"\",\""+estc_fechasistema+"\",\""+estc_usua_id+"\",\""+estc_id+"\"); return false;'><img src='<?=base_url()?>/assets/images/edit.png' title='Editar'/></a>"+
                      '</td>'+
                      
                      '<td  id="tdestc_delete'+estc_id+'" align="center">'+
                      "<img style=' cursor: pointer' onclick='eliminar_estc(\""+estc_id+"\")' src='<?php echo base_url()?>assets/images/del-row.png' alt='Eliminar'/>"+
                      '</td>'+
                  '<tr>';
          $("#n_grid tbody").append(row);
          suma_totales();
                   
    }
   
   function edit_fill_estc(estc_clie_cedula,clie_cliente,estc_tipo_documento,estc_factura,estc_fecha,estc_fecha_vencimiento,estc_dias_mora,estc_saldo,estc_fechasistema,estc_usua_id,estc_id)
   {
      var new_name= '';
    
      if(clie_cliente==''){
           new_name='<label  for="nom_estc" style="color:red" >Pendiente</label>';
       }else{
            new_name='<label  for="nom_estc">'+clie_cliente+'</label>';
       }
      str_edit =  "<a href='#' onClick='editar_estc(\""+estc_clie_cedula+"\",\""+clie_cliente+"\",\""+estc_tipo_documento+"\",\""+estc_factura+"\",\""+estc_fecha+"\",\""+estc_fecha_vencimiento+"\",\""+estc_dias_mora+"\",\""+estc_saldo+"\",\""+estc_fechasistema+"\",\""+estc_usua_id+"\",\""+estc_id+"\"); return false;'><img src='<?=base_url()?>/assets/images/edit.png' title='Editar'/></a>";
    
      $("#tdestc_ced"+estc_id).html('<label  for="cedula_estc">'+estc_clie_cedula+'</label><input type="hidden" id="txtrow_estcid'+estc_id+'"  value="'+estc_id+'">');    
      $("#tdestc_nom"+estc_id).html(new_name);    
      $("#tdestc_tipodoc"+estc_id).html('<label  for="tipodoc_estc">'+estc_tipo_documento+'</label>');    
      $("#tdestc_factura"+estc_id).html('<label  for="factura_estc">'+estc_factura+'</label>');    
      $("#tdestc_fechini"+estc_id).html('<label  for="fechini_estc">'+estc_fecha+'</label>');    
      $("#tdestc_fechfin"+estc_id).html('<label  for="fechfin_estc">'+estc_fecha_vencimiento+'</label>');    
      $("#tdestc_mora"+estc_id).html('<label  for="mora_estc">'+estc_dias_mora+'</label>');    
      $("#tdestc_sald"+estc_id).html('<label  for="saldo_estc">'+formatCurrency(estc_saldo)+'</label><input type="hidden" name=saldo_estc[]  value="'+estc_saldo+'">');    
      $("#tdestc_fechactu"+estc_id).html('<label  for="fechactu_estc">'+estc_fechasistema+'</label>');    
      $("#tdestc_edit"+estc_id).html(str_edit);   
      suma_totales();
   }
 function suma_totales()
 {
  total_suma = 0;
   
  $('input[name*="saldo_estc[]"]').each( function(){
          valor = $(this).val();
          valor = parseFloat(valor);
          total_suma += valor;
         });

        try{
         total_suma = total_suma.toFixed(2);        
        }catch(e){ }
  $("#thsumatotalestc").text(formatCurrency(total_suma));
 
 }
 function eliminar_estc(id){
 var txtrowid=0;
    
 txtrowid=$("#txtrow_estcid"+id).val();
    
 confirmar('Esta seguro que desea eliminar esta registro de cartera?',function(){
    
 urlp = $("#url_delete_estc").val();  
 data = 'id='+id;
 $.blockUI({message: '<h1> Espere por favor...</h1>'});
 ajax_util(urlp,data,'json',function(j){
    if(j.ret){
      $.unblockUI();
      alerta(j.msg, function(){
           $('#rowestc'+txtrowid).remove();  
           suma_totales();
        });
      
     }else{
     $.unblockUI(); 
     alerta(j.msg);
     }  
    });
   }); 
  }



