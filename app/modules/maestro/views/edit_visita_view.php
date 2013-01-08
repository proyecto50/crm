<div id="div_edit_visita" class="boxydiv">
    <form action="<?=site_url('maestro/visitas/editar/')?>" id="form_edit_visita">
        <input type="hidden" id="txtid_edit_visita" name="id_edit_visita">
        <table class="formulario">
            <tr>
                <td>Codigo</td>
                <td><input type="text" id="txtcodigo_edit_visita" name="visitas[tvis_codigo]"></td>
            </tr>
            <tr>
                <td>Nombre</td>
                <td><input type="text" id="txtnombre_edit_visita" name="visitas[tvis_nombre]" ></td>
            </tr>
            <tr>
               <td>Estado </td>
	       <td align="center">
                   <select id="selectestado_edit_visita" name="visitas[tvis_estado]" >
                       <option value="A">Activo</option>
                       <option value="I">Inactivo</option>
                   </select>
               </td>
	    </tr>
           <tr>
                 <td></td>
                  <td><input type="button" value="Guardar" id="btnedit_visita"></td>
            </tr>
        </table>
    </form>
</div>