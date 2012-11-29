<div id="div_buscar_bodega" class="boxydiv">
    <form method="post" action="<?=site_url('maestro/bodegas/index/')?>" id="form_buscar_bodega">
         <table class="formulario" >
            <tr>
                <td>C&oacute;digo</td>
                <td><input type="text" name="bodegas[bode_codigo]" /></td>
            </tr>
            <tr>
                <td>Nombre</td>
                <td><input type="text" name="bodegas[bode_nombre]" /></td>
            </tr>
            <tr>
                     <td >Estado</td>
                     <td>
                         <select  name="bodegas[bode_estado]">
                             <option value="">Seleccionar</option>
                             <option value="A">Activo</option>
                             <option value="I">Inactivo</option>
                         </select>
                     </td>
             </tr>
             <tr>
                <td></td>
                <td><input type="submit" value="Buscar" id="btnbuscar_bodega" /></td>
            </tr>
        </table>
    </form>
</div>