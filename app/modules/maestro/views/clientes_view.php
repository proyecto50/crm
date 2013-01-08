<div>
   <?if($clientes){?>
    <? $total=0?>
    <input type="hidden" id="url_estados_cliente" value="<?=site_url()?>maestro/clientes/mostrar_editar/"/>
    <div style=" height: 30px; padding-right:15px;  text-align: right" >
        <div id="link" style="padding: 10px; float: right; text-align: center">
        <form action="<?=site_url('maestro/clientes/index')?>"  id="form_xpagin_1" method="post">
        <?=$this->pagination->create_links(1,$per_page)?>
        </form>

    </div>
    </div>
    <table border="0" width="100%" class="n_grid detail_table" id="n_grid" cellpadding="0" cellspacing="1">
        <thead>
            <tr>
                <th align="center">C&eacute;dula</th>
                <th align="center">Nombre</th>
                <th align="center">Establecimiento</th>
                <th align="center">Direcci&oacute;n</th>
                <th align="center">Tel&eacute;fono</th>
                <th align="center">Celular</th>
                <th align="center">Ciudad</th>
                <th align="center">Barrio</th>
                <th align="center">Cupo</th>
                <th align="center">Sucursal</th>
                <th align="center">Fecha creacion</th>
                <th align="center">Estado</th>
                <th align="center">Editar</th>
            </tr>
         </thead>
        <tbody>
            <?foreach($clientes->result() as $cliente):?>
            
            <tr id='rowclie<?=$cliente->clie_id?>'>
                <?
                  $total+=$cliente->clie_cupo;
                ?>
                <td id='tdclie_ced<?=$cliente->clie_id?>'  align="center">
                    <a href="<?=site_url()?>/maestro/clientes/detalle/<?=$cliente->clie_id?>"><?=$cliente->clie_cedula?></a>
                </td>
                 <td id='tdclie_clie<?=$cliente->clie_id?>'  align="center">
                     <label for="cliente_clie"><?=$cliente->clie_cliente?></label>
                </td>
                 <td id='tdclie_neg<?=$cliente->clie_id?>'  align="center">
                     <label for="negocio_clie"><?=$cliente->clie_negocio?></label>
                </td>
                <td id='tdclie_dir<?=$cliente->clie_id?>'  align="center">
                     <label for="dir_clie"><?=$cliente->clie_direccion?></label>
                </td>
                 <td id='tdclie_tel<?=$cliente->clie_id?>'  align="center">
                     <label for="tel_clie"><?=$cliente->clie_telefono?></label>
                </td>
                 <td id='tdclie_mov<?=$cliente->clie_id?>'  align="center">
                     <label for="mov_clie"><?=$cliente->clie_movil?></label>
                </td>
                <td id='tdclie_ciu<?=$cliente->clie_id?>'  align="center">
                     <label for="ciu_clie"><?=$cliente->clie_ciudad?></label>
                </td>
                 <td id='tdclie_barr<?=$cliente->clie_id?>'  align="center">
                     <label for="barr_clie"><?=$cliente->clie_barrio?></label>
                </td>
                <td id='tdclie_cupo<?=$cliente->clie_id?>'  align="center">
                     <label for="cupo_clie"><?=number_format($cliente->clie_cupo,2,'.',',')?></label>
                     <input type="hidden" name="cupo_clie[]" value="<?=$cliente->clie_cupo?>"/>
                </td>
                 <td id='tdclie_suc<?=$cliente->clie_id?>'  align="center">
                     <label for="suc_clie"><?=$cliente->clie_sucursal?></label>
                </td>
                 <td id='tdclie_fecha<?=$cliente->clie_id?>'  align="center">
                     <label for="fecha_clie"><?=$cliente->clie_fechacreacion?></label>
                </td>
                <td id='tdclie_estado<?=$cliente->clie_id?>'  align="center">
                     <label for="estado_clie" 
                            style="<?if($cliente->clie_estado=='I'){echo 'color:red';}?>
                                   <?if($cliente->clie_estado=='A'){echo 'color:green';}?>">
                    <?if($cliente->clie_estado=='I'){echo 'Inactivo';}?>
                    <?if($cliente->clie_estado=='A'){echo 'Activo';}?>
                   </label>
                </td>
        
                <td id='tdclie_edit<?=$cliente->clie_id?>' align="center">
                    <a href="#" onclick="editar_cliente('<?=$cliente->clie_cedula?>','<?=$cliente->clie_cliente?>','<?=$cliente->clie_negocio?>','<?=$cliente->clie_direccion?>','<?=$cliente->clie_telefono?>','<?=$cliente->clie_movil?>','<?=trim($cliente->clie_ciudad)?>','<?=$cliente->clie_barrio?>','<?=$cliente->clie_fechacreacion?>','<?=$cliente->clie_cupo?>','<?=$cliente->clie_sucursal?>','<?=$cliente->clie_estado?>','<?=$cliente->clie_id?>');return false;">
                     <img class="qtip" src="<?php echo base_url()?>assets/images/edit.png" alt="Editar"/>
                    </a>
                </td>
            </tr>
            <?endforeach;?>
        </tbody>
         <tfoot>
                <tr>
                    <th align="center"></th>
                    <th align="center"></th>
                    <th align="center"></th>
                    <th align="center"></th>    
                    <th align="center"></th>                
                    <th  align="center"></th>
                    <th align="center"></th>
                    <th align="center"></th>               
                    <th align="center" id="thsuma_totalclie"><?=number_format($total,2,'.',',')?></th>               
                    <th align="center"></th>               
                    <th align="center"></th>               
                    <th align="center"></th>               
                    <th align="center"></th>               
                               
               </tr>
            </tfoot>
    </table>
   <div style=" height: 30px; padding-right:15px;  text-align: right" >
        <div id="link" style="padding: 10px; float: right; text-align: center">
        <form action="<?=site_url('maestro/clientes/index')?>"  id="form_xpagin_2" method="post">
        <?=$this->pagination->create_links(2,$per_page)?>
        </form>

    </div>
    </div>
  <?}else {?>
    <div>No se encontraron Clientes</div>
    <?}?>
</div>
<?=$vista_nuevo_cliente?>
<?=$vista_buscar_cliente?>
<?=$vista_editar_cliente?>