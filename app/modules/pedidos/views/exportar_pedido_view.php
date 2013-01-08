<?php 
header('Content-type: application/octet-stream;charset=iso-8859-1');
header('Content-Disposition: attachment; filename=pedido'.$pedido->pedi_id.'.xls');
header('Pragma: no-cache');
header('Expires: 0');
?>
<div>
    <?
    $total     = 0;
    $total_sug = 0;
    ?>
    <input type="hidden" id="url_completar_cliente" value="<?=site_url()?>pedidos/inicio/completar_cliente/"/>
    <form id="form_nuevo_pedido" action="<?=site_url()?>/pedidos/inicio/guardar_editar" method="post" >
    <input type="hidden" id="pedi_id" name="pedi_id" value="<?=$pedido->pedi_id?>"/>
  
     <div class="compra_box">   
      <h1 ><?=$this->session->userdata('compania_nombre')?>&nbsp; &nbsp; &nbsp;  Nit: <?=$this->session->userdata('compania_nit')?>&nbsp; &nbsp; &nbsp;  Dir: <?=$this->session->userdata('compania_direccion').'-'.$this->session->userdata('compania_ciudad')?>&nbsp; &nbsp; Tel. <?=$this->session->userdata('compania_telefono')?></h1>   
      
            <table>
                <tr>
                    <td><strong>Numero:</strong><?=$pedido->pedi_id?></td>                                     
                    <td style="padding-left: 20px"><strong>Vendedor:</strong><?=$pedido->usua_nombre?> </td>                    
                    <td style="padding-left: 20px"><strong>Fecha:</strong><?=$pedido->pedi_fecha?></td>                    
                </tr>
                
                <tr>
                    <td><strong>NIT/CC:</strong> <?=$pedido->clie_cedula?></td>                                                       
                    <td style="padding-left: 20px"><strong>Nombre:</strong> <?=$pedido->clie_cliente?></td>
                    <td style="padding-left: 20px"><strong>Negocio:</strong><?=$pedido->clie_negocio?></td>
                </tr>
                          
                  <tr>
                   <td><strong>Dias Credito:</strong><?=$pedido->pedi_dias_credito?></td>                                                         
                   <td style="padding-left: 20px"><strong>Forma Pago:</strong>                                          
                           <?if($pedido->pedi_forma_pago=="CR") echo "CREDITO"?> 
                           <?if($pedido->pedi_forma_pago=="CO") echo "CONTADO"?>                      
                    </td>   
                   <td style="padding-left: 20px"><strong>Tipo:</strong>                                           
                           <?if($pedido->pedi_tipo=="F") echo "LINEA"?> 
                           <?if($pedido->pedi_tipo=="PV") echo "PREVENTA"?> 
                           <?if($pedido->pedi_tipo=="PM") echo "PROMOCION"?>                        
                    </td>
                 </tr> 
                <tr>                   
                    <td><strong>Prioridad:</strong>
                          <?if($pedido->pedi_prioridad=="N") echo "NORMAL"?> 
                          <?if($pedido->pedi_prioridad=="A") echo "ALTA"?>                  
                    </td>
                 </tr>                    
            </table>
         
        <div style=" width: 600px;height: 50px"><?=utf8_decode($pedido->pedi_comentarios)?> </div>
          
    </div>
    
    <div>
        <table border="0" width="100%" class="n_grid detail_table" id="n_grid" cellpadding="0" cellspacing="1">
        <thead>
             <tr>               
                <th align="center">Codigo</th>
                <th align="center">Descripcion</th>                
                <th align="center">Cantidad</th>
                <?if($this->session->userdata('rol_nombre')!='VENDEDOR'):?>
                <th align="center">Precio</th>  
                <?endif;?>
                <th align="center">Precio <?if($this->session->userdata('rol_nombre')!='VENDEDOR')echo ' Sug'?></th>                
                <?if($this->session->userdata('rol_nombre')!='VENDEDOR'):?>
                <th align="center">Total</th> 
                <?endif;?>
                <th align="center">Total <?if($this->session->userdata('rol_nombre')!='VENDEDOR')echo ' Sug'?></th> 
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
                                      
                    <td align="center"><label for="cantidad"><?=$d->dped_cantidad?></label>
                    <input type="hidden" name="cantidad[]" value="<?=$d->dped_cantidad?>" /></td>
                    <?if($this->session->userdata('rol_nombre')!='VENDEDOR'):?>
                    <td align="center"><label for="costo"><?=number_format($d->dped_precio_coniva,2,'.',',')?></label>
                    <?endif;?> 
                    <td align="center"><label for="presio_sug"><?=number_format($d->dped_precio_sugerido,2,'.',',')?></label>
                    <input type="hidden" name="precio_sug[]" value="<?=$d->dped_precio_sugerido?>" /> 
                   
                    <input type="hidden" name="porci[]" value="<?=$d->dped_porc_iva?>" />
                    <?if($this->session->userdata('rol_nombre')!='VENDEDOR'):?>
                    <td align="center"><label for="total"><?=number_format($d->dped_precio_coniva*$d->dped_cantidad,2,'.',',')?></label>
                    <?endif;?>
                    <td align="center"><label for="total_sug"><?=number_format($d->dped_precio_sugerido*$d->dped_cantidad,2,'.',',')?></label>
                    
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
                <?if($this->session->userdata('rol_nombre')!='VENDEDOR'):?>
                <th align="center"></th>   
                <?endif;?>
                <th align="center"></th> 
                <?if($this->session->userdata('rol_nombre')!='VENDEDOR'):?>
                <th id="thsuma_total" align="center"><?=number_format($total,2,'.',',')?></th>
                <?endif;?>
                <th id="thsuma_total_sug" align="center"><?=number_format($total_sug,2,'.',',')?></th>
                <th></th>               
            </tr>
            </tfoot>
        </table>
<input type="hidden" id="next" value="<?=$d->dped_id+1?>">
    </div>
     
    </form>
</div>