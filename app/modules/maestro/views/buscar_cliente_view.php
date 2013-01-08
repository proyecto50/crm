<div id="div_buscar_cliente" class="boxydiv boxy-content ">
    <form action="<?=site_url('maestro/clientes/index/')?>" id="form_buscar_cliente" method="post">
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
                <td></td>
                <td><input type="submit" value="Buscar" id="buscar_cliente"></td>
            </tr>
        </table>
    </form>
</div>