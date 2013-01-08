<?if($detalle){?>
<?$total=0;?>
<div>
    <div class="compra_box">   
           <table>
                <tr>
                    <td style="padding-left: 20px"><strong>Cliente:</strong><?=$clientes->clie_cedula?></td>               
                    <td style="padding-left: 20px"><strong>Telefono:</strong> <?=$clientes->clie_telefono?></td>
                    <td style="padding-left: 20px"><strong>Ciudad:</strong> <?=$clientes->clie_ciudad?></td>
                </tr>
                <tr>
                    <td style="padding-left: 20px"><strong>Nombre:</strong><?=$clientes->clie_cliente?></td>  
                    <td style="padding-left: 20px"><strong>Direccion:</strong><?=$clientes->clie_direccion?></td>   
                    <td style="padding-left: 20px"><strong>Barrio:</strong><?=$clientes->clie_barrio?></td>   
               </tr>
                <tr>
                     <td style="padding-left: 20px"><strong>Establecimiento:</strong><?=$clientes->clie_negocio?></td>  
                      <td style="padding-left: 20px"><strong>Celular:</strong><?=$clientes->clie_movil?></td>
                      <td style="padding-left: 20px"><strong>Cupo:</strong> <?=number_format($clientes->clie_cupo,2,'.',',')?></td>
                </tr>
           </table>
    </div>
    <div>
        <table border="0" width="100%" class="n_grid detail_table" id="n_grid" cellpadding="0" cellspacing="1">
          
          <thead>
            <tr>               
                <th align="center">Cliente</th>
                <th align="center">Nombe</th>
                <th align="center">Tipo Documento</th>                
                <th align="center">No. Documento</th>
                <th align="center">Fecha Inicial</th>     
                <th align="center">Fecha Final</th>     
                <th align="center">Dias en mora</th>     
                <th align="center">Saldo</th> 
                <th align="center">Fecha Actualizacion</th> 
                              
            </tr>
            </thead>
            <tbody>
             <?if($detalle):?>
              <?foreach($detalle->result() as $d): ?>
                <? $total+= $d->estc_saldo ;?>
              
               <tr id="row<?=$d->estc_id?>" >

                    <td align="center"><label for="ced_estc"><?=$d->estc_clie_cedula?></label>
                    <td align="center"><label for="nombre_estc"><?=$clientes->clie_cliente?></label>
                    <td align="center"><label for="nombre_estc"><?=$d->estc_tipo_documento?></label>
                    <td align="center"><label for="nombre_estc"><?=$d->estc_factura?></label>
                    <td align="center"><label for="nombre_estc"><?=$d->estc_fecha?></label>
                    <td align="center"><label for="nombre_estc"><?=$d->estc_fecha_vencimiento?></label>
                    <td align="center"><label for="nombre_estc"><?=$d->estc_dias_mora?></label>
                    <td align="center"><label for="nombre_estc"><?=number_format($d->estc_saldo,2,'.',',')?></label>
                    <td align="center"><label for="nombre_estc"><?=$d->estc_fechasistema?></label>
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
                    <th  align="center"></th>
                    <th align="center"></th>
                    <th align="center"><?=number_format($total,2,'.',',')?></th>               
                    <th></th>               
               </tr>
            </tfoot>
        </table>

    </div>
</div>
<?}else{?>
 No se encontro detalle para esta cartera
<? } ?>
