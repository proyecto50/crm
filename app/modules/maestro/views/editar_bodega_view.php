<div id="div_editar_bodega" class="boxydiv">
    <form action="<?=site_url('maestro/bodegas/editar/')?>" id="form_editar_bodega">
       <input type="hidden" name="id_editar_bodega" id="txtid_editar_bodega" />
        <table class="formulario">
            <tr>
                <td>C&oacute;digo</td>
                <td><input type="text" id="txtcodigo_editar_bodega" name="bodegas[bode_codigo]" /></td>
            </tr>
            <tr>
                <td>Nombre</td>
                <td><input type="text" id="txtnombre_editar_bodega" name="bodegas[bode_nombre]" /></td>
            </tr>
            <tr>
                <td>Telefono</td>
                <td><input type="text" id="txttelefono_editar_bodega" name="bodegas[bode_telefono]" /></td>
            </tr>
            <tr>
                <td>Direcci&oacute;n</td>
                <td><input type="text" id="txtdireccion_editar_bodega"  name="bodegas[bode_direccion]" /></td>
            </tr>
            <tr>
                 <td >Estado</td>
                 <td>
                     <select id="selectestado_editar_bodega" name="bodegas[bode_estado]">
                             <option value="A">Activo</option>
                             <option value="I">Inactivo</option>
                      </select>
                 </td>
            </tr>
            <tr>
                <td>Descripci&oacute;n</td>
                <td ><textarea id="txtdescripcion_editar_bodega"  name="bodegas[bode_descripcion]" rows="2" cols="24"></textarea></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="button" value="Guardar" id="btneditar_bodega"></td>
            </tr>
        </table>
    </form>
</div>