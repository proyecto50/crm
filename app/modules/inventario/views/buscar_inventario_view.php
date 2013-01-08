<div id="div_buscar_producto" class="boxydiv boxy-content ">
    <form action="<?=site_url('inventario/inicio/index/')?>" id="form_buscar_producto" method="post">
        <table class="formulario">
            <tr>
                <td>Referencia</td>
                <td><input type="text" name="inventarios[inve_codigo]"></td>
            </tr>
            <tr>
                <td>Nombre Refrencia</td>
                <td><input type="text" name="inventarios[inve_descripcion]" ></td>
            </tr>
            
            <tr>
                <td></td>
                <td><input type="submit" value="Buscar" id="btnbuscar_inveprod"></td>
            </tr>
        </table>
    </form>
</div>