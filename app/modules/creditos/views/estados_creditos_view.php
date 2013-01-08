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
            <?if($creditos):?>
              <?foreach($creditos->result() as $cred): ?>
                <tr>
                    <td align="center"><?=$cred->esta_cred_fecha?></td>
                    <td align="center"><?=$cred->usua_nombre?></td>
                    <td align="center"><?=$cred->esta_cred_fecha?></td>
                    <td align="center"><?=$cred->esta_cred_enviado_a?></td>                    
                    <td align="center">
                        <label
                         style="<?if($cred->esta_cred_estado=='A'){echo 'color:green';}?>
                                <?if($cred->esta_cred_estado=='E'){echo 'color:#00D5FF';}?>
                                <?if($cred->esta_cred_estado=='P'){echo 'color:blue';}?>
                                <?if($cred->esta_cred_estado=='AP'){echo 'color:#EB55F0';}?>
                                <?if($cred->esta_cred_estado=='N'){echo  'color:red';}?>
                                <?if($cred->esta_cred_estado=='F'){echo  'color:#05CE95';}?>
                         ">
                        <?if($cred->esta_cred_estado=='A'){echo  'Activo';}?>
                        <?if($cred->esta_cred_estado=='E'){echo  'Enviado';}?>
                        <?if($cred->esta_cred_estado=='P'){echo  'Pendiente';}?>
                        <?if($cred->esta_cred_estado=='AP'){echo 'Aprobado';}?>
                        <?if($cred->esta_cred_estado=='N'){echo  'Negado';}?>
                        <?if($cred->esta_cred_estado=='F'){echo  'Facturado';}?>
                        </label>
                    </td>
                    <td align="center"><?=$cred->esta_cred_comentarios?></td>
                </tr>
              <?endforeach;?> 
              <?endif;?>  
            </tbody>
  </table>
</div>
