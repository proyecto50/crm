<ul class="n_left_menu" style="">
    <?if($this->session->userdata('rol')==1):?>
    <li><a class="menu_tip" href="<?=site_url('maestro/empresa')?>" rel="Empresa"><img src="<?=base_url()?>assets/images/comp.png"/></a></li>
    <?endif;?>
    <li><a class="menu_tip" href="<?=site_url('maestro/detalleusuario')?>" rel="Detalle del usuario"><img src="<?=base_url()?>assets/images/estado_cuenta.png"/></a></li>
     <?if($this->session->userdata('rol')==1):?>
    <li><a class="menu_tip" href="<?=site_url('maestro/usuario')?>" rel="Usuarios"><img src="<?base_url()?>assets/images/terceros.png" /></a></li>
     <?endif;?>
    <?if($this->session->userdata('rol')==1):?>    
    <li><a class="menu_tip" href="<?=site_url('maestro/bodegas')?>" rel="Bodegas"><img src="<?base_url()?>assets/images/map.png" /></a></li>
    <?endif;?>
       
</ul>