<div>
    <?
    $total          = 0;
    $total_sug      = 0;
    ?>
    <input type="hidden" id="url_completar_cliente" value="<?=site_url()?>pedidos/inicio/completar_cliente/"/>
    <form id="form_nuevo_pedido" action="<?=site_url()?>/pedidos/inicio/guardar_editar" method="post" >
    <input type="hidden" id="pedi_id" name="pedi_id" value="<?=$pedido->pedi_id?>"/>
  
     <div class="compra_box">       
            <table>
                <tr>
                    <td>Numero</td>
                    <td>                       
                        <input name="pedido[pedi_numero]" type="text" value="<?=$pedido->pedi_id?>" id="add_numero"/>                
                    </td>                    
                    <td style="text-align: right; padding-left: 20px" >Vendedor</td>
                    <td>                         
                        <select name="pedido[pedi_usua_id]" id="add_vendedor">
                           <option value="">Seleccionar</option>
                            <?if($vendedores):?>
                           <?foreach($vendedores->result() as $ve):?>
                           <option <?if($pedido->pedi_usua_id==$ve->usua_id) echo "selected='selected'"?> value="<?=$ve->usua_id?>"><?=$ve->usua_nombre?></option>
                           <?endforeach;?>
                           <?endif;?>
                        </select>                   
                    </td>
                </tr>
                <tr>
                    <td>Fecha</td>
                    <td>
                        <input name="pedido[pedi_fecha]" value="<?=$pedido->pedi_fecha?>" type="text" id="add_fecha" class="date-pick">
                    </td>

                    <td style="text-align: right">NIT/CC</td>
                    <td>
                        <input type="text" id="add_cedula" value="<?=$pedido->clie_cedula?>" name="add_cedula"/>
                        <input name="pedido[pedi_clie_cedula]" value="<?=$pedido->clie_cedula?>" type="hidden" id="add_clie_cedula">                       
                        <input name="pedido[pedi_clie_sucursal]" value="<?=$pedido->pedi_clie_sucursal?>" type="hidden" id="add_clie_sucursal">
                    </td>
                </tr>
               <tr>
                   <td>Forma Pago</td>
                    <td>
                        <select name="pedido[pedi_forma_pago]">
                           <option <?if($pedido->pedi_forma_pago=="CR") echo "selected='selected'"?> value="CR">CREDITO</option>
                           <option <?if($pedido->pedi_forma_pago=="CO") echo "selected='selected'"?> value="CO">CONTADO</option> 
                        </select>
                    </td>
                    <td style="text-align: right; padding-left: 20px">Nombre</td>
                    <td>
                        <input type="text" id="add_nombre" value="<?=$pedido->clie_cliente?>" name="add_nombre">
                    </td>
                                      
                </tr>                
                  <tr>
                   <td>Dias Credito</td>
                   <td>
                        <input name="pedido[pedi_dias_credito]" value="<?=$pedido->pedi_dias_credito?>" type="text">
                    </td>
                  
                   <td style="text-align: right; padding-left: 20px">Estableci</td>
                   <td>
                        <input id="add_negocio"  value="<?=$pedido->clie_negocio?>" type="text" name="add_negocio">
                    </td> 
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
         
         <textarea  placeholder="Comentarios" name="pedido[pedi_comentarios]" cols="69" rows="3" ><?=$pedido->pedi_comentarios?></textarea>
          
    </div>

    <div>
            <a href="#" onclick="agregar_fila_producto();return false;">
                <img class="qtip" alt="Agregar un producto" src="<?php echo base_url()?>assets/images/add-row.png" />
            </a>        
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
                <th></th>                 
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
                                      
                    <td align="center"><label for="cantidad"><?=$d->dped_cantidad?></label>
                    <input type="hidden" name="cantidad[]" value="<?=$d->dped_cantidad?>" /></td>

                    <td align="center"><label for="costo"><?=number_format($d->dped_precio_coniva,2,'.',',')?></label>
                    <input type="hidden" name="precio[]" value="<?=$d->dped_precio_coniva?>" /> 
                    <input type="hidden" name="prconi[]" value="<?=$d->dped_precio_coniva?>" /></td>
                   
                    <td align="center"><label for="presio_sug"><?=number_format($d->dped_precio_sugerido,2,'.',',')?></label>
                    <input type="hidden" name="precio_sug[]" value="<?=$d->dped_precio_sugerido?>" /> 
                   
                    <input type="hidden" name="porci[]" value="<?=$d->dped_porc_iva?>" />
                    
                    <td align="center"><label for="total"><?=number_format($d->dped_precio_coniva*$d->dped_cantidad,2,'.',',')?></label>
                    <input type="hidden" name="total[]" value="<?=$d->dped_precio_coniva*$d->dped_cantidad?>" /></td>                  

                    <td align="center"><label for="total_sug"><?=number_format($d->dped_precio_sugerido*$d->dped_cantidad,2,'.',',')?></label>
                    <input type="hidden" name="t_sug[]" value="<?=$d->dped_precio_sugerido*$d->dped_cantidad?>" /></td>                  

                    <td align="center"><label for="fecha"><?=( ($d->dped_fecha_entrega=="0000-00-00")? "": $d->dped_fecha_entrega)?></label>
                    <input type="hidden" name="fecha[]" value="<?=$d->dped_fecha_entrega?>" /></td>                  


                    <td align="center">
                    <a href="#" onClick="remove_item('#row<?=$d->dped_id?>'); return false;"><img src="<?=base_url()?>/assets/images/remove.png" title="Eliminar Producto"/></a>
                    </td></tr>
               
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
                <th></th>
            </tr>
            </tfoot>
        </table>
<input type="hidden" id="next" value="<?=$d->dped_id+1?>">
    </div>
     <div>
            <a href="#" onclick="agregar_fila_producto();return false;">
                <img class="qtip" alt="agregar un producto" src="<?php echo base_url()?>assets/images/add-row.png" />
            </a>
    </div>
    </form>
</div>
<?=$vista_agregar_producto?>