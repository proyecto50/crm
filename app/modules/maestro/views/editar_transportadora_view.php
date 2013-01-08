<div id="div_editar_transportadora" class="boxydiv">
    <form action="<?=site_url('maestro/transportadoras/editar/')?>" id="form_editar_transportadora">
       <input type="hidden" name="id_editar_transportadora" id="txtid_editar_transportadora" />
        <table class="formulario">
            <tr>
                <td>C&oacute;digo</td>
                <td><input type="text" id="txtcodigo_editar_transportadora" name="transportadoras[tran_codigo]" /></td>
            </tr>
            <tr>
                <td>Nombre</td>
                <td><input type="text" id="txtnombre_editar_transportadora" name="transportadoras[tran_nombre]" /></td>
            </tr>
            <tr>
                 <td >Estado</td>
                 <td>
                     <select id="selectestado_editar_transportadora" name="transportadoras[tran_estado]">
                             <option value="A">Activo</option>
                             <option value="I">Inactivo</option>
                      </select>
                 </td>
            </tr>
            <tr>
                <td></td>
                <td><input type="button" value="Guardar" id="btneditar_transportadora"></td>
            </tr>
        </table>
    </form>
</div>
