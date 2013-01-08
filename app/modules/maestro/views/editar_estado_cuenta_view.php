<div id="div_editar_estado_cuenta" class="boxydiv">
    <form action="<?=site_url('maestro/estado_cuenta/editar/')?>" id="form_editar_estado_cuenta">
        <input type="hidden" id="txtid_editar_estado_cuenta" name="id_editar_estc">
        <table class="formulario">
            <tr>
                <td>C&eacute;dula cliente</td>
                <td><input type="text" id="txtestc_clie_cedula" name="estados_cuenta[estc_clie_cedula]"></td>
            </tr>
             <tr>
                <td>Tipo Documento</td>
                <td><input type="text" id="txtestc_tipo_doc" name="estados_cuenta[estc_tipo_documento]"></td>
            </tr>
            <tr>
                <td>No. Documento</td>
                <td><input type="text" id="txtestc_factura" name="estados_cuenta[estc_factura]" ></td>
            </tr>
            <tr>
                <td>Fecha Inicial</td>
                <td><input type="text" id="txtestc_fecha" name="estados_cuenta[estc_fecha]" class="date-pick" ></td>
            </tr>
            <tr>
                <td>Fecha Final</td>
                <td><input type="text" id="txtestc_fechafin" name="estados_cuenta[estc_fecha_vencimiento]" class="date-pick"></td>
            </tr>
            <tr>
                <td>Dias Mora</td>
                <td><input type="text" id="txtestc_diasmora" name="estados_cuenta[estc_dias_mora]" ></td>
            </tr>
            <tr>
                <td>Saldo</td>
                <td><input type="text" id="txtestc_saldo" name="estados_cuenta[estc_saldo]" ></td>
            </tr>
            <tr>
                 <td></td>
                  <td><input type="button" value="Guardar" id="btneditarestc"></td>
            </tr>
        </table>
    </form>
</div>