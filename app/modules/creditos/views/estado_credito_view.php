<div id="div_estado_credito" class="boxydiv boxy-content ">
  <form action="<?=site_url('creditos/inicio/cambiar_estado_general/')?>" id="form_estado_credito" method="post">
   <table class="formulario">
    <tr>
    <td>Estado</td>
    <td>
  <select name="estado_estado" id="estado_estado">
     <option value="P">Pendiente</option>
     <option value="N">Rechazado</option>   
     <?if($this->session->userdata('rol_nombre')=="FACTURACION"):?>
     <option value="F">Facturado</option>
     <?endif;?>
  </select> 
    </td>     
   </tr>
   </table> 
  <textarea  id="estado_comentarios" name="estado_comentarios" placeholder="Comentarios" cols="69" rows="3" ></textarea>  
   
  <input type="hidden" id="estado_usua_id" name="estado_usua_id" value=""/>
  <input type="hidden" id="estado_cred_id" name="estado_cred_id" value=""/>   
  <input Style="  margin-left: 45%" type="button" value="Enviar" id="enviar_estado">
  </form>
</div>