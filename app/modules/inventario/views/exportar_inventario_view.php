<?php 
header('Content-type: application/octet-stream');
header('Content-Disposition: attachment; filename=inventario.xls');
header('Pragma: no-cache');
header('Expires: 0');
$suma_total=0;
$total_row=0;
?>
<?if($inventarios) { ?>
 <div style="text-align: center">
    <h1 style=" font-size: 12pt;"><?=$this->session->userdata('compania_nombre')?></h1>   
</div>  
<table border="0" width="100%" class="n_grid detail_table" id="n_grid" cellpadding="0" cellspacing="1">
           <thead>
               <tr>
                    <th align="center">Referencia</th>
                    <th align="center">Nombre Referencia</th>
                    <th align="center">Cantidad</th>
                    <th align="center">Precio Lista</th>
                    <th align="center">%Iva</th>
                    <th align="center">Descuento</th>
                    <th align="center">Total</th>
                    <th align="center">Tipo</th>
                                                                 
                </tr>
           </thead>
           <tbody>
            <?foreach($inventarios->result() as $row_inv): ?>
               <?
                   $total_row=($row_inv->inve_precio_con_iva-$row_inv->inve_descuento)*$row_inv->inve_cantidad;
                   $suma_total+=$total_row;
               ?>
               <tr>
                    <td align="center"><?=$row_inv->inve_codigo?></td>                
                    <td align="center"><?=$row_inv->inve_descripcion?></td>
                    <td align="center"><?=$row_inv->inve_cantidad?></td>
                    <td align="center"><?=$row_inv->inve_precio_con_iva?></td>
                    <td align="center"><?=$row_inv->inve_porcentaje_iva?></td>
                    <td align="center"><?=$row_inv->inve_descuento?></td>
                    <td align="center"><?=number_format($total_row,2,'.',',')?></td>
                    <td align="center">
                         <label >
                           <?=($row_inv->inve_tipo=='F')? 'Firme':'';?>
                           <?=($row_inv->inve_tipo=='PV')? 'Preventa':'';?>
                           <?=($row_inv->inve_tipo=='PM')? 'Promocion':'';?>
                         </label>
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
                    <th align="center"><?=number_format($suma_total,2,'.',',')?></th>
                    <th align="center"></th>
            
        
        
              </tr>
           </tfoot>
</table>

<?}?>
