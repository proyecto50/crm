<div id="div_buscar_transportadora" class="boxydiv">
    <form action="<?=site_url('maestro/transportadoras/index/')?>" id="form_buscar_transportadora" method="post">
        <table class="formulario">
            <tr>
                <td>Codigo</td>
                <td><input type="text" name="transportadoras[tran_codigo]"></td>
            </tr>
            <tr>
                <td>Nombre</td>
                <td><input type="text" name="transportadoras[tran_nombre]" ></td>
            </tr>
           <tr>
                 <td></td>
                  <td><input type="submit" value="Buscar" id="btnguardar_visita"></td>
            </tr>
        </table>
    </form>
</div>
