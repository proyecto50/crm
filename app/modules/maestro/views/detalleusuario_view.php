<div class="comp_info_box">
    <form action="<?=site_url()?>maestro/detalleusuario/editar/<?=$usuario->usua_id?>" id="form_editar_detalleusuario" onclick="return false;">
        
    <table>
        <tr>
            <td><strong>Cedula</strong></td>
            <td><input type="text" value="<?=$usuario->usua_cedula?>" name="usuarios[usua_cedula]" /> </td>
        </tr>
        <tr>
            <td><strong>Nombre</strong></td>
            <td><input type="text" value="<?=$usuario->usua_nombre?>" name="usuarios[usua_nombre]" /> </td>
        </tr>
        <tr>
            <td><strong>Direcci&oacute;n</strong></td>
            <td><input type="text" value="<?=$usuario->usua_direccion?>" name="usuarios[usua_direccion]"/> </td>
        </tr>
        <tr>
            <td><strong>Teléfono</strong></td>
            <td><input type="text" value="<?=$usuario->usua_movil?>" name="usuarios[usua_movil]"> </td>
        </tr>
        <tr>
            <td><strong>Contrase&ntilde;a</strong></td>
            <td><input type="password" value="<?=$usuario->usua_clave?>" name="usuarios[usua_clave]"> </td>
        </tr>
        <tr>
            <td><strong>Bodega</strong></td>
                <td>
                 <select id="select_bodega" name="usuarios[usua_bode_id]" style="float: left">
                   <?if($bodegas):?>
                     <?foreach ($bodegas->result() as $bode ):?>
                      <option value="<?=$bode->bode_id?>" <?if($bode->bode_id==$usuario->usua_bode_id)echo 'selected="selected"';?>><?=$bode->bode_nombre?></option>
                    <?endforeach;?>
                    <?endif;?>
                </select>
                </td>
            </tr> 
         
         <tr>
            <td><strong>Rol</strong></td>
            <td><select  disabled="disabled">
                    <option value="<?=$usuario->rol_id?>"><?=$usuario->rol_nombre?></option>
                </select>
            </td>
           
        </tr>
    </table>
   </form>
</div>