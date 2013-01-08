var rules_pedido={rules:{
                      "pedido[pedi_numero]":{required:true},
                      "pedido[pedi_fecha]":{required:true},
                      "pedido[pedi_usua_id]":{required:true},
                      "pedido[pedi_clie_cedula]":{required:true}                 
                     },
                     messages:{
                      "pedido[pedi_numero]":{required:"El numero es requerido"},
                      "pedido[pedi_fecha]":{required:"La fecha es requerida"}, 
                      "pedido[pedi_usua_id]":{required:"El vendedor es requerido"},
                      "pedido[pedi_clie_cedula]":{required:"El cliente es requerido"}                          
                     }}
                 
var reglas_agregar_insumo = {rules:{
                    "add_codigo":{required:true},
                    "add_nombre":{required:true},                    
                    "add_cantidad":{required:true, number:true},
                    "add_precio":{required:true, number:true},
                    "add_precio_sug":{required:true, number:true},
                    "add_iva":{required:true, number:true}                   
                    },
                    messages:{
                    "add_codigo":{required:"el codigo requerido"},
                    "add_nombre":{required:"el nombre es requerido"},                   
                    "add_cantidad":{required:"la cantidad es requerida", number:'el valor debe ser numerico'},
                    "add_precio":{required:"el precio es  requerido", number:'el valor debe ser numerico'},
                    "add_precio_sug":{required:"el precio es  requerido", number:'el valor debe ser numerico'},
                    "add_iva":{required:"el iva es requerido", number:'el valor debe ser numerico'}
                   }
                };     
                
