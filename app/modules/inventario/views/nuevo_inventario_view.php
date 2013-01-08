<div id="div_nuevo_producto" class="boxydiv">
    <form action="<?=site_url('inventario/inicio/guardar/')?>" id="form_nuevo_producto">
       <table class="formulario">
            <tr>
                <td>Referencia</td>
                <td><input type="text" name="inventarios[inve_codigo]"></td>
            </tr>
            <tr>
                <td>Nombre Referencia</td>
                <td><input type="text" name="inventarios[inve_descripcion]" ></td>
            </tr>
            <tr>
                <td>Cantidad</td>
                <td><input type="text" name="inventarios[inve_cantidad]" ></td>
            </tr>
            <tr>
                <td>Precio Lista</td>
                <td><input type="text" name="inventarios[inve_precio_con_iva]" ></td>
            </tr>
             <tr>
                <td>%iva</td>
                <td><input type="text" name="inventarios[inve_porcentaje_iva]"></td>
            </tr>
            <tr>
                <td>Descuento</td>
                <td><input type="text" name="inventarios[inve_descuento]"></td>
            </tr>
            <tr>
                <td>Bodega</td>
                <td>
                 <select id="add_bodega" name="inventarios[inve_bode_id]" style="float: left">
                    <?if($bodegas):?>
                    <?foreach ($bodegas->result() as $bode ):?>
                     <option value="<?=$bode->bode_id?>"><?=$bode->bode_nombre?></option>
                    <?endforeach;?>
                  <?endif;?>
                </select>
                </td>
            </tr> 
           <tr>
                 <td></td>
                  <td><input type="button" value="Guardar" id="btnguardar_producto"></td>
            </tr>
        </table>
    </form>
</div>