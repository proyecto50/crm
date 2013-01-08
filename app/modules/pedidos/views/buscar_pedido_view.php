<div id="div_buscar_pedido" class="boxydiv boxy-content ">
    <form action="<?=site_url('pedidos/inicio/'.$tarjet)?>" id="form_buscar_pedido" method="post">
        <table class="formulario">
            <tr>
                <td>#Pedido</td>
                <td><input type="text" name="pedidos[pedi_id]" ></td>
            </tr>
            <tr>
                <td>Negocio</td>
                <td><input type="text" name="pedidos[clie_negocio]" ></td>
            </tr>
          
            <tr>
                <td>NIT/CC</td>
                <td><input type="text" name="pedidos[clie_cedula]" ></td>
            </tr>
            <tr>
                <td>Cliente</td>
                <td><input type="text" name="pedidos[clie_cliente]" ></td>
            </tr>
            <tr>
            <td >Vendedor</td>
                    <td>                         
                        <select name="pedidos[vend_id]" id="add_vendedor">
                           <option value="">Seleccionar</option>
                            <?if($sallers):?>
                           <?foreach($sallers->result() as $ve):?>
                           <option value="<?=$ve->usua_id?>"><?=$ve->usua_nombre?></option>
                           <?endforeach;?>
                           <?endif;?>
                        </select>                   
                    </td>
            </tr>
             
            <tr>
                <td>Fecha Inicio</td>
                <td><input type="text" name="pedidos[fi]" class="date-pick"></td>
            </tr>
             <tr>
                <td>Fecha Final</td>
                <td><input type="text" name="pedidos[ff]" class="date-pick" ></td>
            </tr>
            <tr>
            <td>Estado</td>
                    <td>
                        <select name="pedidos[pedi_estado]">
                           <option value="">Seleccionar</option>
                           <option value="A">Activo</option>
                           <option value="E">Enviado</option>
                           <option value="P">Pendiente</option>
                           <option value="Ap">Aprobado</option>
                           <option value="N">Negado</option>
                        </select>
                    </td>
            </tr>
            <tr>
            <td>Tipo</td>
                    <td>
                        <select name="pedidos[pedi_tipo]">
                           <option value="">Seleccionar</option>
                           <option value="F">Linea</option>
                           <option value="PV">Preventa</option>
                           <option value="PM">Promocion</option>
                        </select>
                    </td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="Buscar" id="buscar_pedido"></td>
            </tr>
        </table>
    </form>
</div>