var rules_estado={rules:{
                      "estado_estado":{required:true},
                      "estado_comentarios":{required:true}              
                     },
                     messages:{
                      "estado_estado":{required:"El estado es requerido"},
                      "estado_comentarios":{required:"Escriba unos comentarios"}                      
                     }} 
 $( function(){
     
 $("#selec_prioridad").change(function(e){
    if ($(this).val()=="A"){
        alerta("Por favor escriba unos comentarios indicando los motivos de ésta prioridad.");
    }
 });
     
 $( "#add_cedula" ).autocomplete({
 source: function( request, response ){
    data1='filtro[clie_cedula]='+request.term;    
    url= $("#url_completar_cliente").val();
    ajax_util(url, data1,'json', function(data){

        response( $.map( data.registros, function( item ) {

			return {
				label   : item.clie_cliente+'-'+ item.clie_negocio,
				value   : item.clie_cedula, 
                                nombre  : item.clie_cliente, 
                                cedula  : item.clie_cedula,                                 
                                negocio : item.clie_negocio, 
                                sucursal: item.clie_sucursal 
				}
		}));

    });
    
 },
 select: function( event, ui ) {
    fill_autocompletar_cliente(ui.item.cedula,ui.item.nombre,ui.item.negocio,ui.item.sucursal);
 },
 minLength: 2 
});

$( "#add_nombre" ).autocomplete({
 source: function( request, response ){
    data1='filtro[clie_cliente]='+request.term;    
    url= $("#url_completar_cliente").val();
    ajax_util(url, data1,'json', function(data){

        response( $.map( data.registros, function( item ) {

			return {
				label  : item.clie_cliente+'-'+ item.clie_negocio,
				value  : item.clie_cliente, 
                                nombre : item.clie_cliente, 
                                cedula : item.clie_cedula,                                 
                                negocio: item.clie_negocio,
                                sucursal: item.clie_sucursal                                 
				}
		}));

    });
    
 },
 select: function( event, ui ) {
    fill_autocompletar_cliente(ui.item.cedula,ui.item.nombre,ui.item.negocio,ui.item.sucursal);
 },
 minLength: 2 
});
$( "#add_negocio" ).autocomplete({
 source: function( request, response ){
    data1='filtro[clie_negocio]='+request.term;    
    url= $("#url_completar_cliente").val();
    ajax_util(url, data1,'json', function(data){

        response( $.map( data.registros, function( item ) {

			return {
				label  : item.clie_cliente+'-'+ item.clie_negocio,
				value  : item.clie_negocio, 
                                nombre : item.clie_cliente, 
                                cedula : item.clie_cedula,                                 
                                negocio: item.clie_negocio,
                                sucursal: item.clie_sucursal                                 
				}
		}));

    });
    
 },
 select: function( event, ui ) {
    fill_autocompletar_cliente(ui.item.cedula,ui.item.nombre,ui.item.negocio,ui.item.sucursal);
 },
 minLength: 2 
});
   
$( "#id_codigo_agregarp" ).autocomplete({
 source: function( request, response ){
    data1='filtro[inve_codigo]='+request.term;
    url= $("#url_completar_codigo_insumo").val();
    ajax_util(url, data1,'json', function(data){
        response( $.map( data.insumos, function( item ) {
			return {
				label    : item.inve_codigo+'-'+ item.inve_descripcion,
				value    : item.inve_codigo,                                
                                nombre   : item.inve_descripcion,
                                id       : item.inve_id,
                                precio   : item.inve_precio_con_iva ,
                                cantidad : item.inve_cantidad,
                                iva      : item.inve_porcentaje_iva
				}
		}));

    });    
 },
 select: function( event, ui ) {
    fill_autocompletar(ui.item.value,ui.item.nombre,ui.item.cantidad,ui.item.id ,ui.item.precio,ui.item.iva)
 },
 minLength: 2 
}); 

$( "#id_nombre_agregarp" ).autocomplete({
 source: function( request, response ){
    data1='filtro[inve_descripcion]='+request.term;
    url= $("#url_completar_codigo_insumo").val();
    ajax_util(url, data1,'json', function(data){
        response( $.map( data.insumos, function( item ) {
			return {
				label    : item.inve_codigo+'-'+ item.inve_descripcion,
				value    : item.inve_descripcion,                                
                                nombre   : item.inve_descripcion,
                                id       : item.inve_id,
                                precio   : item.inve_precio_con_iva,
                                cantidad : item.inve_cantidad,
                                codigo   : item.inve_codigo,
                                iva      : item.inve_porcentaje_iva
				}
		}));
    });    
 },
 select: function( event, ui ) {
    fill_autocompletar(ui.item.codigo,ui.item.nombre,ui.item.cantidad,ui.item.id ,ui.item.precio,ui.item.iva)
 },
 minLength: 2 
});

$("#enviar_producto").click( function(){
      p = valid_form("#form_agregar_producto_pedido",reglas_agregar_insumo );
      mostrar_tip();
      if(p){
           id_pro       = $("#id_pro_id_agregarp").val();
           cod_pro      = $("#id_codigo_agregarp").val();
           nombre_pro   = $("#id_nombre_agregarp").val();          
           cantidad     = $("#id_cantidad_agregarp").val();
           precio       = $("#id_precio_agregarp").val();
           precio_sug   = $("#id_precio_sug_agregarp").val();            
           iva          = $("#id_iva_agregarp").val();  
           fecha        = $("#id_fecha_agregarp").val();  
           porciva = iva;
           sub_total = cantidad*precio;
           total_iva=sub_total;
           total_sug = cantidad*precio_sug;
          if(iva !=""){
             iva = parseFloat(iva);
             total_iva  = sub_total ;
         }             
         precio_coniva = precio;         
            try{
           sub_total = sub_total.toFixed(3);
           total_sug = total_sug.toFixed(3);
           }catch(e){}           
           try{
           total_iva = total_iva.toFixed(3);
           }catch(e){}          
         iva = total_iva-sub_total                      
          agregar_fila(id_pro,cod_pro,nombre_pro,cantidad,precio,total_iva,sub_total,iva,precio_coniva,porciva,precio_sug,total_sug,fecha);
         $("#form_agregar_producto_pedido").each (function(){
             this.reset();
         });
          }

  });


$("#enviar_comentarios").click(function(e){
 submit_formui('',"#form_comentarios_pedido",null, function(j){        
        if(j.ret){          
            window.location.href="<?=site_url('pedidos/inicio/index')?>"
        }else{
             $.unblockUI();
             alerta(j.msg);
             }        
        });   
});

$("#enviar_estado").click(function(e){
 submit_formui('',"#form_estado_pedido",rules_estado, function(j){        
        if(j.ret){          
            window.location.href="<?=site_url('pedidos/inicio/index')?>"
        }else{
             $.unblockUI();
             alerta(j.msg);
             }        
        });   
});


 });//fin onready

function fill_autocompletar_cliente(cedula,nombre,negocio,sucursal){
$("#add_cedula").val(cedula);
$("#add_clie_cedula").val(cedula);
$("#add_nombre").val(nombre);
$("#add_negocio").val(negocio);
$("#add_clie_sucursal").val(sucursal);
}

function fill_autocompletar(codigo,nombre,cantidad,id_insumo,precioventa,iva){
    $("#id_codigo_agregarp").val(codigo);
    $("#id_nombre_agregarp").val(nombre);
    $("#id_precio_agregarp").val(precioventa);
    $("#id_precio_sug_agregarp").val(precioventa);
    //$("#id_cantidad_agregarp").val(cantidad);
    $("#id_pro_id_agregarp").val(id_insumo);
    $("#id_iva_agregarp").val(iva);    
}

function agregar_fila_producto(){
new_boxui('','#div_agregar_producto_pedido','Agregar producto',360,420);

}

