<div id="div_agregar_producto_pedido" class="boxydiv">
   <input type="hidden" id="url_completar_codigo_insumo" value="<?=site_url("pedidos/inicio/completar_codigo_insumo/")?>"/>
   <form action="" id="form_agregar_producto_pedido">
    <table class="formulario">         
        <tr>
            <td>Referencia</td>
            <td><input style="float: left" type="text" id="id_codigo_agregarp" name="add_codigo"/>
                <input type="hidden" id="id_pro_id_agregarp" name="add_codigo"/>
            </td>
        </tr>
        <tr>
            <td>Nombre Referencia</td>
            <td><input type="text" id="id_nombre_agregarp" name="add_nombre"/> </td>
        </tr>        
        <tr>
            <td>Cantidad</td>
            <td><input type="text" id="id_cantidad_agregarp" name="add_cantidad" class="costxunt"/> </td>
        </tr>
        <tr>
            <td>Precio</td>
            <td><input type="text" id="id_precio_agregarp" name="add_precio" class="preciotxunt" readonly="true"/> </td>
        </tr>  
        <tr>
            <td>Precio Sugerido</td>
            <td><input type="text" id="id_precio_sug_agregarp" name="add_precio_sug" class="preciosugtxunt" /> </td>
        </tr>  
        <tr>
            <td>%Iva</td>
            <td>
                <input style="float: left"  type="text" id="id_iva_agregarp" name="add_iva" value="16"/>
                <input type="hidden" id="id_pro_id_agregarp" name="add_codigo"/>
            </td>
        </tr> 
        <tr>
            <td>Fecha LLegada</td>
            <td>
                <input style="float: left"  type="text" id="id_fecha_agregarp" name="add_fecha" class="date-pick"/>
           </td>
        </tr> 
         <tr>
            <td></td>
            <td><input type="button" value="enviar" id="enviar_producto"/> </td>
        </tr>
    </table>
    </form>
</div>