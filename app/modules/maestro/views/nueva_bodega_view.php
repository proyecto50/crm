<div id="div_nueva_bodega" class="boxydiv">
    <form action="<?=site_url('maestro/bodegas/guardar/')?>" id="form_nueva_bodega">
        <table class="formulario">
            <tr>
                <td>C&oacute;digo</td>
                <td><input type="text" name="bodegas[bode_codigo]" /></td>
            </tr>
            <tr>
                <td>Nombre</td>
                <td><input type="text" name="bodegas[bode_nombre]" /></td>
            </tr>
            
            <tr>
                <td>Tel&eacute;fono</td>
                <td><input type="text" name="bodegas[bode_telefono]" /></td>
            </tr>
            <tr>
                <td>Direcci&oacute;n</td>
                <td><input type="text" name="bodegas[bode_direccion]" /></td>
            </tr>
            <tr>
                <td>Descripci&oacute;n</td>
                <td ><textarea  name="bodegas[bode_descripcion]" rows="2" cols="24"></textarea></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="button" value="Guardar" id="btnguardar_bodega"></td>
            </tr>
        </table>
    </form>
</div>