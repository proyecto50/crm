<div>
   <?if($transportadoras){?>
    <div style=" height: 30px; padding-right:15px;  text-align: right" >
        <div id="link" style="padding: 10px; float: right; text-align: center">
        <form action="<?=site_url('maestro/transportadoras/index')?>"  id="form_xpagin_1" method="post">
        <?=$this->pagination->create_links(1,$per_page)?>
        </form>

    </div>
    </div>
    <table border="0" width="100%" class="n_grid detail_table" id="n_grid" cellpadding="0" cellspacing="1">
        <thead>
            <tr>
                <th align="center">C&oacute;digo</th>
                <th align="center">Nombre</th>
                <th align="center">Estado</th>
                <th align="center">Editar</th>
           </tr>
        </thead>
        <tbody>
            <?foreach($transportadoras->result() as $row_transportadoras):?>
            <tr id='rowtran<?=$row_transportadoras->tran_id?>'>
                
                <td id='tdtran_cod<?=$row_transportadoras->tran_id?>'  align="center">
                     <label for="cod_tran"><?=$row_transportadoras->tran_codigo?></label>
                </td>
                <td id='tdtran_nom<?=$row_transportadoras->tran_id?>'  align="center">
                     <label for="nom_tran"><?=$row_transportadoras->tran_nombre?></label>
                </td>
                            
                <td id='tdtran_estado<?=$row_transportadoras->tran_id?>'  align="center">
                     <label for="estado_tran" 
                            style="<?if($row_transportadoras->tran_estado=='I'){echo 'color:red';}?>
                                   <?if($row_transportadoras->tran_estado=='A'){echo 'color:green';}?>">
                    <?if($row_transportadoras->tran_estado=='I'){echo 'Inactivo';}?>
                    <?if($row_transportadoras->tran_estado=='A'){echo 'Activo';}?>
                   </label>
                </td>
                <td id='tdtran_edit<?=$row_transportadoras->tran_id?>' align="center">
                  <a href="#" onclick="editar_transportadora('<?=$row_transportadoras->tran_codigo?>','<?=$row_transportadoras->tran_nombre?>','<?=$row_transportadoras->tran_estado?>','<?=$row_transportadoras->tran_id?>');return false;">
                   <img src="<?php echo base_url()?>assets/images/edit.png" title='Editar transportadora' />
                 </a>
                </td>
            </tr>
            <?endforeach;?>
        </tbody>
    </table>
   <div style=" height: 30px; padding-right:15px;  text-align: right" >
        <div id="link" style="padding: 10px; float: right; text-align: center">
        <form action="<?=site_url('maestro/transportadoras/index')?>"  id="form_xpagin_2" method="post">
        <?=$this->pagination->create_links(2,$per_page)?>
        </form>

    </div>
    </div>
   <?}else{?>
     <div>
      No se encontraron transportadoras.
    </div>
    <?}?>
</div>
<?=$vista_nueva_transportadora;?>
<?=$vista_editar_transportadora;?>
<?=$vista_buscar_transportadora;?>