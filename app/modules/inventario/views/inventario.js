 $( function(){

    var reglas_producto = {rules:{
                "inventarios[inve_codigo]":{required:true},
                "inventarios[inve_descripcion]":{required:true},
                "inventarios[inve_cantidad]":{required:true,number:true},
                "inventarios[inve_precio_con_iva]":{required:true,number:true},
                "inventarios[inve_porcentaje_iva]":{required:true,number:true},
                "inventarios[inve_descuento]":{required:true,number:true}
               
                },
                messages:{
                "inventarios[inve_codigo]":{required:"Digite el codigo"},
                "inventarios[inve_descripcion]":{required:"Digite la descripcion"},
                "inventarios[inve_cantidad]":{required:'Cantiad requerida', number:'Digite un numero'}, 
                "inventarios[inve_precio_con_iva]":{required:'Precio requerido', number:'Digite un numero'},
                "inventarios[inve_porcentaje_iva]":{required:'Porcentaje requerido', number:'Digite un numero'} ,
                "inventarios[inve_descuento]":{required:'Descuento requerido', number:'Digite un numero'}
         
                 
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

                        
  $("#btnbuscar_inveprod").click(function(e){
     $("#div_buscar_producto").dialog("close");      
     $.blockUI({message: '<h1> Espere por favor...</h1>'});
    
  });
   
  $("#btnguardar_producto").click(function(e){
   
    submit_formui(e,"#form_nuevo_producto" , reglas_producto,
    function(j){
           if(j.ret)
            {
               $("#div_nuevo_producto").dialog("close");          
               add_fill_producto(j.inve_codigo,j.inve_descripcion,j.inve_cantidad,j.inve_precio_con_iva,j.inve_porcentaje_iva,j.inve_descuento,j.inve_bode_id,j.bode_nombre,j.inve_estado,j.inve_fecha,j.inve_tipo,j.inve_id);
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

    $("#btneditar_producto").click(function(e){

    submit_formui(e,"#form_editar_producto" , reglas_producto,
    function(j){
           if(j.ret)
            {
               $("#div_editar_producto").dialog("close");      
               edit_fill_producto(j.inve_codigo,j.inve_descripcion,j.inve_cantidad,j.inve_precio_con_iva,j.inve_porcentaje_iva,j.inve_descuento,j.inve_bode_id,j.bode_nombre,j.inve_estado,j.inve_fecha,j.inve_tipo,j.inve_id);
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


    function nuevo_producto(){
    new_boxui('','#div_nuevo_producto','Nuevo producto',360,420);
    }

    function editar_producto(inve_codigo,inve_descripcion,inve_cantidad,inve_precio_con_iva,inve_porcentaje_iva,inve_descuento,inve_bode_id,bode_name,inve_estado,inve_fecha,inve_tipo,inve_id)
    {      
      $("#txtid_editar_producto").val(inve_id);
      $("#txtbode_editar_producto").val(bode_name);
      $("#txtcod_edit_producto").val(inve_codigo);
      $("#txtdes_edit_producto").val(inve_descripcion);
      $("#txtcant_edit_producto").val(inve_cantidad);
      $("#txtprecio_edit_producto").val(inve_precio_con_iva);
      $("#txtporc_edit_producto").val(inve_porcentaje_iva);
      $("#txtdescu_edit_producto").val(inve_descuento);
      $("#txtbode_edit_producto" ).val(inve_bode_id);
      $("#selectestado_edit_producto" ).val(inve_estado);
      $("#selecttipo_edit_producto" ).val(inve_tipo);
   
      new_boxui('','#div_editar_producto','Editar producto',360,520);
    }

    function buscar_producto(){

    new_boxui('','#div_buscar_producto','Buscar producto',320,220);

    }
    
    function  add_fill_producto(inve_codigo,inve_descripcion,inve_cantidad,inve_precio_con_iva,inve_porcentaje_iva,inve_descuento,inve_bode_id,bode_nombre,inve_estado,inve_fecha,inve_tipo,inve_id)
    {        
       var total_row=0;
       var inv_tipo="";
       
       var id=$("#next").val();        
       id=parseInt(id)+1;
       
       total_row=(inve_precio_con_iva-inve_descuento)*inve_cantidad;

       inv_tipo=change_type(inve_tipo);
       
       var row = "<tr id='rowinv"+id+"'>"+
                      '<td id="tdinv_cod'+inve_id+'" align="center">'+
                         '<label  for="cod_inve">'+inve_codigo+'</label>'+
                         '<input type="hidden" id="txtrowid'+inve_id+'" value="'+id+'">'+
                      '</td>'+
                      
                       '<td id="tdinv_des'+inve_id+'" align="center">'+
                         '<label  for="des_inve">'+inve_descripcion+'</label>'+
                      '</td>'+ 
                      
                        '<td id="tdinv_cant'+inve_id+'" align="center">'+
                         '<label  for="cant_inve">'+formatCurrency(inve_cantidad)+'</label>'+
                      '</td>'+
                      
                      '<td id="tdinv_precio'+inve_id+'" align="center">'+
                         '<label  for="precio_inve">'+formatCurrency(inve_precio_con_iva)+'</label>'+
                      '</td>'+ 
                      
                       '<td id="tdinv_porc'+inve_id+'" align="center">'+
                         '<label  for="porc_inve">'+formatCurrency(inve_porcentaje_iva)+'</label>'+
                      '</td>'+ 
                      
                      '<td id="tdinv_descu'+inve_id+'" align="center">'+
                         '<label  for="descu_inve">'+formatCurrency(inve_descuento)+'</label>'+
                      '</td>'+ 
                      
                       '<td id="tdinv_total'+inve_id+'" align="center">'+
                         '<label  for="total_inve">'+formatCurrency(total_row)+'</label>'+
                         '<input type="hidden" name="total_producto[]" value="'+total_row+'" />'+
                      '</td>'+      
                      
                       '<td id="tdinv_bod'+inve_id+'" align="center">'+
                         '<label  for="bod_inve">'+bode_nombre+'</label>'+
                      '</td>'+
                      
                       '<td id="tdinv_estado'+inve_id+'" align="center">'+
                         '<label  for="estado_inve" style="color:green">'+'Activo'+'</label>'+
                      '</td>'+
                      
                      '<td id="tdinv_fecha'+inve_id+'" align="center">'+
                         '<label  for="fecha_inve">'+inve_fecha+'</label>'+
                      '</td>'+
                                                   
                      '<td id="tdinv_tipo'+inve_id+'" align="center">'+
                         '<label  for="tipo_inve">'+inv_tipo+'</label>'+
                      '</td>'+ 
                                              
                      '<td  id="tdinv_edit'+inve_id+'" align="center">'+
                      "<a href='#' onClick='editar_producto(\""+inve_codigo+"\",\""+inve_descripcion+"\",\""+inve_cantidad+"\",\""+inve_precio_con_iva+"\",\""+inve_porcentaje_iva+"\",\""+inve_descuento+"\",\""+inve_bode_id+"\",\""+bode_nombre+"\",\""+'A'+"\",\""+inve_fecha+"\",\""+inve_tipo+"\",\""+inve_id+"\"); return false;'><img src='<?=base_url()?>/assets/images/edit.png' title='Editar'/></a>"+
                      '</td>'+
                      
                      '<td  id="tdinv_delete'+inve_id+'" align="center">'+
                      "<img style=' cursor: pointer' onclick='eliminar_producto(\""+inve_id+"\",\""+inve_codigo+"\")' src='<?php echo base_url()?>assets/images/del-row.png' alt='Eliminar'/>"+
                      '</td>'
                      +'<tr>';
          $("#n_grid tbody").append(row);
          $("#next").val( id + 2 );

         suma_totales();
                          
    }
   
   function  edit_fill_producto(inve_codigo,inve_descripcion,inve_cantidad,inve_precio_con_iva,inve_porcentaje_iva,inve_descuento,inve_bode_id,bode_nombre,inve_estado,inve_fecha,inve_tipo,inve_id)
   {
       var total_row=0;
       var inv_tipo="";
       var txtrowid=0;
       
       txtrowid=$("#txtrowid"+inve_id).val();
       
       total_row=(inve_precio_con_iva-inve_descuento)*inve_cantidad;
                    
       inv_tipo=change_type(inve_tipo);
           
       est= (inve_estado=='A')?'Activo':'Inactivo';
       
       str_estado = '<label for="estado_inve">'+est+'</label>';
      
       str_edit =  "<a href='#' onClick='editar_producto(\""+inve_codigo+"\",\""+inve_descripcion+"\",\""+inve_cantidad+"\",\""+inve_precio_con_iva+"\",\""+inve_porcentaje_iva+"\",\""+inve_descuento+"\",\""+inve_bode_id+"\",\""+bode_nombre+"\",\""+inve_estado+"\",\""+inve_fecha+"\",\""+inve_tipo+"\",\""+inve_id+"\"); return false;'><img src='<?=base_url()?>/assets/images/edit.png' title='Editar'/></a>";
                    
       $("#tdinv_cod"+inve_id).html('<label  for="cod_inve">'+inve_codigo+'</label><input type="hidden" id="txtrowid'+inve_id+'"  value="'+txtrowid+'">');    
       $("#tdinv_des"+inve_id).html('<label  for="des_inve">'+inve_descripcion+'</label>');    
       $("#tdinv_cant"+inve_id).html('<label  for="cant_inve">'+formatCurrency(inve_cantidad)+'</label>');    
       $("#tdinv_precio"+inve_id).html('<label  for="precio_inve">'+formatCurrency(inve_precio_con_iva)+'</label>');    
       $("#tdinv_porc"+inve_id).html('<label  for="porc_inve">'+formatCurrency(inve_porcentaje_iva)+'</label>');    
       $("#tdinv_descu"+inve_id).html('<label  for="descu_inve">'+formatCurrency(inve_descuento)+'</label>');    
       $("#tdinv_total"+inve_id).html('<label  for="total_inve">'+formatCurrency(total_row)+'</label><input type="hidden" name=total_producto[]  value="'+total_row+'">');    
       
       $("#tdinv_bod"+inve_id).html('<label  for="bod_inve">'+bode_nombre+'</label>');  
      if(inve_estado=='A'){
             $("#tdinv_estado"+inve_id).html('<label  for="estado_inve" style="color:green">'+str_estado+'</label>');    
       }else if(inve_estado='I'){
             $("#tdinv_estado"+inve_id).html('<label  for="estado_inve" style="color:red">'+str_estado+'</label>');    
       } 
       $("#tdinv_fecha"+inve_id).html('<label  for="fecha_inve">'+inve_fecha+'</label>');    
       $("#tdinv_tipo"+inve_id).html('<label  for="tipo_inve">'+inv_tipo+'</label>');    
       $("#tdinv_edit"+inve_id).html(str_edit);   
       
       suma_totales();
        
   }
   
  function eliminar_producto(id,codigo)
  {
       
    var txtrowid=0;
    
    txtrowid=$("#txtrowid"+id).val();
    
    confirmar('Esta seguro que desea eliminar el producto  '+codigo+' ?',function(){
    
    urlp = $("#url_delete_producto").val();  
    data = 'id='+id;
    $.blockUI({message: '<h1> Espere por favor...</h1>'});
    ajax_util(urlp,data,'json',function(j){
    if(j.ret){
      $.unblockUI();
      alerta(j.msg, function(){
           $('#rowinv'+txtrowid).remove();  
           suma_totales();
        });
      
     }else{
     $.unblockUI(); 
     alerta(j.msg);
     }  
    });
   }); 
  }

  function imprimir_todas()
  {
    window.open('index.php?/inventario/inicio/imprimir_todas/','_blank', 'width=900,height=600');return false;    
  }
  
    
  function change_type(inve_tipo)
  {
       var inv_tipo='';
       
       if(inve_tipo=='F'){inv_tipo='Firme';}
       if(inve_tipo=='PV'){inv_tipo='Preventa';}
       if(inve_tipo=='PM'){inv_tipo='Promocion';}
       return inv_tipo;
  }
              
 function suma_totales()
 {
   total_suma = 0;
   
   $('input[name*="total_producto[]"]').each( function(){
          valor = $(this).val();
          valor = parseFloat(valor);
          total_suma += valor;
         });

        try{
         total_suma = total_suma.toFixed(2);        
        }catch(e){ }
              
   $("#thsumatotal").text(formatCurrency(total_suma));
 
}
             