<?$total=0;?>
<div>
   <?if($estado_cuentas){?>
    <div style=" height: 30px; padding-right:15px;  text-align: right" >
        <div id="link" style="padding: 10px; float: right; text-align: center">
        <form action="<?=site_url('maestro/estado_cuenta/index')?>"  id="form_xpagin_1" method="post">
        <?=$this->pagination->create_links(1,$per_page)?>
        </form>
       </div>
    </div>
    <input type="hidden" id="url_delete_estc" value="<?=site_url('maestro/estado_cuenta/eliminar/')?>" />
    <table border="0" width="100%" class="n_grid detail_table" id="n_grid" cellpadding="0" cellspacing="1">
        <thead>
            <tr>
                <th align="center">Cliente</th>
                <th align="center">Nombre</th>
                <th align="center">Tipo Documento</th>
                <th align="center">No. Documento</th>
                <th align="center">Fecha Inicial</th>
                <th align="center">Fecha Final</th>
                <th align="center">Dias en mora</th>
                <th align="center">Saldo</th>
                <th align="center">Fecha Actualizacion</th>
                <th align="center">Editar</th>
                <th align="center">Eliminar</th>
            </tr>
         </thead>
        <tbody>
            <?foreach($estado_cuentas->result() as $estc):?>
            <?$total+=$estc->estc_saldo;?>
            <tr id='rowestc<?=$estc->estc_id?>'>
                              
                <td id='tdestc_ced<?=$estc->estc_id?>'  align="center">
                     <label for="cedula_estc"><?=$estc->estc_clie_cedula?></label>
                     <input type="hidden" id="txtrow_estcid<?=$estc->estc_id?>" value="<?=$estc->estc_id?>">
                </td>
                <td id='tdestc_nom<?=$estc->estc_id?>'  align="center">
                     <label for="nom_estc" style="<?if($estc->clie_cliente==''){echo 'color:red';}?>">
                      <?=($estc->clie_cliente=='')? 'Pendiente': $estc->clie_cliente ?>
                     </label>
                </td>
                <td id='tdestc_tipodoc<?=$estc->estc_id?>'  align="center">
                     <label for="tipodoc_estc"><?=$estc->estc_tipo_documento?></label>
                </td>
                 <td id='tdestc_factura<?=$estc->estc_id?>'  align="center">
                     <label for="factura_estc"><?=$estc->estc_factura?></label>
                </td>
                <td id='tdestc_fechini<?=$estc->estc_id?>'  align="center">
                     <label for="fechini_estc"><?=$estc->estc_fecha?></label>
                </td>
                <td id='tdestc_fechfin<?=$estc->estc_id?>'  align="center">
                     <label for="fechfin_estc"><?=$estc->estc_fecha_vencimiento?></label>
                </td>
                 <td id='tdestc_mora<?=$estc->estc_id?>'  align="center">
                     <label for="mora_estc"><?=$estc->estc_dias_mora?></label>
                </td>
                 <td id='tdestc_sald<?=$estc->estc_id?>'  align="center">
                     <label for="saldo_estc"><?=number_format($estc->estc_saldo,2,'.',',')?></label>
                     <input type="hidden" name="saldo_estc[]" value="<?=$estc->estc_saldo?>"/>
                </td>
                <td id='tdestc_fechactu<?=$estc->estc_id?>'  align="center">
                     <label for="fechactu_estc"><?=$estc->estc_fechasistema?></label>
                </td>
                <td id='tdestc_edit<?=$estc->estc_id?>' align="center">
                <a href="" onclick="editar_estc('<?=$estc->estc_clie_cedula?>','<?=$estc->clie_cliente?>','<?=$estc->estc_tipo_documento?>','<?=$estc->estc_factura?>','<?=$estc->estc_fecha?>','<?=$estc->estc_fecha_vencimiento?>','<?=$estc->estc_dias_mora?>','<?=$estc->estc_saldo?>','<?=$estc->estc_fechasistema?>','<?=$estc->estc_usua_id?>','<?=$estc->estc_id?>');return false;">
                   <img class="qtip" src="<?php echo base_url()?>assets/images/edit.png" alt="Editar"/>
                 </a>
                </td>
                <td id='tdestc_delete<?=$estc->estc_id?>' align="center">
                   <img onclick="eliminar_estc(<?=$estc->estc_id?>);" style=" cursor: pointer" class="qtip" src="<?php echo base_url()?>assets/images/cancel.png" alt="Eliminar" />
                </td> 
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
                    <th align="center">&nbsp</th>
                    <th align="center" id="thsumatotalestc"><?=number_format($total,2,'.',',')?></th>
                    <th align="center">&nbsp</th>
                    <th align="center" ></th>
                    <th align="center" ></th>
             </tr>
            </tfoot>
    </table>
   <div style=" height: 30px; padding-right:15px;  text-align: right" >
        <div id="link" style="padding: 10px; float: right; text-align: center">
        <form action="<?=site_url('maestro/estado_cuenta/index')?>"  id="form_xpagin_2" method="post">
        <?=$this->pagination->create_links(2,$per_page)?>
        </form>

    </div>
    </div>
  <?}else {?>
    <div>No se encontraron estados de cuenta</div>
    <?}?>
</div>
<?=$vista_nuevo_estado_cuenta?>
<?=$vista_editar_estado_cuenta?>
<?=$vista_buscar_estado_cuenta?>