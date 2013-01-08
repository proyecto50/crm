<div id="div_nuevo_cliente" class="boxydiv">
    <form action="<?=site_url('maestro/clientes/guardar/')?>" id="form_nuevo_cliente">
        <table class="formulario">
            <tr>
                <td>C&eacute;dula</td>
                <td><input type="text" name="clientes[clie_cedula]"></td>
            </tr>
            <tr>
                <td>Nombre</td>
                <td><input type="text" name="clientes[clie_cliente]" ></td>
            </tr>
            <tr>
                <td>Establecimiento</td>
                <td><input type="text" name="clientes[clie_negocio]" ></td>
            </tr>
             <tr>
                <td>Direcci&oacute;n</td>
                <td><input type="text" name="clientes[clie_direccion]"></td>
            </tr>
            <tr>
                <td>Tel&eacute;fono</td>
                <td><input type="text" name="clientes[clie_telefono]"></td>
            </tr>
             <tr>
                <td>Celular</td>
                <td><input type="text" name="clientes[clie_movil]"></td>
            </tr>
             <tr>
                <td>Ciudad</td>
                <td><input type="text" name="clientes[clie_ciudad]"></td>
            </tr>
            <tr>
                <td>Barrio</td>
                <td><input type="text" name="clientes[clie_barrio]"></td>
            </tr>
            <tr>
                <td>Cupo</td>
                <td><input type="text" name="clientes[clie_cupo]"></td>
            </tr>
            <tr>
                <td>Sucursal</td>
                <td><input type="text" name="clientes[clie_sucursal]"></td>
            </tr>
            
            <tr>
                 <td></td>
                  <td><input type="button" value="Guardar" id="btnguardar_cliente"></td>
            </tr>
        </table>
    </form>
</div>