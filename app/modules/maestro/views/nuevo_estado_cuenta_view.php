<div id="div_new_estado_cuenta" class="boxydiv">
    <form action="<?=site_url('maestro/estado_cuenta/guardar/')?>" id="form_new_estado_cuenta">
        <table class="formulario">
            <tr>
                <td>C&eacute;dula</td>
                <td><input type="text" name="estados_cuenta[estc_clie_cedula]"></td>
            </tr>
            <tr>
                <td>Tipo Documento</td>
                <td><input type="text" name="estados_cuenta[estc_tipo_documento]"></td>
            </tr>
            <tr>
                <td>No. Documento</td>
                <td><input type="text" name="estados_cuenta[estc_factura]" ></td>
            </tr>
            <tr>
                <td>Fecha Inicial</td>
                <td><input type="text" name="estados_cuenta[estc_fecha]" class="date-pick"></td>
            </tr>
            <tr>
                <td>Fecha Final</td>
                <td><input type="text" name="estados_cuenta[estc_fecha_vencimiento]" class="date-pick"></td>
            </tr>
            <tr>
                <td>Dias Mora</td>
                <td><input type="text" name="estados_cuenta[estc_dias_mora]" ></td>
            </tr>
             <tr>
                <td>Saldo</td>
                <td><input type="text" name="estados_cuenta[estc_saldo]"></td>
            </tr>
                                     
            <tr>
                 <td></td>
                  <td><input type="button" value="Guardar" id="btnguardar_estc"></td>
            </tr>
        </table>
    </form>
</div>