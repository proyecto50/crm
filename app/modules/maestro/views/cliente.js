 $( function(){

    var reglas_cliente = {rules:{
                "clientes[clie_cliente]":{required:true},
                "clientes[clie_cedula]":{required:true},
                "clientes[clie_cupo]":{required:true,number:true}
            
             
                },
                messages:{
                "clientes[clie_cliente]":{required:"Digite el nombre"},
                "clientes[clie_cedula]":{required:"Digite la cedula"}

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


    $("#btnguardar_cliente").click(function(e){
    
    submit_formui(e,"#form_nuevo_cliente" , reglas_cliente,
    function(j){
           if(j.ret)
            {
               $("#div_nuevo_cliente").dialog("close");          
               add_fill_cliente(j.clie_cedula,j.clie_cliente,j.clie_negocio,j.clie_direccion,j.clie_telefono,j.clie_movil,j.clie_ciudad,j.clie_barrio,j.clie_fechacreacion,j.clie_cupo,j.clie_sucursal,j.clie_estado,j.clie_id);
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

    $("#btneditar_cliente").click(function(e){

    submit_formui(e,"#form_editar_cliente" , reglas_cliente,
    function(j){
           if(j.ret)
            {
              $("#div_editar_cliente").dialog("close");      
              edit_fill_cliente(j.clie_cedula,j.clie_cliente,j.clie_negocio,j.clie_direccion,j.clie_telefono,j.clie_movil,j.clie_ciudad,j.clie_barrio,j.clie_fechacreacion,j.clie_cupo,j.clie_sucursal,j.clie_estado,j.clie_id);
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


    function nuevo_cliente(){
    new_boxui('','#div_nuevo_cliente','Nuevo cliente',360,540);
    }

    function editar_cliente(clie_cedula,clie_cliente,clie_negocio,clie_direccion,clie_telefono,clie_movil,clie_ciudad,clie_barrio,clie_fechacreacion,clie_cupo,clie_sucursal,clie_estado,clie_id)
    {

     $("#txtid_editar_cliente").val(clie_id);
     $("#txtcedula_editar_cliente").val(clie_cedula);
     $("#txtnombre_editar_cliente").val(clie_cliente);
     $("#txtnegocio_editar_cliente").val(clie_negocio);
     $("#txtdireccion_editar_cliente").val(clie_direccion);
     $("#txttelefono_editar_cliente").val(clie_telefono);
     $("#txtcelular_editar_cliente").val(clie_movil);
     $("#txtciudad_editar_cliente").val(clie_ciudad);
     $("#txtbarrio_editar_cliente").val(clie_barrio);
     $("#txtcupo_editar_cliente").val(clie_cupo);
     $("#txtsucursal_editar_cliente").val(clie_sucursal);   
     $("#selectestado_editar_cliente").val(clie_estado);

     new_boxui('','#div_editar_cliente','Editar cliente',360,580);
    }

    function buscar_cliente(){

    new_boxui('','#div_buscar_cliente','Buscar cliente',360,220);

    }
    
    function  add_fill_cliente(clie_cedula,clie_cliente,clie_negocio,clie_direccion,clie_telefono,clie_movil,clie_ciudad,clie_barrio,clie_fechacreacion,clie_cupo,clie_sucursal,clie_estado,clie_id)
      {        
       var row = "<tr id='rowclie"+clie_id+"'>"+
                      '<td id="tdclie_ced'+clie_id+'" align="center">'+
                         '<a href="<?=site_url()?>/maestro/clientes/detalle/'+clie_id+'">'+clie_cedula+'</a>'+
                      '</td>'+
                      
                       '<td id="tdclie_clie'+clie_id+'" align="center">'+
                         '<label  for="cliente_clie">'+clie_cliente+'</label>'+
                      '</td>'+ 
                      
                        '<td id="tdclie_neg'+clie_id+'" align="center">'+
                         '<label  for="negocio_clie">'+clie_negocio+'</label>'+
                      '</td>'+
                      '<td id="tdclie_dir'+clie_id+'" align="center">'+
                         '<label  for="dir_clie">'+clie_direccion+'</label>'+
                      '</td>'+ 
                      
                       '<td id="tdclie_tel'+clie_id+'" align="center">'+
                         '<label  for="tel_clie">'+clie_telefono+'</label>'+
                      '</td>'+ 
                      
                      '<td id="tdclie_mov'+clie_id+'" align="center">'+
                         '<label  for="mov_clie">'+clie_movil+'</label>'+
                      '</td>'+ 
                      
                       '<td id="tdclie_ciu'+clie_id+'" align="center">'+
                         '<label  for="ciu_clie">'+clie_ciudad+'</label>'+
                      '</td>'+      
                      
                       '<td id="tdclie_barr'+clie_id+'" align="center">'+
                         '<label  for="barr_clie">'+clie_barrio+'</label>'+
                      '</td>'+
                                              
                      '<td id="tdclie_cupo'+clie_id+'" align="center">'+
                         '<label  for="cupo_clie">'+formatCurrency(clie_cupo)+'</label>'+
                      '</td>'+
                      
                       '<td id="tdclie_suc'+clie_id+'" align="center">'+
                         '<label  for="suc_clie">'+clie_sucursal+'</label>'+
                      '</td>'+
                        
                       '<td id="tdclie_fecha'+clie_id+'" align="center">'+
                         '<label  for="fecha_clie">'+clie_fechacreacion+'</label>'+
                      '</td>'+
                                                                                  
                       '<td id="tdclie_estado'+clie_id+'" align="center">'+
                         '<label  for="estado_clie" style="color:green">'+'Activo'+'</label>'+
                      '</td>'+ 
                                              
                      '<td  id="tdclie_edit'+clie_id+'" align="center">'+
                      "<a href='#' onClick='editar_cliente(\""+clie_cedula+"\",\""+clie_cliente+"\",\""+clie_negocio+"\",\""+clie_direccion+"\",\""+clie_telefono+"\",\""+clie_movil+"\",\""+clie_ciudad+"\",\""+clie_barrio+"\",\""+clie_fechacreacion+"\",\""+clie_cupo+"\",\""+clie_sucursal+"\",\""+'A'+"\",\""+clie_id+"\"); return false;'><img src='<?=base_url()?>/assets/images/edit.png' title='Editar'/></a>"+
                    '</td>'+'<tr>';
          $("#n_grid tbody").append(row);
          suma_totales_clie();
                   
    }
   
   function  edit_fill_cliente(clie_cedula,clie_cliente,clie_negocio,clie_direccion,clie_telefono,clie_movil,clie_ciudad,clie_barrio,clie_fechacreacion,clie_cupo,clie_sucursal,clie_estado,clie_id)
     {
                    
       est= (clie_estado=='A')?'Activo':'Inactivo';
       
       str_estado = '<label for="estado_clie">'+est+'</label>';
               
       str_edit =  "<a href='#' onClick='editar_cliente(\""+clie_cedula+"\",\""+clie_cliente+"\",\""+clie_negocio+"\",\""+clie_direccion+"\",\""+clie_telefono+"\",\""+clie_movil+"\",\""+clie_ciudad+"\",\""+clie_barrio+"\",\""+clie_fechacreacion+"\",\""+clie_cupo+"\",\""+clie_sucursal+"\",\""+clie_estado+"\",\""+clie_id+"\"); return false;'><img src='<?=base_url()?>/assets/images/edit.png' title='Editar cliente'/></a>";
                    
       $("#tdclie_ced"+clie_id).html('<a href="<?=site_url()?>/maestro/clientes/detalle/'+clie_id+'">'+clie_cedula+'</a>');    
      
       $("#tdclie_clie"+clie_id).html('<label  for="cliente_clie">'+clie_cliente+'</label>');    
       $("#tdclie_neg"+clie_id).html('<label  for="negocio_clie">'+clie_negocio+'</label>');    
       $("#tdclie_dir"+clie_id).html('<label  for="dir_clie">'+clie_direccion+'</label>');    
       $("#tdclie_tel"+clie_id).html('<label  for="tel_clie">'+clie_telefono+'</label>');    
       $("#tdclie_mov"+clie_id).html('<label  for="mov_clie">'+clie_movil+'</label>');    
       $("#tdclie_ciu"+clie_id).html('<label  for="ciu_clie">'+clie_ciudad+'</label>');    
       $("#tdclie_barr"+clie_id).html('<label  for="barr_clie">'+clie_barrio+'</label>');    
       $("#tdclie_fecha"+clie_id).html('<label  for="fecha_clie">'+clie_fechacreacion+'</label>');    
       $("#tdclie_cupo"+clie_id).html('<label  for="cupo_clie">'+formatCurrency(clie_cupo)+'</label>');
       $("#tdclie_suc"+clie_id).html('<label  for="suc_clie">'+clie_sucursal+'</label>');
       if(clie_estado=='A'){
             $("#tdclie_estado"+clie_id).html('<label  for="estado_clie" style="color:green">'+str_estado+'</label>');    
       }else if(clie_estado='I'){
             $("#tdclie_estado"+clie_id).html('<label  for="estado_clie" style="color:red">'+str_estado+'</label>');    
       }
     
       $("#tdclie_edit"+clie_id).html(str_edit);   
       suma_totales_clie();
   }
  function imprimir_todas(){
  window.open('index.php?/maestro/clientes/imprimir_todas/','_blank', 'width=900,height=600');return false;    
  }
  function imprimir_cartera(id_clie){
  window.open('index.php?/maestro/clientes/imprimir_cartera/'+id_clie ,'_blank', 'width=900,height=600');return false;    
  
  }
  
 function suma_totales_clie()
 {
  total_suma = 0;
   
  $('input[name*="cupo_clie[]"]').each( function(){
          valor = $(this).val();
          valor = parseFloat(valor);
          total_suma += valor;
         });

        try{
         total_suma = total_suma.toFixed(2);        
        }catch(e){ }
  $("#thsuma_totalclie").text(formatCurrency(total_suma));
 
 }