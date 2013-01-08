<?
  if($creditos){
?>
<div >
    <form action="<?=site_url('creditos/inicio/guardar_editar/')?>" id="form_editar_credito" method="post">
    <input type="hidden" id="txtclie_id" name="clie_id" value="<?=$creditos->clie_id?>"/>
    <input type="hidden" id="txtcred_id" name="cred_id" value="<?=$creditos->cred_id?>"/>
       <div class="credito_box">
        <table style="border-spacing:5pt">
           <tr>
                <th colspan="2">Datos del cliente</th>
            </tr>
            <tr>
                <td>C&eacute;dula</td>
                <td>
                    <input type="text" name="clientes[clie_cedula]" value="<?=$creditos->clie_cedula?>">
                </td>
                 <td>Nombre</td>
                 <td><input type="text" name="clientes[clie_cliente]" value="<?=$creditos->clie_cliente?>" ></td>
                 <td>Negocio</td>
                 <td><input type="text" name="clientes[clie_negocio]" value="<?=$creditos->clie_negocio?>"></td>
                 <td>Direcci&oacute;n</td>
                <td><input type="text" name="clientes[clie_direccion]" value="<?=$creditos->clie_direccion?>"></td>
               
            </tr>
            <tr>
                <td>Tel&eacute;fono</td>
                <td><input type="text" name="clientes[clie_telefono]" value="<?=$creditos->clie_telefono?>"></td>
                 <td>Celular</td>
                <td><input type="text" name="clientes[clie_movil]" value="<?=$creditos->clie_movil?>"></td>
                 <td>Barrio</td>
                <td><input type="text" name="clientes[clie_barrio]" value="<?=$creditos->clie_barrio?>"></td>
                 <td>Ciudad</td>
                <td><input type="text" name="clientes[clie_ciudad]" value="<?=$creditos->clie_ciudad?>"></td>
            </tr>
            <tr>
                <td>Cupo</td>
                <td><input type="text" name="clientes[clie_cupo]" value="<?=$creditos->clie_cupo?>"></td>               
            </tr>
            <tr>
                 <th colspan="2" >Referencias comerciales</th>
            </tr>
             <tr>
                 <td style="width:150">Razon social1</td>
                 <td><input type="text" name="creditos[cred_razon1]" value="<?=$creditos->cred_razon1?>"></td>
                 <td>Actividad1</td>
                 <td><input type="text" name="creditos[cred_actividad1]" value="<?=$creditos->cred_actividad1?>"></td>
                 <td>Telefono1</td>
                 <td><input type="text" name="creditos[cred_tel1]" value="<?=$creditos->cred_tel1?>"></td>
                 <td>Ciudad1</td>
                 <td><input type="text" name="creditos[cred_ciudad1]" value="<?=$creditos->cred_ciudad1?>"></td>
            </tr>
            <tr>
                 <td>Razon social2</td>
                 <td><input type="text" name="creditos[cred_razon2]" value="<?=$creditos->cred_razon2?>"></td>
                 <td>Actividad2</td>
                 <td><input type="text" name="creditos[cred_actividad2]" value="<?=$creditos->cred_actividad2?>"></td>
                 <td>Telefono2</td>
                 <td><input type="text" name="creditos[cred_tel2]" value="<?=$creditos->cred_tel2?>"></td>
                 <td>Ciudad2</td>
                 <td><input type="text" name="creditos[cred_ciudad2]" value="<?=$creditos->cred_ciudad2?>"></td>
           </tr>
             <tr>
                <td>Razon social3</td>
                 <td><input type="text" name="creditos[cred_razon3]" value="<?=$creditos->cred_razon3?>"></td>
                 <td>Actividad3</td>
                 <td><input type="text" name="creditos[cred_actividad3]" value="<?=$creditos->cred_actividad3?>"></td>
                 <td>Telefono3</td>
                 <td><input type="text" name="creditos[cred_tel3]" value="<?=$creditos->cred_tel3?>"></td>
                 <td>Ciudad3</td>
                 <td><input type="text" name="creditos[cred_ciudad3]" value="<?=$creditos->cred_ciudad3?>"></td>
            </tr>
             <tr>
                 <td>Razon social4</td>
                 <td><input type="text" name="creditos[cred_razon4]" value="<?=$creditos->cred_razon4?>"></td>
                 <td>Actividad4</td>
                 <td><input type="text" name="creditos[cred_actividad4]" value="<?=$creditos->cred_actividad4?>"></td>
                 <td>Telefono4</td>
                 <td><input type="text" name="creditos[cred_tel4]" value="<?=$creditos->cred_tel4?>" ></td>
                 <td>Ciudad4</td>
                 <td><input type="text" name="creditos[cred_ciudad4]" value="<?=$creditos->cred_ciudad4?>"></td>
            </tr>
            <tr>
                <th colspan="2">Referencias personales</th>
            </tr>
            <tr>
                 <td>Nombres1</td>
                 <td><input type="text" name="creditos[cred_nombre1]" value="<?=$creditos->cred_nombre1?>"></td>
                 <td>Parentesco1</td>
                 <td><input type="text" name="creditos[cred_parentesco1]" value="<?=$creditos->cred_parentesco1?>"></td>
                 <td>Telefono1</td>
                <td><input type="text" name="creditos[cred_tel_fam1]" value="<?=$creditos->cred_tel_fam1?>"></td>
                 <td>Cel1</td>
                 <td><input type="text" name="creditos[cred_cel_fam1]" value="<?=$creditos->cred_cel_fam1?>"></td>
                
            </tr>
            <tr>
                 <td>Nombres2</td>
                 <td><input type="text" name="creditos[cred_nombre2]" value="<?=$creditos->cred_nombre2?>"></td>
                 <td>Parentesco2</td>
                 <td><input type="text" name="creditos[cred_parentesco2]" value="<?=$creditos->cred_parentesco2?>"></td>
                 <td>Telefono2</td>
                 <td><input type="text" name="creditos[cred_tel_fam2]" value="<?=$creditos->cred_tel_fam2?>"></td>
                 <td>Cel2</td>
                 <td><input type="text" name="creditos[cred_cel_fam2]" value="<?=$creditos->cred_cel_fam2?>"></td>
           </tr>
           <tr>
                <td>Nombres3</td>
                 <td><input type="text" name="creditos[cred_nombre3]" value="<?=$creditos->cred_nombre3?>"></td>
                 <td>Parentesco3</td>
                 <td><input type="text" name="creditos[cred_parentesco3]" value="<?=$creditos->cred_parentesco2?>"></td>
                 <td>Telefono3</td>
                 <td><input type="text" name="creditos[cred_tel_fam3]" value="<?=$creditos->cred_tel_fam3?>" ></td>
                 <td>Cel3</td>
                 <td><input type="text" name="creditos[cred_cel_fam3]" value="<?=$creditos->cred_cel_fam3?>"></td>
            </tr>
             <tr>
                 <td>Nombres4</td>
                 <td><input type="text" name="creditos[cred_nombre4]" value="<?=$creditos->cred_nombre4?>"></td>
                 <td>Parentesco4</td>
                 <td><input type="text" name="creditos[cred_parentesco4]" value="<?=$creditos->cred_parentesco4?>"></td>
                 <td>Telefono4</td>
                 <td><input type="text" name="creditos[cred_tel_fam4]" value="<?=$creditos->cred_tel_fam4?>" ></td>
                 <td>Cel4</td>
                 <td><input type="text" name="creditos[cred_cel_fam4]" value="<?=$creditos->cred_cel_fam4?>"></td>
            </tr>
        
        </table>
   </div>
  </form>
</div>
<?}else{?>
 No se encontraron creditos
<? } ?>