function agregar_fila(id_pro,cod_pro,nombre_pro,cantidad,precio,total_iva,sub_total,iva,precio_coniva,porciva,precio_sug,total_sug,fecha){
    
    var id =$("#next").val();
    id = parseInt(id) +  1;

    var row = "<tr id='row"+id+"'>"+

                    '<td align="center">'+'<label for="cod_pro">'+cod_pro+'</label>'+
                    '<input type="hidden" name="cod_producto[]" value="'+cod_pro+'" />'+'</td>'+

                    '<td align="center">'+'<label for="nombre_pro">'+nombre_pro+'</label>'+
                    '<input type="hidden" name="nombre_pro[]" value="'+nombre_pro+'" />'+'</td>'+
                                      
                    '<td align="center">'+'<label for="cantidad">'+cantidad+'</label>'+
                    '<input type="hidden" name="cantidad[]" value="'+cantidad+'" />'+'</td>'+

                    '<td align="center">'+'<label for="costo">'+formatCurrency(precio)+'</label>'+
                    '<input type="hidden" name="precio[]" value="'+precio+'" /> '+
                    '<input type="hidden" name="prconi[]" value="'+precio_coniva+'" />' +'</td>'+
                   
                    '<td align="center">'+'<label for="presio_sug">'+formatCurrency(precio_sug)+'</label>'+
                    '<input type="hidden" name="precio_sug[]" value="'+precio_sug+'" /> '+
                   
                    '<input type="hidden" name="sub[]" value="'+sub_total+'" />'+

                   
                    '<input type="hidden" name="iva[]" value="'+iva+'" />'+
                    '<input type="hidden" name="porci[]" value="'+porciva+'" />'+
                    
                    '<td align="center">'+'<label for="total">'+formatCurrency(total_iva)+'</label>'+
                    '<input type="hidden" name="total[]" value="'+total_iva+'" />'+'</td>'+                   

                    '<td align="center">'+'<label for="total_sug">'+formatCurrency(total_sug)+'</label>'+
                    '<input type="hidden" name="t_sug[]" value="'+total_sug+'" />'+'</td>'+                   

                    '<td align="center">'+'<label for="fecha">'+fecha+'</label>'+
                    '<input type="hidden" name="fecha[]" value="'+fecha+'" />'+'</td>'+                   


                    '<td align="center">'+
                    '<a href="#" onClick=remove_item("#row' + id + '"); return false;"><img src="<?=base_url()?>/assets/images/remove.png" title="Eliminar Producto"/></a>'+
                    '</td></tr>';
                            
        $("#n_grid tbody").append(row);

         $("#next").val( id + 2 );

        suma_totales();
         
}

function suma_totales(){
   suma_sub_total = 0;
   suma_total_iva = 0;
   suma_total     = 0;
   suma_total_sug = 0;        
   
   $('input[name*="sub[]"]').each( function(){
          valor = $(this).val();
          valor = parseFloat(valor);

          suma_sub_total += valor;
         });

    $('input[name*="iva[]"]').each( function(){
          valor = $(this).val();
          valor = parseFloat(valor);

          suma_total_iva += valor;
         });

     $('input[name*="total[]"]').each( function(){
          valor = $(this).val();
          valor = parseFloat(valor);

          suma_total += valor;
         });
         
         $('input[name*="t_sug[]"]').each( function(){
          valor = $(this).val();
          valor = parseFloat(valor);

          suma_total_sug += valor;
         });

    
        try{
         suma_sub_total = suma_sub_total.toFixed(3);        
        }catch(e){ }
        
         try{                         
           suma_total_iva = suma_total_iva.toFixed(3);
          }catch(e){ }

        try{
         suma_total     = suma_total.toFixed(3);
         suma_total_sug = suma_total_sug.toFixed(3);
        }catch(e){ }
          
        
   $("#thsuma_total").text(formatCurrency(suma_total));
   $("#thsuma_total_sug").text(formatCurrency(suma_total_sug));
   
}

function remove_item(id){
     $(id).remove();
     suma_totales();
}

function guardar_pedido(){
  submit_formui('',"#form_nuevo_pedido", rules_pedido, function(j){
        
        if(j.ret){
          $('[id^=row]').each( function(){
         $(this).remove();
         });
             suma_totales();
             $.unblockUI(); 
        }else{
             $.unblockUI();
             alerta(j.msg);
             }
        
        } );
}

function guardar_pedido_editar(reload){
  submit_formui('',"#form_nuevo_pedido", rules_pedido, function(j){
        
        if(j.ret){
             if(reload)location.reload();
             $.unblockUI();       
        }else{
             $.unblockUI();
             alerta(j.msg);
             }
        
        } , 'NO');
}

