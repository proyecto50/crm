<div>
    <?
    $total     = 0;
    $total_sug = 0;
    ?>
    <input type="hidden" id="url_completar_cliente" value="<?=site_url()?>pedidos/inicio/completar_cliente/"/>
    <form id="form_nuevo_pedido" action="<?=site_url()?>/pedidos/inicio/guardar_editar" method="post" >
    <input type="hidden" id="pedi_id" name="pedi_id" value="<?=$pedido->pedi_id?>"/>
  
     <div class="compra_box">       
            <table>
                <tr>
                <td >Vendedor</td>
                    <td>                         
                        <select name="pedido[pedi_usua_id]" id="add_vendedor">
                             <option value="<?=$pedido->usua_id?>"><?=$pedido->usua_nombre?></option>
                        </select>                   
                    </td> 
                     <td style="text-align: right">NIT/CC</td>
                    <td>
                        <input type="text" id="add_cedula" value="<?=$pedido->clie_cedula?>" name="add_cedula"/>
                        <input name="pedido[pedi_clie_cedula]" value="<?=$pedido->clie_cedula?>" type="hidden" id="add_clie_cedula">                       
                    </td>  
                </tr>
                <tr>
                    <td>Numero</td>
                    <td>                       
                        <input name="pedido[pedi_numero]" type="text" value="<?=$pedido->pedi_id?>" id="add_numero"/>                
                    </td> 
                    <td style="text-align: right; padding-left: 20px">Nombre</td>
                    <td>
                        <input type="text" id="add_nombre" value="<?=$pedido->clie_cliente?>" name="add_nombre">
                    </td>                 
                    <?IF($this->session->userdata('rol_nombre')=="FACTURACION" || $this->session->userdata('rol_nombre')=="BODEGA"):?>
                    <td style="text-align: right; padding-left: 20px" >Transporte</td>
                    <td>                         
                        <select name="pedido[pedi_tran_id]" id="add_transportadora">
                            <option value="0">Seleccionar</option>
                            <?if($transportadoras):?>                            
                            <?foreach ($transportadoras->result() as $t):?>                            
                             <option <?if($pedido->pedi_tran_id==$t->tran_id) echo "selected='selected'"?> value="<?=$t->tran_id?>"><?=$t->tran_nombre?></option>
                            <?endforeach;?>
                            <?endif;?> 
                        </select>                   
                    </td>
                    <?endif;?>
                </tr>
                <tr>
                    <td>Fecha</td>
                    <td>
                        <input name="pedido[pedi_fecha]" value="<?=$pedido->pedi_fecha?>" type="text" id="add_fecha" class="date-pick">
                    </td>
                   <td style="text-align: right; padding-left: 20px">Estableci</td>
                   <td>
                        <input id="add_negocio"  value="<?=$pedido->clie_negocio?>" type="text" name="add_negocio">
                    </td>
                   
                    <?IF($this->session->userdata('rol_nombre')=="FACTURACION"):?>
                    <td style="text-align: right"># de Guia</td>
                    <td>
                        <input name="pedido[pedi_numero_guia]" value="<?=$pedido->pedi_numero_guia?>" type="text" id="add_numero" >
                    </td>
                    <?endif;?>
                </tr>
               <tr>
                   <td>Forma Pago</td>
                    <td>
                        <select name="pedido[pedi_forma_pago]">
                           <option <?if($pedido->pedi_forma_pago=="CR") echo "selected='selected'"?> value="CR">CREDITO</option>
                           <option <?if($pedido->pedi_forma_pago=="CO") echo "selected='selected'"?> value="CO">CONTADO</option> 
                        </select>
                    </td>
                    <td style="text-align: right; padding-left: 20px">Telefono</td>
                    <td>
                        <input id="add_telefono"  value="<?=$pedido->clie_telefono.'--'.$pedido->clie_movil?>" type="text" name="add_ciudad">
                    </td> 
                    <?IF($this->session->userdata('rol_nombre')=="FACTURACION"):?>
                   <td style="text-align: right">F.Envio</td>
                    <td>
                        <input  name="pedido[pedi_fecha_envio]" value="<?=$pedido->pedi_fecha_envio?>" type="text" id="add_fecha_envio" class="date-pick">
                    </td> 
                    <?endif;?>
                </tr>                
                  <tr>
                   <td>Dias Credito</td>
                   <td>
                        <input name="pedido[pedi_dias_credito]" value="<?=$pedido->pedi_dias_credito?>" type="text">
                    </td>                  
                   <td style="text-align: right; padding-left: 20px">Ciudad</td>
                   <td>
                        <input id="add_ciudad"  value="<?=$pedido->clie_ciudad?>" type="text" name="add_ciudad">
                    </td> 
                    <?IF($this->session->userdata('rol_nombre')=="FACTURACION"):?>
                    <td style="text-align: right">F.LLegada</td>
                    <td>
                        <input  name="pedido[pedi_fecha_llegada]" value="<?=$pedido->pedi_fecha_llegada?>" type="text" id="add_fecha_llegada" class="date-pick">
                    </td> 
                    <?endif;?>
                 </tr> 
                <tr>
                   <td>Tipo</td>
                    <td>
                        <select name="pedido[pedi_tipo]">
                           <option <?if($pedido->pedi_tipo=="F") echo "selected='selected'"?> value="F">LINEA</option>
                           <option <?if($pedido->pedi_tipo=="PV") echo "selected='selected'"?> value="PV">PREVENTA</option> 
                           <option <?if($pedido->pedi_tipo=="PM") echo "selected='selected'"?> value="PM">PROMOCION</option> 
                        </select>
                    </td>
                    <td style="text-align: right; padding-left: 20px">Prioridad</td>
                    <td>
                        <select name="pedido[pedi_prioridad]">
                           <option <?if($pedido->pedi_prioridad=="N") echo "selected='selected'"?> value="N">NORMAL</option>
                           <option <?if($pedido->pedi_prioridad=="A") echo "selected='selected'"?> value="A">ALTA</option>                          
                        </select>
                    </td>
                 </tr>                    
            </table>
         
         <textarea   readonly placeholder="Comentarios" name="pedido[pedi_comentarios]" cols="69" rows="3" ><?=$pedido->pedi_comentarios?></textarea>
          
    </div>
    
    <div>
        <table border="0" width="100%" class="n_grid detail_table" id="n_grid" cellpadding="0" cellspacing="1">
          
          <thead>
            <tr>               
                <th align="center">Codigo</th>
                <th align="center">Descripcion</th>                
                <th align="center">Cantidad</th>
                <th align="center">Precio</th>     
                <th align="center">Precio Sug</th>     
                <th align="center">Total</th> 
                <th align="center">Total Sug</th> 
                <th align="center">Fecha Entrega</th> 
                          
            </tr>
            </thead>
            <tbody>
             <?if($detalle):?>
              <?foreach($detalle->result() as $d): ?>
                <?
                $total     += $d->dped_precio_coniva*$d->dped_cantidad ;
                $total_sug += $d->dped_precio_sugerido*$d->dped_cantidad;
                ?>
               <tr id="row<?=$d->dped_id?>" >

                    <td align="center"><label for="cod_pro"><?=$d->dped_inve_codigo?></label>
                    <input type="hidden" name="cod_producto[]" value="<?=$d->dped_inve_codigo?>" /></td>

                    <td align="center"><label for="nombre_pro"><?=$d->inve_descripcion?></label>
                    <input type="hidden" name="nombre_pro[]" value="<?=$d->inve_descripcion?>" /></td>
                                      
                    <td align="center"><label for="cantidad"><?=( ($this->session->userdata('rol_nombre')=="BODEGA")? '': $d->dped_cantidad)?></label>
                    <input type=<?=(($this->session->userdata('rol_nombre')=="BODEGA")? 'text' :  '"hidden"');?> name="cantidad[]" value="<?=$d->dped_cantidad?>" style=" text-align: center;width: 60px;"/></td>

                    <td align="center"><label for="costo"><?=number_format($d->dped_precio_coniva,2,'.',',')?></label>
                    <input type="hidden" name="precio[]" value="<?=$d->dped_precio_coniva?>" /> 
                    <input type="hidden" name="prconi[]" value="<?=$d->dped_precio_coniva?>" /></td>
                   
                    <td align="center"><label <?if($d->dped_precio_sugerido!=$d->dped_precio_coniva) echo 'style="color:red"'; ?> for="presio_sug"><?=( ($this->session->userdata('rol_nombre')=="GERENCIA")? '': number_format($d->dped_precio_sugerido,2,'.',','))?></label>
                    <input type=<?=(($this->session->userdata('rol_nombre')=="GERENCIA")? 'text' :  '"hidden"');?>  name="precio_sug[]" value="<?=$d->dped_precio_sugerido?>" style=" text-align: center;width: 60px; <?if($d->dped_precio_sugerido!=$d->dped_precio_coniva) echo 'color:red'; ?>"  /> 
                   
                    <input type="hidden" name="porci[]" value="<?=$d->dped_porc_iva?>" />
                    
                    <td align="center"><label for="total"><?=number_format($d->dped_precio_coniva*$d->dped_cantidad,2,'.',',')?></label>
                    <input type="hidden" name="total[]" value="<?=$d->dped_precio_coniva*$d->dped_cantidad?>" /></td>                  

                    <td align="center"><label for="total_sug"><?=number_format($d->dped_precio_sugerido*$d->dped_cantidad,2,'.',',')?></label>
                    <input type="hidden" name="t_sug[]" value="<?=$d->dped_precio_sugerido*$d->dped_cantidad?>" /></td>                  

                    <td align="center"><label for="fecha"><?=( ($d->dped_fecha_entrega=="0000-00-00")? "": $d->dped_fecha_entrega)?></label>
                    <input type="hidden" name="fecha[]" value="<?=$d->dped_fecha_entrega?>" /></td>                  

                  </tr>
               
              <?endforeach;?>  
             <?endif;?>   
            </tbody>
            <tfoot>
                <tr>
                <th align="center"></th>
                <th align="center"></th>
                <th align="center"></th>
                <th align="center"></th>    
                <th align="center"></th>                
                <th id="thsuma_total" align="center"><?=number_format($total,2,'.',',')?></th>
                <th id="thsuma_total_sug" align="center"><?=number_format($total_sug,2,'.',',')?></th>
                <th></th>               
            </tr>
            </tfoot>
        </table>
<input type="hidden" id="next" value="<?=$d->dped_id+1?>">
    </div>
     
    </form>
</div>
<?=$vista_comentarios_pedido?>
<?=$vista_estado_pedido?>