<div>
<div class="comp_info_box">
    <form action="<?=site_url()?>maestro/empresa/editar/<?=$empresa->comp_id?>" id="form_editar_empresa" onclick="return false;">
        <input type="hidden" name="id_empresa" value="<?=$empresa->comp_id?>">
    <table>
        <tr>
            <td><strong>Nombre</strong></td>
            <td><input type="text" value="<?=$empresa->comp_nombre?>" name="empresa[comp_nombre]"> </td>
        </tr>
        <tr>
            <td><strong>Nit</strong></td>
            <td><input type="text" value="<?=$empresa->comp_nit?>" name="empresa[comp_nit]"> </td>
        </tr>
        <tr>
            <td><strong>Direcci&oacute;n</strong></td>
            <td><input type="text" value="<?=$empresa->comp_direccion?>" name="empresa[comp_direccion]"> </td>
        </tr>
         <tr>
            <td><strong>Ciudad</strong></td>
            <td><input type="text" value="<?=$empresa->comp_ciudad?>"  name="empresa[comp_ciudad]"> </td>
            <td><strong>Dpto</strong></td>
            <td><input type="text" value="<?=$empresa->comp_departamento?>" name="empresa[comp_departamento]"> </td>
        </tr>
         <tr>
            <td><strong>Telefono</strong></td>
            <td><input type="text" value="<?=$empresa->comp_telefono?>" name="empresa[comp_telefono]"> </td>
            <td><strong>Fax</strong></td>
            <td><input type="text" value="<?=$empresa->comp_fax?>" name="empresa[comp_fax]"> </td>
        </tr>
         <tr>
            <td><strong>Email</strong></td>
            <td><input type="text" value="<?=$empresa->comp_email?>" name="empresa[comp_email]"> </td>
            <td><strong>Web</strong></td>
            <td><input type="text" value="<?=$empresa->comp_web?>" name="empresa[comp_resolucion]" /> </td>
        </tr>
        
    </table>
        <table style="text-align:center">
            <tr>
            <td><strong>Resolucion</strong></td>
            <td><textarea name="empresa[comp_resolucion]" cols="50" rows="3"><?=$empresa->comp_resolucion?></textarea> </td>
        </tr>
        </table>
            
       
</div>
</form>
</div>