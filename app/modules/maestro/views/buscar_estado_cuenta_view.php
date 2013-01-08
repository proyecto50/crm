<div id="div_search_estc" class="boxydiv">
    <form action="<?=site_url('maestro/estado_cuenta/index/')?>" id="form_search_estc" method="post">
        <table class="formulario">
            <tr>
                <td>C&eacute;dula</td>
                <td><input type="text" name="estados_cuenta[estc_clie_cedula]"></td>
            </tr>
             <tr>
                <td>Nombre</td>
                <td><input type="text" name="estados_cuenta[clie_cliente]"></td>
            </tr>
            <tr>
                <td>Tipo Documento</td>
                <td><input type="text" name="estados_cuenta[estc_tipo_documento]"></td>
            </tr>
            <tr>
                <td>Factura</td>
                <td><input type="text" name="estados_cuenta[estc_factura]" ></td>
            </tr>
           <tr>
                <td>Fecha Inicial Desde</td>
                <td><input type="text" name="estados_cuenta[estc_fecha_fi]" class="date-pick" ></td>
            </tr>
             <tr>
                <td>Fecha Inicial Hasta</td>
                <td><input type="text" name="estados_cuenta[estc_fecha_ff]" class="date-pick" ></td>
            </tr>
             <tr>
                <td>Fecha Vencimiento Desde</td>
                <td><input type="text" name="estados_cuenta[estc_fecha_vencimiento_fi]" class="date-pick" ></td>
            </tr>
             <tr>
                <td>Fecha Vencimiento Hasta</td>
                <td><input type="text" name="estados_cuenta[estc_fecha_vencimiento_ff]" class="date-pick" ></td>
            </tr>
                                       
            <tr>
                 <td></td>
                  <td><input type="submit" value="Buscar" id="btnbuscar_estc"></td>
            </tr>
        </table>
    </form>
</div>