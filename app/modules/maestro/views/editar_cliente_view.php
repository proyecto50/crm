<div id="div_editar_cliente" class="boxydiv">
    <form action="<?=site_url('maestro/clientes/editar/')?>" id="form_editar_cliente">
        <input type="hidden" id="txtid_editar_cliente" name="id_editar_cliente">
        <table class="formulario">
            
            <tr>
                <td>C&eacute;dula</td>
                <td><input type="text" id="txtcedula_editar_cliente" name="clientes[clie_cedula]" ></td>
            </tr>
            <tr>
                <td>Nombre</td>
                <td><input type="text"  id="txtnombre_editar_cliente" name="clientes[clie_cliente]" ></td>
            </tr>
            <tr>
                <td>Establecimiento</td>
                <td><input type="text"  id="txtnegocio_editar_cliente" name="clientes[clie_negocio]" ></td>
            </tr>
             <tr>
                <td>Direcci&oacute;n</td>
                <td><input type="text"  id="txtdireccion_editar_cliente" name="clientes[clie_direccion]"></td>
            </tr>
            <tr>
                <td>Tel&eacute;fono</td>
                <td><input type="text"  id="txttelefono_editar_cliente" name="clientes[clie_telefono]"></td>
            </tr>
             <tr>
                <td>Celular</td>
                <td><input type="text"  id="txtcelular_editar_cliente" name="clientes[clie_movil]"></td>
            </tr>
             <tr>
                <td>Ciudad</td>
                <td><input type="text"  id="txtciudad_editar_cliente" name="clientes[clie_ciudad]"></td>
            </tr>
            <tr>
                <td>Barrio</td>
                <td><input type="text"  id="txtbarrio_editar_cliente" name="clientes[clie_barrio]"></td>
            </tr>
            <tr>
                <td>Cupo</td>
                <td><input type="text"  id="txtcupo_editar_cliente" name="clientes[clie_cupo]"></td>
            </tr>
            <tr>
                <td>Sucursal</td>
                <td><input type="text" id="txtsucursal_editar_cliente" name="clientes[clie_sucursal]"></td>
            </tr>
            
             <tr>
               <td>Estado </td>
	       <td align="center">
                   <select id="selectestado_editar_cliente" name="clientes[clie_estado]" >
                       <option value="A">Activo</option>
                       <option value="I">Inactivo</option>
                   </select>
               </td>
	    </tr>
            <tr>
                 <td></td>
                  <td><input type="button" value="Guardar" id="btneditar_cliente"></td>
            </tr>
        </table>
    </form>
</div>
