
    var reglas_empresa = {rules:{
                        "empresa[comp_nombre]":{required:true},
                        "empresa[comp_nit]":{required:true}
                        },
                        messages:{
                        "empresa[comp_nombre]":{required:"Nombre requerido"},
                        "empresa[comp_nit]":{required:"Nit requerido"}

                             }
                    };

    $(function(){

    });

    function editar_empresa(){

        this.alerta('Realmente desea actualizar?',function(){
         submit_formui('','#form_editar_empresa' , reglas_empresa, function(j){
         location.reload();
       });
       mostrar_tip();
        });


    }