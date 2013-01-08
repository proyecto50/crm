<?if($creditos) { ?>
<div>
 <input type="hidden" id="url_estados_credito" value="<?=site_url()?>creditos/inicio/mostrar_estados/"/>
 <div style=" height: 30px; padding-right:15px;  text-align: right" >
        <div id="link" style="padding: 10px; float: right; text-align: center">
        <form action="<?=site_url('creditos/inicio/index')?>"  id="form_xpagin_1" method="post">
         <?=$this->pagination->create_links(1,$per_page)?>
        </form>
       </div>
 </div>
</div>
       <table border="0" width="100%" class="n_grid detail_table" id="n_grid" cellpadding="0" cellspacing="1">
           <input type="hidden" id="next" value="1">
           <thead>
               <tr>
                    <th align="center">Cedula </th>
                    <th align="center">Nombre</th>
                    <th align="center">Razon Social</th>
                    <th align="center">Actividad</th>
                    <th align="center">Telefono</th>
                    <th align="center">Familiar</th>
                    <th align="center">Parentesco</th>
                    <th align="center">Telefono</th>
                    <th align="center">Estado</th>
                    <th align="center">Fecha</th>
                    <th align="center">Editar</th>
              </tr>
           </thead>
           <tbody>              
            <?foreach ($creditos->result() as $cred):?>
              
             <tr id='rowcred<?=$cred->cred_id?>'>
                            
                <td id='tdcred_ced<?=$cred->cred_id?>'  align="center">
                     <a href="<?=site_url()?>/creditos/inicio/detalle/<?=$cred->cred_id?>">
                          <?=$cred->clie_cedula?>
                     </a>
                </td>
                 <td id='tdcred_nom<?=$cred->cred_id?>'  align="center">
                     <label for="nom_cred"><?=$cred->clie_cliente?></label>
                </td>
                 <td id='tdcred_raz1<?=$cred->cred_id?>'  align="center">
                     <label for="ref1_cred"><?=$cred->cred_razon1?></label>
                </td>
                <td id='tdcred_act1<?=$cred->cred_id?>'  align="center">
                     <label for="ref1_cred"><?=$cred->cred_actividad1?></label>
                </td>
                <td id='tdcred_tel1<?=$cred->cred_id?>'  align="center">
                     <label for="tel1_cred"><?=$cred->cred_tel1?></label>
                </td>
                 <td id='tdcred_nomfam<?=$cred->cred_id?>'  align="center">
                     <label for="ref2_cred"><?=$cred->cred_nombre1?></label>
                </td>
                 <td id='tdcred_parenfam<?=$cred->cred_id?>'  align="center">
                     <label for="tel2_cred"><?=$cred->cred_parentesco1?></label>
                </td>
                <td id='tdcred_telfam<?=$cred->cred_id?>'  align="center">
                     <label for="fecha_cred"><?=$cred->cred_tel_fam1?></label>
                </td>
               <td id='tdcred_estado<?=$cred->cred_id?>'  align="center">
                     <a  href="#" onclick="mostrar_estados_credito('<?=$cred->cred_id?>');return false;"
                            style="
                                   <?if($cred->cred_estado=='A'){echo 'color:green';}?>
                                   <?if($cred->cred_estado=='AP'){echo 'color:blue';}?>
                                   <?if($cred->cred_estado=='E'){echo 'color:blue';}?>
                                   <?if($cred->cred_estado=='N'){echo 'color:red';}?>
                                   <?if($cred->cred_estado=='P'){echo 'color:green';}?>
                             ">
                             <?if($cred->cred_estado=='A'){echo 'Activo';}?>
                             <?if($cred->cred_estado=='AP'){echo 'Aprobado';}?>
                             <?if($cred->cred_estado=='E'){echo 'Enviado';}?>
                             <?if($cred->cred_estado=='N'){echo 'Negado';}?>
                             <?if($cred->cred_estado=='P'){echo 'Pendiente';}?>
                     </a>
                   </label>
                </td>
                <td id='tdcred_fecha<?=$cred->cred_id?>'  align="center">
                     <label for="fecha_cred"><?=$cred->cred_fecha_sistema?></label>
                </td>
                <td align="center">
                             <?if($cred->cred_estado=='A' || $this->session->userdata('rol_nombre')=='GERENCIA'):?>
                              <a href="<?=site_url()?>/creditos/inicio/editar/<?=$cred->cred_id?>">
                               <img class="qtip" src="<?php echo base_url()?>assets/images/edit.png" alt="Editar" />
                              </a>
                            <?endif;?>                        
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
                    <th align="center"></th>
                    <th align="center"></th>
                    <th align="center"></th>
                    <th align="center"></th>
                    <th align="center"></th>
                    <th align="center"></th>
             </tr>
          </tfoot>
       </table>
  <div style=" height: 30px; padding-right:15px;  text-align: right" >
        <div id="link" style="padding: 10px; float: right; text-align: center">
        <form action="<?=site_url('creditos/inicio/index')?>"  id="form_xpagin_2" method="post">
        <?=$this->pagination->create_links(2,$per_page)?>
        </form>
    </div>
    </div>
<?} else{?>

<div>No se encontraron creditos</div>

<?}?>   
