<div id="div_editar_producto" class="boxydiv">
    <form action="<?=site_url('inventario/inicio/editar/')?>" id="form_editar_producto">
       <input type="hidden" id="txtid_editar_producto" name="id_editar_producto">
       <input type="hidden" id="txtbode_editar_producto" name="bode_nombre">
       <table class="formulario">
            <tr>
                <td>Referencia</td>
                <td><input type="text" id="txtcod_edit_producto" name="inventarios[inve_codigo]"></td>
            </tr>
            <tr>
                <td>Nombre Referencia</td>
                <td><input type="text" id="txtdes_edit_producto" name="inventarios[inve_descripcion]" ></td>
            </tr>
            <tr>
                <td>Cantidad</td>
                <td><input type="text" id="txtcant_edit_producto" name="inventarios[inve_cantidad]" ></td>
            </tr>
            <tr>
                <td>Precio con iva</td>
                <td><input type="text" id="txtprecio_edit_producto" name="inventarios[inve_precio_con_iva]" ></td>
            </tr>
             <tr>
                <td>%iva</td>
                <td><input type="text" id="txtporc_edit_producto" name="inventarios[inve_porcentaje_iva]"></td>
            </tr>
            <tr>
                <td>Descuento</td>
                <td><input type="text" id="txtdescu_edit_producto" name="inventarios[inve_descuento]"></td>
            </tr>
            <tr>
                <td>Bodega</td>
                <td>
                 <select id="txtbode_edit_producto" name="inventarios[inve_bode_id]" style="float: left">
                    <?if($bodegas):?>
                    <?foreach ($bodegas->result() as $bode ):?>
                     <option value="<?=$bode->bode_id?>"><?=$bode->bode_nombre?></option>
                    <?endforeach;?>
                   <?endif;?>
                </select>
                </td>
            </tr>
            <tr>
               <td>Estado </td>
	       <td align="center">
                   <select id="selectestado_edit_producto" name="inventarios[inve_estado]" >
                       <option value="A">Activo</option>
                       <option value="I">Inactivo</option>
                   </select>
               </td>
	    </tr>
            <tr>
               <td>Tipo </td>
	       <td align="center">
                   <select id="selecttipo_edit_producto" name="inventarios[inve_tipo]" >
                       <option value="F">Firme</option>
                       <option value="PV">Preventa</option>
                       <option value="PM">Promocion</option>
                   </select>
               </td>
	    </tr>
           <tr>
                 <td></td>
                  <td><input type="button" value="Guardar" id="btneditar_producto"></td>
            </tr>
        </table>
    </form>
</div>