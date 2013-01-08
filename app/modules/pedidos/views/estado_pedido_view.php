<div id="div_estado_pedido" class="boxydiv boxy-content ">
  <input type="hidden" id="url_enviar_pedido_general" value="<?=site_url('pedidos/inicio/enviar_pedido_general/')?>" />
  <form action="<?=site_url('pedidos/inicio/cambiar_estado_general/')?>" id="form_estado_pedido" method="post">
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
  <input type="hidden" id="estado_pedi_id" name="estado_pedi_id" value=""/>   
  <input Style="  margin-left: 45%" type="button" value="Enviar" id="enviar_estado">
  </form>
</div>