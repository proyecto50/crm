<?if($pedidos){?>
<?
  $total          =0;
  $total_sugerido =0;
  $total_cantidad =0;
 ?>
<div>
    <input type="hidden" id="url_eliminar_pedido" value="<?=site_url()?>pedidos/inicio/eliminar/"/>
    <input type="hidden" id="url_estados_pedido" value="<?=site_url()?>pedidos/inicio/mostrar_estados/"/>
    <div style=" height: 30px; padding-right:15px;  text-align: right" >
        <div id="link" style="padding: 10px; float: right; text-align: center">
            <form action="<?=site_url('pedidos/inicio/'.$tarjet)?>"  id="form_xpagin_1" method="post">
            <?=$this->pagination->create_links(1,$per_page)?>
            </form>
        </div>
    </div>
</div>        
        <table border="0" width="100%" class="n_grid detail_table" id="n_grid" cellpadding="0" cellspacing="1">
            <thead>
                <tr>  
                    <th>&nbsp</th>
                    <th align="center">Fecha</th>                   
                    <th align="center">Número</th>
                    <th align="center">N.Cliente</th>
                    <th align="center">Vendido a</th>
                    <th align="center">Vendedor</th>                    
                    <th align="center">Productos</th>
                    <th align="center">Total</th>  
                    <th align="center">Total Sug</th>  
                    <th align="center">Estado</th>
                    <th align="center">Ubicación</th>
                    <th align="center">Tipo</th>
                    <?if($tarjet!='seguir'):?>
                    <th align="center">Editar</th>
                    <th align="center">&nbsp</th>
                    <?endif;?>
               </tr>
            </thead>
            <tbody>
                <?foreach($pedidos->result() as $ped):?>
                
                   <? $total+=$ped->total;
                      $total_sugerido+=$ped->total_sugerido;
                      $total_cantidad+=$ped->cantidad;
                   ?>
                
                <tr id='rowped<?=$ped->pedi_id?>'>
             
                    <td align="center">
                        <?if($ped->pedi_prioridad=="A"):?>
                        <img class="qtip" src="<?php echo base_url()?>assets/images/star.png" alt="<strong>Prioridad alta:</strong><?=$ped->pedi_comentarios?>" />
                        <?endif;?>
                    </td>
                    
                    <td id='tdped_fecha<?=$ped->pedi_id?>'  align="center">
                         <a href="<?=site_url()?>/pedidos/inicio/detalle<?=$detalle?>/<?=$ped->pedi_id?>">
                        <?=$ped->pedi_fecha?>
                         </a>
                    </td>
                    
                    <td id='tdped_id<?=$ped->pedi_id?>'  align="center">
                        <a href="<?=site_url()?>/pedidos/inicio/detalle<?=$detalle?>/<?=$ped->pedi_id?>">
                          <?=$ped->pedi_id?>
                        </a>
                    </td>
                    
                    <td id='tdped_cliente<?=$ped->pedi_id?>'  align="center">
                        <label for="cliente_ped"><?=$ped->clie_cliente?></label>
                    </td>
                    
                     <td id='tdped_negocio<?=$ped->pedi_id?>'  align="center">
                        <label for="negocio_ped"><?=$ped->clie_negocio?></label>
                    </td>
                    
                    <td id='tdped_vendedor<?=$ped->pedi_id?>'  align="center">
                        <label for="vendedor_ped"><?=$ped->usua_nombre?></label>
                    </td>
                   
                    <td id='tdped_cant<?=$ped->pedi_id?>'  align="center">
                        <label for="cant_ped"><?=$ped->cantidad?></label>
                    </td>
                    
                    <td align="center">
                        <?=number_format($ped->total,2,'.',',')?>
                    </td>
                    
                    <td align="center" <?if($ped->total_sugerido!=$ped->total) echo 'style="color:red"'; ?> >
                        <?=number_format($ped->total_sugerido,2,'.',',')?>
                    </td>
                    
                    <td id='tdped_estado<?=$ped->pedi_id?>' align="center">
                        
                        <a href="" onclick="mostrar_estados('<?=$ped->pedi_id?>');return false;"
                         style="<?if($ped->pedi_estado=='A'){echo 'color:green';}?>
                                <?if($ped->pedi_estado=='E'){echo 'color:#00D5FF';}?>
                                <?if($ped->pedi_estado=='P'){echo 'color:blue';}?>
                                <?if($ped->pedi_estado=='AP'){echo 'color:#EB55F0';}?>
                                <?if($ped->pedi_estado=='N'){echo  'color:red';}?>
                                <?if($ped->pedi_estado=='F'){echo  'color:#05CE95';}?>
                         ">
                        <?if($ped->pedi_estado=='A'){echo  'Activo';}?>
                        <?if($ped->pedi_estado=='E'){echo  'Enviado';}?>
                        <?if($ped->pedi_estado=='P'){echo  'Pendiente';}?>
                        <?if($ped->pedi_estado=='AP'){echo 'Aprobado';}?>
                        <?if($ped->pedi_estado=='N'){echo  'Negado';}?>
                        <?if($ped->pedi_estado=='F'){echo  'Facturado';}?>
                        </a>
                          
                    </td>
                    
                     <td id='tdped_esta<?=$ped->pedi_id?>'  align="center">
                        <label style="color:#EB55F0" for="esta_ped"><?=$ped->rol_nombre?></label>
                    </td>
                    
                    <td id='tdped_tipo<?=$ped->pedi_id?>' align="center">
                        <label
                         style="<?if($ped->pedi_tipo=='F'){echo 'color:blue';}?>
                                <?if($ped->pedi_tipo=='PV'){echo 'color:green';}?>
                                <?if($ped->pedi_tipo=='PM'){echo 'color:red';}?>
                           ">
                        <?if($ped->pedi_tipo=='F'){echo 'Linea';}?>
                        <?if($ped->pedi_tipo=='PV'){echo 'Preventa';}?>
                        <?if($ped->pedi_tipo=='PM'){echo 'Promocion';}?>
                        </label>
                    </td>
                    <?if($tarjet!='seguir'):?>
                    <td align="center">
                             <?if($ped->pedi_estado=='A'):?>
                            <a href="<?=site_url()?>/pedidos/inicio/editar/<?=$ped->pedi_id?>">
                              <img class="qtip" src="<?php echo base_url()?>assets/images/edit.png" alt="Editar" />
                            </a>
                         <?endif;?>                        
                    </td>  
                    <td align="center">
                       <?if($ped->pedi_estado=='A'):?>                            
                          <img onclick="eliminar_pedido(<?=$ped->pedi_id?>,<?=$ped->total?>,<?=$ped->total_sugerido?>,<?=$ped->cantidad?>);" style=" cursor: pointer" class="qtip" src="<?php echo base_url()?>assets/images/cancel.png" alt="Eliminar" />
                       <?endif;?>                        
                    </td> 
                   <?endif;?> 
                </tr>
                <?endforeach;?>
            </tbody>
             <tfoot>
                  <tr>   
                    <th>&nbsp</th>  
                    <th align="center">&nbsp</th>
                    <th align="center">&nbsp</th>                    
                    <th align="center">&nbsp</th>
                    <th align="center">&nbsp</th>                    
                    <th align="center">&nbsp</th>                   
                    <th align="center" id="thtotal_cantidad"><?=number_format($total_cantidad,0,'.',',')?></th>
                    <input type="hidden" id="total_cantidad" value="<?=$total_cantidad?>" />
                    <th align="center" id="thtotal"><?=number_format($total,2,'.',',')?></th>
                    <input type="hidden" id="total" value="<?=$total?>" />
                    <th align="center" id="thtotal_sugerido"><?=number_format($total_sugerido,2,'.',',')?></th>
                    <input type="hidden" id="total_sugerido" value="<?=$total_sugerido?>" />
                    <th align="center">&nbsp</th>
                    <th align="center">&nbsp</th>                   
                    <th align="center">&nbsp</th>
                    <?if($tarjet!='seguir'):?>
                    <th align="center">&nbsp</th>  
                    <th align="center">&nbsp</th> 
                    <?endif;?> 
               </tr>
            </tfoot>
        </table>
       <div style=" height: 30px; padding-right:15px;  text-align: right" >
            <div id="link" style="padding: 10px; float: right; text-align: center">
                <form action="<?=site_url('pedidos/inicio/'.$tarjet)?>"  id="form_xpagin_2" method="post">
                <?=$this->pagination->create_links(2,$per_page)?>
                </form>
            </div>
        </div>       
      <?}else {?>
        <div style=" text-align: center"><h2>No se encontraron pedidos</h2></div>
      <?}?>

<?=$buscar_pedido_view?>
