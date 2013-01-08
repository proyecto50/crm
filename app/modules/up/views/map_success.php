<div class="content" style="width:800px;margin:9px auto;">
<h1><?=$map_result?></h1>
<hr/>
<ul class="ul_upload">
	<li><b>Archivo:</b> <?=$upload_data['file_name']?></li>
</ul>
<p>
	<img src="<?php echo base_url()?>assets/images/left.png" align="absmiddle">
	<?php echo anchor('up/inicio/'.$action, 'Mapear otro archivo!'); ?>
</p>
</div>
