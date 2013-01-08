<html>
  <head>
    <title>:: CRM ::</title>
<script src="<?=base_url()?>assets/js/jquery-1.4.1.js" type="text/javascript"></script>
<link type="text/css" href="<?=base_url()?>assets/js/jquery-ui-1.8.9/css/south-street/jquery-ui-1.8.9.custom.css" rel="stylesheet" />
<script type="text/javascript" src="<?=base_url()?>assets/js/jquery-ui-1.8.9/js/jquery-ui-1.8.9.custom.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/js/jquery.validate.js"></script>
<script src="<?=base_url()?>assets/js/jquery.qtip-1.0.0-rc3.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>assets/js/util.js" type="text/javascript"></script>

    <style type="text/css">
		body{ font-size: 9pt; margin:0px;padding:0px;font-family: arial; color:#666 }
		div.main{border: 1px dotted #ddd; margin: 80px auto;}
		div.content{width:500px; margin: 0px auto; padding: 5px 0px 10px 0px}
		div.logo{float:left; border-right: 1px dotted #ddd; padding-right: 10px;margin-top: 1px}
		div.form{margin-left: 180px}
		.fixed{clear:both}
		input[type="text"], input[type="password"]
		{
			color: #666;
			border: 1px solid #ddd;
			padding: 5px;
		}

		input[type="submit"]{
			padding: 3px;
			-moz-border-radius: 5px;
			border: 1px solid #ddd;
			-ms-border-radius: 5px; /* IE 8.*/
			-webkit-border-radius: 5px; /* Safari,Chrome.*/
			border-radius: 5px; /* El estándar.*/
                        cursor: pointer;
		}

                select{
			padding: 3px;
			-moz-border-radius: 5px;
			border: 1px solid #ddd;
			-ms-border-radius: 5px; /* IE 8.*/
			-webkit-border-radius: 5px; /* Safari,Chrome.*/
			border-radius: 5px; /* El estándar.*/
		}
		div.error{background: #FF4141; color: white; padding:5px; text-align:center}

                img {border:none; color:  #2fb12f}

		</style>
  </head>

  <body>
      <div class="main">
	 <div class="content" >
	    <div class="logo">
		<p><img src="<?=base_url()?>assets/images/crisol2.png"/>
		</p>
	     </div>
             <input type="hidden" id="path_server" value="<?=base_url()?>"/>
                    <div class="form">
           <form id="auth_form" method="POST" action="<?=site_url('auth/inicio/valid_user')?>">
	   <table>
	     <tr>
	       <td>Usuario </td>
	       <td><input type="text" name="usuario[usua_cedula]" /></td>
	    </tr>
	    <tr>
               <td>Clave </td>
	       <td><input type="password" name="usuario[usua_clave]" /></td>
	    </tr>
             <tr>
	      <td></td>
	      <td><input type="submit" value="Enviar" id="auth_enviar" /></td>
	    </tr>
	 </table>
	</form>
    </div>
       <?if(!is_null($msg)):?>
       <div class="error"><?=$msg?></div>
       <?endif;?>
         </div>
      </div>
  </body>
  <script>
  $( function(){
     
   var reglas_auth = {rules:{
                    "usuario[usua_cedula]":{required:true},
                    "usuario[usua_clave]":{required:true}
                    },
                    messages:{
                    "usuario[usua_cedula]":{required:"el usuario es requerido"},
                    "usuario[usua_clave]":{required:"la clave es requerida"}

                         }
                };

  $('#auth_enviar').click(function(e){

  e.preventDefault();
   p= valid_form('#auth_form',reglas_auth);
   mostrar_tip();
   if(p){
        $('#auth_form').submit();
      }//fin if p

    return false;

});


  });
  </script>
</html>