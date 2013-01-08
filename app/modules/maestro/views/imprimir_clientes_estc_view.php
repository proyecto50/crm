<?if($detalle) { ?>
 <div style="text-align: center">
    <h1 style=" font-size: 12pt;">Detalle Cartera</h1>   
</div>
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
              </tr>
           </thead>
           <tbody>
            <?foreach($detalle->result() as $row_clie): ?>
               <tr>
                    <td align="center"><?=$row_clie->clie_cedula?></td>                
                    <td align="center"><?=$row_clie->clie_cliente?></td>
                    <td align="center"><?=$row_clie->estc_tipo_documento?></td>
                    <td align="center"><?=$row_clie->estc_factura?></td>
                    <td align="center"><?=$row_clie->estc_fecha?></td>
                    <td align="center"><?=$row_clie->estc_fecha_vencimiento?></td>
                    <td align="center"><?=$row_clie->estc_dias_mora?></td>
                    <td align="center"><?=$row_clie->estc_saldo?></td>
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
                    <th align="center"></th>
                    <th align="center"></th>
                   
              </tr>
           </tfoot>
</table>

<?}?>
