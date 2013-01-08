<div>
    <table border="0" width="100%" class="n_grid detail_table" id="n_grid" cellpadding="0" cellspacing="1">
      <thead>
            <tr>               
                <th align="center">Fecha</th>
                <th align="center">Usuario</th>  
                <th align="center">F.Leido</th> 
                <th align="center">Enviado a</th>                
                <th align="center">Estado</th>     
                <th align="center">Comentarios</th>                        
            </tr>
      </thead>
            <tbody>
            <?if($estados):?>
              <?foreach($estados->result() as $e): ?>
                <tr>
                    <td align="center"><?=$e->esta_fecha?></td>
                    <td align="center"><?=$e->usua_nombre?></td>
                    <td align="center"><?=$e->leid_fecha?></td>
                    <td align="center"><?=$e->esta_enviado_a?></td>                    
                    <td align="center">
                        <label
                         style="<?if($e->esta_estado=='A'){echo 'color:green';}?>
                                <?if($e->esta_estado=='E'){echo 'color:#00D5FF';}?>
                                <?if($e->esta_estado=='P'){echo 'color:blue';}?>
                                <?if($e->esta_estado=='AP'){echo 'color:#EB55F0';}?>
                                <?if($e->esta_estado=='N'){echo  'color:red';}?>
                                <?if($e->esta_estado=='F'){echo  'color:#05CE95';}?>
                         ">
                        <?if($e->esta_estado=='A'){echo  'Activo';}?>
                        <?if($e->esta_estado=='E'){echo  'Enviado';}?>
                        <?if($e->esta_estado=='P'){echo  'Pendiente';}?>
                        <?if($e->esta_estado=='AP'){echo 'Aprobado';}?>
                        <?if($e->esta_estado=='N'){echo  'Negado';}?>
                        <?if($e->esta_estado=='F'){echo  'Facturado';}?>
                        </label>
                    </td>
                    <td align="center"><?=$e->esta_comentarios?></td>
                </tr>
              <?endforeach;?> 
              <?endif;?>  
            </tbody>
  </table>
</div>