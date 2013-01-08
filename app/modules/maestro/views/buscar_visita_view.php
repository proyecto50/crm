<div id="div_buscar_visita" class="boxydiv">
    <form action="<?=site_url('maestro/visitas/index/')?>" id="form_buscar_visita" method="post">
        <table class="formulario">
            <tr>
                <td>Codigo</td>
                <td><input type="text" name="visitas[tvis_codigo]"></td>
            </tr>
            <tr>
                <td>Nombre</td>
                <td><input type="text" name="visitas[tvis_nombre]" ></td>
            </tr>
           <tr>
                 <td></td>
                  <td><input type="submit" value="Buscar" id="btnguardar_visita"></td>
            </tr>
        </table>
    </form>
</div>
