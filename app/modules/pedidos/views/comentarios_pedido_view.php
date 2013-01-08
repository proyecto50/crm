<div id="div_comentarios_pedido" class="boxydiv boxy-content ">
  <form action="<?=site_url('pedidos/inicio/cambiar_estado/')?>" id="form_comentarios_pedido" method="post">
  <textarea  id="area_enviar_comentarios" name="comen_comentarios" placeholder="Comentarios" cols="69" rows="3" ></textarea>  
  <input type="hidden" id="comen_usua_id" name="usua_id" value=""/>
  <input type="hidden" id="comen_pedi_id" name="pedi_id" value=""/>
  <input type="hidden" id="comen_estado" name="estado" value=""/>
  <input type="hidden" id="comen_esta_en" name="comen_esta_en" value=""/>
  <input Style="  margin-left: 45%" type="button" value="Enviar" id="enviar_comentarios">
  </form>
</div>