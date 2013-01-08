  var reglas_credito = {rules:{
                "clientes[clie_cliente]":{required:true},
                "clientes[clie_cedula]":{required:true},
                "clientes[clie_negocio]":{required:true},
                "clientes[clie_cupo]":{number:true},
                "creditos[cred_razon1]":{required:true},
                "creditos[cred_actividad1]":{required:true},
                "creditos[cred_tel1]":{required:true},
                "creditos[cred_ciudad1]":{required:true}
                             
                },
                messages:{
                "clientes[clie_cliente]":{required:"Nombre requerido"},
                "clientes[clie_cedula]":{required:"Cedula requerida"},
                "clientes[clie_negocio]":{required:"Negocio requerido"},
                "clientes[cred_cupo]":{number:"Valor numerico requerido"},
                "creditos[cred_razon1]":{required:"Razon social requerida"},
                "creditos[cred_actividad1]":{required:"Actividad requerida"},
                "creditos[cred_tel1]":{required:"Telefono requerido"},
                "creditos[cred_ciudad1]":{required:"Ciudad requerida"}
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
  
    var pickerOpts={
    dateFormat:"yy/mm/dd",
    dayNamesMin: ["Do","Lu","Ma","Mi","Ju","Vi","Sa"],
    monthNames: ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"]
    };
    $(".datepicker").datepicker(pickerOpts)
   

    $("#btneditar_credito").click(function(e){

    submit_formui(e,"#form_editar_credito" , reglas_credito,
    function(j){
           if(j.ret)
            {
              $("#div_editar_credito").dialog("close");      
              edit_fill_credito(j.cred_cedula,j.cred_credito,j.cred_negocio,j.cred_direccion,j.cred_telefono,j.cred_movil,j.cred_ciudad,j.cred_barrio,j.cred_fechacreacion,j.cred_cupo,j.cred_estado,j.cred_id);
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
    
   $("#enviar_comentarios").click(function(e){
    submit_formui('',"#form_comentarios_credito",null, function(j){        
    if(j.ret){          
            window.location.href="<?=site_url('creditos/inicio/index')?>"
    }else{
          $.unblockUI();
          alerta(j.msg);
         }        
    });   
   });
   
   $("#enviar_estado").click(function(e){
   submit_formui('',"#form_estado_credito",rules_estado, function(j){        
        if(j.ret){          
            window.location.href="<?=site_url('creditos/inicio/index')?>"
        }else{
             $.unblockUI();
             alerta(j.msg);
             }        
        });   
       
   });

    });//fin on ready


function nuevo_credito(){
new_boxui('','#div_nuevo_credito','Nuevo credito',600,500);
}

function editar_credito(cred_cedula,cred_credito,cred_negocio,cred_direccion,cred_telefono,cred_movil,cred_ciudad,cred_barrio,cred_fechacreacion,cred_cupo,cred_estado,cred_id)
{
 $("#txtid_editar_credito").val(cred_id);
 $("#txtcedula_editar_credito").val(cred_cedula);
 $("#txtnombre_editar_credito").val(cred_credito);
 $("#txtnegocio_editar_credito").val(cred_negocio);
 $("#txtdireccion_editar_credito").val(cred_direccion);
 $("#txttelefono_editar_credito").val(cred_telefono);
 $("#txtcelular_editar_credito").val(cred_movil);
 $("#txtciudad_editar_credito").val(cred_ciudad);
 $("#txtbarrio_editar_credito").val(cred_barrio);
 $("#txtcupo_editar_credito").val(cred_cupo);
 $("#selectestado_editar_credito").val(cred_estado);
 new_boxui('','#div_editar_credito','Editar credito',360,520);
}

function buscar_credito(){
new_boxui('','#div_buscar_credito','Buscar credito',320,220);
}
    
function guardar_credito(){
submit_formui('',"#form_nuevo_credito", reglas_credito, function(j){
       
        if(j.ret){
             $.unblockUI(); 
             url= $("#url_redirect_credito").val();
             window.location.replace(url+j.clie_id);
        }else{
             $.unblockUI();
            
             }
        
        } );
       mostrar_tip();
   }
function editar_credito(){
submit_formui('',"#form_editar_credito", reglas_credito, function(j){
if(j.ret){
   $.unblockUI();
   this.location.reload();
 }else{
       $.unblockUI();
      }
  } );
}
function enviar_credito(cred_id,usua_id,estado,esta_en)
{
$("#comen_usua_id").val(usua_id);
$("#comen_cred_id").val(cred_id);
$("#comen_estado").val(estado);
$("#comen_esta_en").val(esta_en);
new_boxui('','#div_comentarios_credito','Comentarios',490,160); 
}

function enviar_credito_general(cred_id,usua_id,estado,esta_en,enviar_a){

$('<div><b>'+'<textarea  id="ee_comentarios" name="comen_comentarios" placeholder="Comentarios" cols="69" rows="3" ></textarea> '+'</b></div>').dialog({title:'Comentarios' ,modal:true,height: 180 , width:550,
                show: 'fade', hide: 'fade' ,
                buttons: {
		       	Ok: function() {
                          $(this).dialog('close');
                          urlp = $("#url_enviar_credito_general").val();  
                          data = 'usua_id='+usua_id+'&cred_id='+cred_id+'&estado='+estado+'&esta_en='+esta_en+'&enviado_a='+enviar_a+'&comentarios='+$("#ee_comentarios").val();
                          $.blockUI({message: '<h1> Espere por favor...</h1>'});
                          ajax_util(urlp,data,'json',function(j){
                          if(j.ret){          
                          window.location.href="<?=site_url('creditos/inicio/index')?>"
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
function estado_credito_general(cred_id,usua_id){
$("#estado_usua_id").val(usua_id);
$("#estado_cred_id").val(cred_id);    
new_boxui('','#div_estado_credito','Estado del credito',490,200); 
}

function imprimir_credito(cred_id){ 
window.open('index.php?/creditos/inicio/impresion/'+cred_id,'_blank', 'width=1200,height=600');return false;    
}

function mostrar_estados_credito(cred_id){
urlp = $("#url_estados_credito").val();  
                          data = 'cred_id='+cred_id;                          
                          ajax_util(urlp,data,null,function(j){                         
                          new_boxui('',j, 'Historial de estados', 900, 300);                    
                          });    
}