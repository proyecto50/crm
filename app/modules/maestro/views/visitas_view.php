<div>
   <?if($visitas){?>
    <div style=" height: 30px; padding-right:15px;  text-align: right" >
        <div id="link" style="padding: 10px; float: right; text-align: center">
        <form action="<?=site_url('maestro/visitas/index')?>"  id="form_xpagin_1" method="post">
        <?=$this->pagination->create_links(1,$per_page)?>
        </form>

    </div>
    </div>
    <table border="0" width="100%" class="n_grid detail_table" id="n_grid" cellpadding="0" cellspacing="1">
        <thead>
            <tr>
                <th align="center">Codigo</th>
                <th align="center">Nombre</th>
                <th align="center">Estado</th>
                <th align="center">Editar</th>
            </tr>
         </thead>
        <tbody>
            <?foreach($visitas->result() as $visit):?>
            
            <tr id='rowvisit<?=$visit->tvis_id?>'>
                
                <td id='tdvisit_cod<?=$visit->tvis_id?>'  align="center">
                     <label for="cod_visit"><?=$visit->tvis_codigo?></label>
                </td>
                 <td id='tdvisit_nom<?=$visit->tvis_id?>'  align="center">
                     <label for="nom_visit"><?=$visit->tvis_nombre?></label>
                </td>
                <td id='tdvisit_estado<?=$visit->tvis_id?>'  align="center">
                     <label for="estado_visit" 
                            style="<?if($visit->tvis_estado=='I'){echo 'color:red';}?>
                                   <?if($visit->tvis_estado=='A'){echo 'color:green';}?>">
                    <?if($visit->tvis_estado=='I'){echo 'Inactivo';}?>
                    <?if($visit->tvis_estado=='A'){echo 'Activo';}?>
                   </label>
                </td>
                
                <td id='tdvisit_edit<?=$visit->tvis_id?>' align="center">
                <a href="" onclick="edit_visit('<?=$visit->tvis_codigo?>','<?=$visit->tvis_nombre?>','<?=$visit->tvis_estado?>','<?=$visit->tvis_id?>');return false;">
                   <img class="qtip" src="<?php echo base_url()?>assets/images/edit.png" alt="Editar"/>
                 </a>
                </td>
            </tr>
            <?endforeach;?>
        </tbody>
    </table>
   <div style=" height: 30px; padding-right:15px;  text-align: right" >
        <div id="link" style="padding: 10px; float: right; text-align: center">
        <form action="<?=site_url('maestro/visitas/index')?>"  id="form_xpagin_2" method="post">
        <?=$this->pagination->create_links(2,$per_page)?>
        </form>

    </div>
    </div>
  <?}else {?>
    <div>No se encontraron visitas</div>
    <?}?>
</div>
<?=$vista_nueva_visita?>
<?=$vista_editar_visita?>
<?=$vista_buscar_visita?>
