<?
$suma_total = 0;
$total_row=0;
?>   
<?if($inventarios) { ?>
 <div style=" height: 30px; padding-right:15px;  text-align: right" >
        <div id="link" style="padding: 10px; float: right; text-align: center">
         <form action="<?=site_url('inventario/inicio/index')?>"  id="form_xpagin_1" method="post">
         <?=$this->pagination->create_links(1,$per_page)?>
        </form>
       </div>
 </div>
 <input type="hidden" id="url_delete_producto" value="<?=site_url('inventario/inicio/eliminar/')?>" />
        <table border="0" width="100%" class="n_grid detail_table" id="n_grid" cellpadding="0" cellspacing="1">
           <input type="hidden" id="next" value="1">
           <thead>
               <tr>
                    <th align="center">Referencia</th>
                    <th align="center">Nombre Referencia</th>
                    <th align="center">Cantidad</th>
                    <th align="center">Precio Lista</th>
                    <th align="center">Porcentaje iva</th>
                    <th align="center">Descuento</th>
                    <th align="center">Total</th>
                    <th align="center">Bodega</th>
                    <th align="center">Estado</th>
                    <th align="center">Fecha</th>
                    <th align="center">Tipo</th>
                    <th align="center">Editar</th>
                    <th align="center">Eliminar</th>
                  
                </tr>
           </thead>
           <tbody>              
            <?foreach ($inventarios->result() as $inv):?>
               <?
                   $total_row=($inv->inve_precio_con_iva-$inv->inve_descuento)*$inv->inve_cantidad;
                   $suma_total+=$total_row;
               ?>
             <tr id='rowinv<?=$inv->inve_id?>'>
                            
                <td id='tdinv_cod<?=$inv->inve_id?>'  align="center">
                     <label for="cod_inve"><?=$inv->inve_codigo?></label>
                      <input type="hidden" id="txtrowid<?=$inv->inve_id?>" value="<?=$inv->inve_id?>">
                </td>
                 <td id='tdinv_des<?=$inv->inve_id?>'  align="center">
                     <label for="des_inve"><?=$inv->inve_descripcion?></label>
                </td>
                 <td id='tdinv_cant<?=$inv->inve_id?>'  align="center">
                     <label for="cant_inve"><?=number_format($inv->inve_cantidad,2,'.',',')?></label>
                </td>
                <td id='tdinv_precio<?=$inv->inve_id?>'  align="center">
                     <label for="precio_inve"><?=number_format($inv->inve_precio_con_iva,2,'.',',')?></label>
                </td>
                 <td id='tdinv_porc<?=$inv->inve_id?>'  align="center">
                     <label for="porc_inve"><?=number_format($inv->inve_porcentaje_iva,2,'.',',')?></label>
                </td>
                 <td id='tdinv_descu<?=$inv->inve_id?>'  align="center">
                     <label for="descu_inve"><?=number_format($inv->inve_descuento,2,'.',',')?></label>
                </td>
                <td id='tdinv_total<?=$inv->inve_id?>'  align="center">
                     <label for="total_inve"><?=number_format($total_row,2,'.',',')?></label>
                     <input type="hidden" name="total_producto[]" value="<?=$total_row?>"/>
                </td>
                 <td id='tdinv_bod<?=$inv->inve_id?>'  align="center">
                     <label for="bod_inve"><?=$inv->bode_nombre?></label>
                </td>
               
                 <td id='tdinv_estado<?=$inv->inve_id?>'  align="center">
                     <label for="estado_inve" 
                            style="<?if($inv->inve_estado=='I'){echo 'color:red';}?>
                                   <?if($inv->inve_estado=='A'){echo 'color:green';}?>">
                    <?if($inv->inve_estado=='I'){echo 'Inactivo';}?>
                    <?if($inv->inve_estado=='A'){echo 'Activo';}?>
                   </label>
                </td>
                <td id='tdinv_fecha<?=$inv->inve_id?>'  align="center">
                     <label for="fecha_inve"><?=$inv->inve_fecha?></label>
                </td>
                <td id='tdinv_tipo<?=$inv->inve_id?>'  align="center">
                     <label for="tipo_inve">
                       <?=($inv->inve_tipo=='F')? 'Firme':'';?>
                       <?=($inv->inve_tipo=='PV')? 'Preventa':'';?>
                       <?=($inv->inve_tipo=='PM')? 'Promocion':'';?>
                     </label>
                </td>
                 <td id='tdinv_edit<?=$inv->inve_id?>' align="center">
                   <a href="" onclick="editar_producto('<?=$inv->inve_codigo?>','<?=$inv->inve_descripcion?>','<?=$inv->inve_cantidad?>','<?=$inv->inve_precio_con_iva?>','<?=$inv->inve_porcentaje_iva?>','<?=$inv->inve_descuento?>','<?=$inv->inve_bode_id?>','<?=$inv->bode_nombre?>','<?=$inv->inve_estado?>','<?=$inv->inve_fecha?>','<?=$inv->inve_tipo?>','<?=$inv->inve_id?>');return false;">
                    <img class="qtip" src="<?php echo base_url()?>assets/images/edit.png" alt="Editar"/>
                   </a>
                 </td>
                <td id='tdinv_delete<?=$inv->inve_id?>' align="center">                 
                   <img style=" cursor: pointer" onclick="eliminar_producto('<?=$inv->inve_id?>','<?=$inv->inve_codigo?>')" src="<?php echo base_url()?>assets/images/del-row.png" alt="Eliminar"/>                
                </td>
            </tr>
            <?endforeach;?>
          </tbody>
          <tfoot>
               <tr>
                    <th align="center"></th>
                    <th align="center"></th>
                    <th align="center"></th>
                    <th align="center"></th>
                    <th align="center"></th>
                    <th align="center"></th>
                   <th id="thsumatotal" align="center">
                     <?=number_format($suma_total,2,'.',',')?>
                   </th>
                    <th align="center"></th>
                    <th align="center"></th>
                    <th align="center"></th>
                    <th align="center"></th>
                    <th align="center"></th>
                    <th align="center"></th>
                </tr>
          </tfoot>
       </table>
  <div style=" height: 30px; padding-right:15px;  text-align: right" >
        <div id="link" style="padding: 10px; float: right; text-align: center">
        <form action="<?=site_url('inventario/inicio/index')?>"  id="form_xpagin_2" method="post">
        <?=$this->pagination->create_links(2,$per_page)?>
        </form>
    </div>
    </div>
<?} else{?>

<div>No se encontraron productos en el inventario.</div>

<?}?>   
<?=$vista_nuevo_inventario?>
<?=$vista_editar_inventario?>
<?=$vista_buscar_inventario?>