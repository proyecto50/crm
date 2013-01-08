<div>
    <input type="hidden" id="url_completar_cliente" value="<?=site_url()?>pedidos/inicio/completar_cliente/"/>
    <form id="form_nuevo_pedido" action="<?=site_url()?>/pedidos/inicio/guardar" method="post" >
    <div class="compra_box">       
            <table>
                <tr>
                    <td>Numero</td>
                    <td>                       
                        <input name="pedido[pedi_numero]" readonly type="text" value="0" id="add_numero"/>                
                    </td>                    
                    <td style="text-align: right; padding-left: 20px" >Vendedor</td>
                    <td>                         
                        <select name="pedido[pedi_usua_id]" id="add_vendedor">
                           <?if($this->session->userdata('rol_nombre')!='VENDEDOR'){?> 
                           <option value="">Seleccionar</option>
                            <?if($vendedores):?>
                           <?foreach($vendedores->result() as $ve):?>
                           <option value="<?=$ve->usua_id?>"><?=$ve->usua_nombre?></option>
                           <?endforeach;?>
                           <?endif;?>
                           <?}else{?>
                           <option value="<?=$this->session->userdata('usuario_id')?>"><?=$this->session->userdata('usuario_nombre')?></option>
                           <?}?>
                        </select>                   
                    </td>
                </tr>
                <tr>
                    <td>Fecha</td>
                    <td>
                        <input name="pedido[pedi_fecha]" type="text" id="add_fecha" class="date-pick">
                    </td>

                    <td style="text-align: right">NIT/CC</td>
                    <td>
                        <input type="text" id="add_cedula" name="add_cedula"/>
                        <input name="pedido[pedi_clie_cedula]" type="hidden" id="add_clie_cedula"> 
                        <input name="pedido[pedi_clie_sucursal]" type="hidden" id="add_clie_sucursal"> 
                    </td>
                </tr>
               <tr>
                   <td>Forma Pago</td>
                    <td>
                        <select name="pedido[pedi_forma_pago]">
                           <option value="CR">CREDITO</option>
                           <option value="CO">CONTADO</option> 
                        </select>
                    </td>
                    <td style="text-align: right; padding-left: 20px">Nombre</td>
                    <td>
                        <input type="text" id="add_nombre" name="add_nombre">
                    </td>
                                      
                </tr>                
                  <tr>
                   <td>Dias Credito</td>
                   <td>
                        <input name="pedido[pedi_dias_credito]" value="0" type="text">
                    </td>
                  
                   <td style="text-align: right; padding-left: 20px">Estableci</td>
                   <td>
                        <input id="add_negocio" type="text" name="add_negocio">
                    </td> 
                 </tr> 
                <tr>
                   <td>Tipo</td>
                    <td>
                        <select name="pedido[pedi_tipo]">
                           <option value="F">LINEA</option>
                           <option value="PV">PREVENTA</option> 
                           <option value="PM">PROMOCION</option> 
                        </select>
                    </td>
                    <td style="text-align: right; padding-left: 20px">Prioridad</td>
                    <td>
                        <select id="selec_prioridad" name="pedido[pedi_prioridad]">
                           <option value="N">NORMAL</option>
                           <option value="A">ALTA</option>                          
                        </select>
                    </td>
                 </tr>                    
            </table>
         
         <textarea  placeholder="Comentarios" name="pedido[pedi_comentarios]" cols="69" rows="3" ></textarea>
          
    </div>

    <div>
            <a href="#" onclick="agregar_fila_producto();return false;">
                <img class="qtip" alt="Agregar un producto" src="<?php echo base_url()?>assets/images/add-row.png" />
            </a>        
    </div>
    <div>
        <table border="0" width="100%" class="n_grid detail_table" id="n_grid" cellpadding="0" cellspacing="1">
          <input type="hidden" id="next" value="1">
          <thead>
            <tr>               
                <th align="center">Codigo</th>
                <th align="center">Descripcion</th>                
                <th align="center">Cantidad</th>
                <th align="center">Precio</th>     
                <th align="center">Precio Sug</th>     
                <th align="center">Total</th> 
                <th align="center">Total Sug</th> 
                <th align="center">Fecha Entrega</th> 
                <th></th>                 
            </tr>
            </thead>
            <tbody>
              
            </tbody>
            <tfoot>
                <tr>
                <th align="center"></th>
                <th align="center"></th>
                <th align="center"></th>
                <th align="center"></th>    
                <th align="center"></th>                
                <th id="thsuma_total" align="center"></th>
                <th id="thsuma_total_sug" align="center"></th>
                <th></th>
                <th></th>
            </tr>
            </tfoot>
        </table>

    </div>
     <div>
            <a href="#" onclick="agregar_fila_producto();return false;">
                <img class="qtip" alt="agregar un producto" src="<?php echo base_url()?>assets/images/add-row.png" />
            </a>
    </div>
    </form>
</div>
<?=$vista_agregar_producto?>