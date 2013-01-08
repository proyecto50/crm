<div id="div_nueva_visita" class="boxydiv">
    <form action="<?=site_url('maestro/visitas/guardar/')?>" id="form_nueva_visita">
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
                  <td><input type="button" value="Guardar" id="btnguardar_visita"></td>
            </tr>
        </table>
    </form>
</div>