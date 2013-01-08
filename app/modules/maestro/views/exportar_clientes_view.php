<?php 
header('Content-type: application/octet-stream');
header('Content-Disposition: attachment; filename=clientes.xls');
header('Pragma: no-cache');
header('Expires: 0');
?>
<?if($clientes) { ?>
 <div style="text-align: center">
    <h1 style=" font-size: 12pt;"><?=$this->session->userdata('compania_nombre')?></h1>   
</div>  
<table border="0" width="100%" class="n_grid detail_table" id="n_grid" cellpadding="0" cellspacing="1">
           <thead>
               <tr>
                   <th align="center">C&eacute;dula</th>
                    <th align="center">Nombre</th>
                    <th align="center">Establecimiento</th>
                    <th align="center">Direcci&oacute;n</th>
                    <th align="center">Tel&eacute;fono</th>
                    <th align="center">Celular</th>
                    <th align="center">Ciudad</th>
                    <th align="center">Barrio</th>
                    <th align="center">Cupo</th>
                    <th align="center">Estado</th>
                                               
                </tr>
           </thead>
           <tbody>
            <?foreach($clientes->result() as $row_clie): ?>
               <tr>
                    <td align="center"><?=$row_clie->clie_cedula?></td>                
                    <td align="center"><?=$row_clie->clie_cliente?></td>
                    <td align="center"><?=$row_clie->clie_negocio?></td>
                    <td align="center"><?=$row_clie->clie_direccion?></td>
                    <td align="center"><?=$row_clie->clie_telefono?></td>
                    <td align="center"><?=$row_clie->clie_movil?></td>
                    <td align="center"><?=$row_clie->clie_ciudad?></td>
                    <td align="center"><?=$row_clie->clie_barrio?></td>
                    <td align="center"><?=$row_clie->clie_cupo?></td>
                    <td align="center">
                      <label 
                            style="<?if($row_clie->clie_estado=='I'){echo 'color:red';}?>
                                   <?if($row_clie->clie_estado=='A'){echo 'color:green';}?>">
                       <?if($row_clie->clie_estado=='I'){echo 'Inactivo';}?>
                       <?if($row_clie->clie_estado=='A'){echo 'Activo';}?>
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
                    <th align="center"></th>
                    <th align="center"></th>
                    <th align="center"></th>
                    <th align="center"></th>
             
              </tr>
           </tfoot>
</table>

<?}?>
