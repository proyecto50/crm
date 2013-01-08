<div id="div_nueva_transportadora" class="boxydiv">
    <form action="<?=site_url('maestro/transportadoras/guardar/')?>" id="form_nueva_transportadora">
        <table class="formulario">
            <tr>
                <td>C&oacute;digo</td>
                <td><input type="text" name="transportadoras[tran_codigo]" /></td>
            </tr>
            <tr>
                <td>Nombre</td>
                <td><input type="text" name="transportadoras[tran_nombre]" /></td>
            </tr>
            
            <tr>
                <td></td>
                <td><input type="button" value="Guardar" id="btnguardar_transportadora"></td>
            </tr>
        </table>
    </form>
</div>