function imprimir_pedido(pedi_id){ 
window.open('index.php?/pedidos/inicio/impresion/'+pedi_id,'_blank', 'width=900,height=600');return false;    
}

function eliminar_pedido(pedi_id,total1,total_sugerido1,total_cantidad1){
  confirmar("Realmente desea eliminar éste pedido?", function(){ 
  data1='pedi_id='+pedi_id;
  url= $("#url_eliminar_pedido").val();
  $.blockUI({message: '<h1>Eliminando pedido...</h1>'});
  ajax_util(url, data1,'json', function(j){
     if(j.ret){
      $("#rowped"+pedi_id).remove();   
      total            = $("#total").val();
      total_sugerido   = $("#total_sugerido").val();
      total_cantidad   = $("#total_cantidad").val();
      total            = parseFloat(total);
      total_sugerido   = parseFloat(total_sugerido);
      total_cantidad   = parseFloat(total_cantidad);
      
      total1           = parseFloat(total1);
      total_sugerido1  = parseFloat(total_sugerido1);
      total_cantidad1 = parseFloat(total_cantidad1);

      total          = total-total1;
      total_sugerido = total_sugerido-total_sugerido1;
      total_cantidad = total_cantidad-total_cantidad1;
      
      
      $("#total").val(total);
      $("#total_sugerido").val(total_sugerido);
      $("#total_cantidad").val(total_cantidad);
      
      $("#thtotal").text(formatCurrency(total));
      $("#thtotal_sugerido").text(formatCurrency(total_sugerido));
      $("#thtotal_cantidad").text(formatCurrency(total_cantidad));      

      $.unblockUI();   
      alerta(j.msg);   
     }else{
     $.unblockUI();
     alerta(j.msg); 
     }  
    });   
  
  }); 
   
}

function buscar_pedido(){
new_boxui('','#div_buscar_pedido','Buscar Pedido',340,490);
}

function enviar_pedido(pedi_id,usua_id,estado,esta_en){
$("#comen_usua_id").val(usua_id);
$("#comen_pedi_id").val(pedi_id);
$("#comen_estado").val(estado);
$("#comen_esta_en").val(esta_en);
new_boxui('','#div_comentarios_pedido','Comentarios',490,160); 
}

function estado_pedido_general(pedi_id,usua_id){
$("#estado_usua_id").val(usua_id);
$("#estado_pedi_id").val(pedi_id);    
new_boxui('','#div_estado_pedido','Estado del pedido',490,180); 
}

function enviar_pedido_general(pedi_id,usua_id,estado,esta_en,enviar_a){
/**
confirmar('Realmente desea enviar el pedido a '+enviar_a+'?', function(){
urlp = $("#url_enviar_pedido_general").val();  
   data = 'usua_id='+usua_id+'&pedi_id='+pedi_id+'&estado='+estado+'&esta_en='+esta_en+'&enviado_a='+enviar_a;
   $.blockUI({message: '<h1> Espere por favor...</h1>'});
   ajax_util(urlp,data,'json',function(j){
      if(j.ret){          
            window.location.href="<?=site_url('pedidos/inicio/index')?>"
        }else{
             $.unblockUI();
             alerta(j.msg);
             }    
   });    
});    
*/

$('<div><b>'+'<textarea  id="ee_comentarios" name="comen_comentarios" placeholder="Comentarios" cols="69" rows="3" ></textarea> '+'</b></div>').dialog({title:'Comentarios' ,modal:true,height: 180 , width:550,
                show: 'fade', hide: 'fade' ,
                buttons: {
		       	Ok: function() {
                          $(this).dialog('close');
                          urlp = $("#url_enviar_pedido_general").val();  
                          data = 'usua_id='+usua_id+'&pedi_id='+pedi_id+'&estado='+estado+'&esta_en='+esta_en+'&enviado_a='+enviar_a+'&comentarios='+$("#ee_comentarios").val();
                          $.blockUI({message: '<h1> Espere por favor...</h1>'});
                          ajax_util(urlp,data,'json',function(j){
                          if(j.ret){          
                          window.location.href="<?=site_url('pedidos/inicio/index')?>"
                          }else{
                          $.unblockUI();
                          alerta(j.msg);
                          }    
                          });    
                        },
                        Cancelar: function() {$( this ).dialog( "close" );}
		                     }
                });  
}

function mostrar_estados(pedi_id){
 urlp = $("#url_estados_pedido").val();  
                          data = 'pedi_id='+pedi_id;                          
                          ajax_util(urlp,data,null,function(j){                         
                          new_boxui('',j, 'Historial de estados', 900, 300);                    
                          });    
}