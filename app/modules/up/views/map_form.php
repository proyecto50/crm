<div class="content" style="width:800px;margin:9px auto;">
<h1>
<?php echo $error;?>
</h1>
<img src="<?=base_url()?>assets/images/formato.png" align="absmiddle"/>
<a href="<?=base_url()?>formatos/<?=$formato?>">
	:: Descargar Formato.
</a>
<hr/>
<?php echo form_open_multipart('up/inicio/'.$action);?>
<input type="file" name="userfile" size="50" class="boxy_field" />
<br /><br />
<input type="submit" value="Mapear" id="mapear"/>
</form>
</div>
<script type="text/javascript">
    $("#mapear").click(function(){
      $.blockUI({message: '<h1> Espere por favor...</h1>'});   
    });
</script>
