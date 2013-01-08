<div>
   <?if($bodegas){?>
    <div style=" height: 30px; padding-right:15px;  text-align: right" >
        <div id="link" style="padding: 10px; float: right; text-align: center">
        <form action="<?=site_url('maestro/bodegas/index')?>"  id="form_xpagin_1" method="post">
        <?=$this->pagination->create_links(1,$per_page)?>
        </form>

    </div>
    </div>
    <table border="0" width="100%" class="n_grid detail_table" id="n_grid" cellpadding="0" cellspacing="1">
        <thead>
            <tr>
                <th align="center">C&oacute;digo</th>
                <th align="center">Nombre</th>
                <th align="center">Tel&eacute;fono</th>
                <th align="center">Direcci&oacute;n</th>
                <th align="center">Estado</th>
                <th align="center">Descripci&oacute;n</th>
                <th align="center">Estado</th>
                
            </tr>
        </thead>
        <tbody>
            <?foreach($bodegas->result() as $row_bodegas):?>
            <tr id='rowbode<?=$row_bodegas->bode_id?>'>
                
                <td id='tdbode_cod<?=$row_bodegas->bode_id?>'  align="center">
                     <label for="cod_bode"><?=$row_bodegas->bode_codigo?></label>
                </td>
                <td id='tdbode_nom<?=$row_bodegas->bode_id?>'  align="center">
                     <label for="nom_bode"><?=$row_bodegas->bode_nombre?></label>
                </td>
                <td id='tdbode_tel<?=$row_bodegas->bode_id?>'  align="center">
                     <label for="tel_bode"><?=$row_bodegas->bode_telefono?></label>
                </td>
                <td id='tdbode_dir<?=$row_bodegas->bode_id?>'  align="center">
                     <label for="dir_bode"><?=$row_bodegas->bode_direccion?></label>
                </td>
                <td id='tdbode_estado<?=$row_bodegas->bode_id?>'  align="center">
                     <label for="estado_bode" 
                            style="<?if($row_bodegas->bode_estado=='I'){echo 'color:red';}?>
                                   <?if($row_bodegas->bode_estado=='A'){echo 'color:green';}?>">
                    <?if($row_bodegas->bode_estado=='I'){echo 'Inactivo';}?>
                    <?if($row_bodegas->bode_estado=='A'){echo 'Activo';}?>
                   </label>
                </td>
                <td id='tdbode_desc<?=$row_bodegas->bode_id?>'  align="center">
                     <label for="desc_bode"><?=$row_bodegas->bode_descripcion?></label>
                </td>
                <td id='tdbode_edit<?=$row_bodegas->bode_id?>' align="center">
                <a href="#" onclick="editar_bodega('<?=$row_bodegas->bode_codigo?>','<?=$row_bodegas->bode_nombre?>','<?=$row_bodegas->bode_telefono?>','<?=$row_bodegas->bode_direccion?>','<?=$row_bodegas->bode_descripcion?>','<?=$row_bodegas->bode_estado?>','<?=$row_bodegas->bode_id?>');return false;">
                   <img src="<?php echo base_url()?>assets/images/edit.png" title='Editar bodega' />
                 </a>
                </td>
            </tr>
            <?endforeach;?>
        </tbody>
    </table>
   <div style=" height: 30px; padding-right:15px;  text-align: right" >
        <div id="link" style="padding: 10px; float: right; text-align: center">
        <form action="<?=site_url('maestro/bodegas/index')?>"  id="form_xpagin_2" method="post">
        <?=$this->pagination->create_links(2,$per_page)?>
        </form>

    </div>
    </div>
   <?}else{?>
     <div>
      No se encontraron bodegas.
    </div>
    <?}?>
</div>
<?=$vista_nueva_bodega?>
<?=$vista_editar_bodega?>
<?=$vista_buscar_bodega?>
