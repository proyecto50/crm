<?if($detalle) { ?>
 <div style="text-align: center">
    <h1 style=" font-size: 12pt;"><?=$this->session->userdata('compania_nombre')?></h1>   
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
                    <th align="center"></th>
                   
              </tr>
           </tfoot>
</table>

<?}?>
