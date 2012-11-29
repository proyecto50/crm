<?=doctype('html4-trans');?>
<html xmlns="http://www.w3.org/1999/xhtml">
	
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/> 
	<title><?=$title?></title>
         <link type="text/css" href="<?=base_url()?>assets/js/jquery-ui-1.8.9/css/south-street/jquery-ui-1.8.9.custom.css" rel="stylesheet" />
        
	<?=$jsfiles?>
	<?=$cssfiles?>
      
   <script type="text/javascript">
        <?=(is_null($jsfile)) ? '' : $jsfile?>
    </script>
	</head>
<body>
	<div class="n_wrapper">
            <input type="hidden" id="path_server" value="<?=base_url()?>"/>
			<div class="n_top_toolbar">
				<div class="n_main_title">
					<h1><?=$title?></h1>
				</div>
				<div class="nsubmenu">
                               <b><?=strtoupper($this->session->userdata('compania_nombre'))?></b>::
                               <?if($this->session->userdata('rol')!=1):?>
                               <b><?=strtoupper($this->session->userdata('finca_nombre'))?></b>::
                               <?endif;?>
                               <b><?= strtoupper($this->session->userdata('bod_nom'))?></b>

     				Usuario: <b><?=strtoupper($this->session->userdata('usuario_nombre'))?></b>::<b><?= strtoupper($this->session->userdata('bod_nom'))?></b>
                              	<a href="<?=site_url('control/inicio')?>" class="sub_back">volver al menú</a>
					 &nbsp;&nbsp;:: &nbsp;&nbsp;
					<a href="<?=base_url()?>tmp/GUIA_NERP.pdf" class="sub_help">ayuda</a>
					 &nbsp;&nbsp;:: &nbsp;&nbsp;
					<a title="salir del sistema" href="<?=site_url('auth/inicio/logout')?>" class="sub_out">salir</a>
				</div>
			</div>
			
			<div class="n_main">
			
				<div class="n_left">
					<?=$left_menu?>
				</div>
				
				<div class="main_content" >
					<div class="n_mod_bar">
						<div class="n_mod_items" >
							<?=$mod_menu?>
						</div>
						<div class="n_mod_title" >
						 	<h1 id="mod_title"><?=$mod_title?></h1>
						</div>
					</div>
					<div class="n_mod_content">
						<?=$content?>
					</div>
				</div>
				<div class="fixed"></div>
			</div>
		</div> 
    <link rel="stylesheet" href="<?=base_url()?>assets/css/memu-0.1.css" type="text/css">
    <style type="text/css">
    		pre { font-size: 0.6em; }
		
		.menu-container {
			margin: 0 auto;
			padding: 0;
			height: 25px;
			width: 68%;
			background: #fff;
			border: 1px solid #222;
		}
		
		.container {
			border-top: 6px solid #fff;
			margin: 0 auto;
			padding: 0;
			padding-top: 10px;
			width: 721px;
			text-align: left;
			font-size: 1.0em;
		}
   .memu {
    list-style: none outside none;
    margin: 0;
    padding: 0;
}

.memu ul {
	list-style: none outside none;
    margin: 0;
    padding: 0;
	position: absolute;
    left: -9999px;
	margin-left: 20px;
    width: 90px;
	
    -moz-box-shadow: 3px 2px 3px #333;
    -webkit-box-shadow: 3px 2px 3px #333;
    box-shadow: 3px 2px 3px #333;
}
.memu ul ul {
	margin-left: 0px;
	margin-top: 0px;
	
}
.memu a {
    background: #fff;
    background-color: rgba(255, 255, 255, 0.98);
    border: 1px solid #f7f7f7;
    color: #333;
    display: block;
    font: bold 12px/25px segoe ui,verdana,sans-serif;
    margin: 0 -1px -1px 0;
    padding-left: 10px;
    text-decoration: none;
    width: 75px;
	text-overflow: ellipsis;
}

.memu .memu-icon {
	position: relative;
	width: 16px; 
	height: 16px; 
	margin: 4px 10px 0px 0px;
	float: left;
}

.memu li.memu-root > a {
	border-left: 0 !important;
	border-right: 0 !important;
	border-top: 1px solid transparent !important;
	border-bottom: 1px solid transparent !important;
	background: transparent !important;
}

.memu li {
    float: left;
}
.memu li.has-children > a {
    background: url("arrow.png") no-repeat scroll #fff;
	background-position: 130px center;
    background-color: rgba(255, 255, 255, 0.98);
}
.memu li:hover {
    position: relative;
    z-index: 100;
}
.memu li:hover > a {
    background-color: #fff;
    border-color: #fafafa;
    color: #56789A;
}
.memu li:hover > ul {
    left: -20px;
    opacity: 1;
    top: 26px;
    z-index: -1;
}
.memu li:hover li:hover > ul {
    left: 150px;
    opacity: 1;
    top: 0px;
    z-index: 100;
}

.memu-current {
	background-color: #abcdef !important;
	background-color: rgba(235, 245, 255, 0.98 !important);
}             
           
                
    </style>  
    
    <?if($this->session->userdata('rol') !='vendedor'): ?>
    <div class="menu-container">
	<ul class="memu js-enabled">
           <li class="memu-root">
		<a TARGET = "_blank" href="<?=site_url("maestro/detalleusuario/")?>">Maestro</a>
		<ul>
		 <li><a TARGET = "_blank" href="<?=site_url("maestro/detalleusuario/")?>">Usuario</a></li>
		 <li><a TARGET = "_blank" href="<?=site_url("maestro/insumos/")?>">Productos</a></li>
                 <li><a TARGET = "_blank" href="<?=site_url("maestro/kits/")?>">Kits</a></li>
                 <li><a TARGET = "_blank" href="<?=site_url("maestro/clientes/")?>">Clientes</a></li>               
                 <li><a TARGET = "_blank" href="<?=site_url("maestro/rutas/")?>">Rutas</a></li>
                 <li><a TARGET = "_blank" href="<?=site_url("maestro/ruteros/")?>">Ruteros</a></li>
                 <li><a TARGET = "_blank" href="<?=site_url("maestro/vendedores/")?>">Vendedores</a></li>
                 <li><a TARGET = "_blank" href="<?=site_url("maestro/marcas/")?>">Marcas</a></li>
                 <li><a TARGET = "_blank" href="<?=site_url("maestro/categorias/")?>">Categorias</a></li>
                 <li><a TARGET = "_blank" href="<?=site_url("maestro/lineas/")?>">Lineas</a></li>                 
                 <li><a TARGET = "_blank" href="<?=site_url("maestro/gastos/")?>">Gastos</a></li>
                 <li><a TARGET = "_blank" href="<?=site_url("maestro/transportadores/")?>">Transportado</a></li>
                 <li><a TARGET = "_blank" href="<?=site_url("maestro/entidades/")?>">Entidades</a></li>
		</ul>
	  </li>
           <li class="memu-root">
		<a TARGET = "_blank" href="<?=site_url("compras/inicio")?>">Compras</a>
		<ul>
		 <li><a TARGET = "_blank" href="<?=site_url("compras/terceros")?>">Terceros</a></li>
		 <li><a TARGET = "_blank" href="<?=site_url("compras/inicio/insumos")?>">Productos</a></li>
		</ul>
	  </li>
           <li class="memu-root">
		<a TARGET = "_blank" href="<?=site_url("inventario/inicio")?>">Inventario</a>
		<ul>
		 <li><a TARGET = "_blank" href="<?=site_url("inventario/inicio/ajustes")?>">Ajustes</a></li>
		 <li><a TARGET = "_blank" href="<?=site_url("inventario/inicio/ajuste_costo_ventas")?>">Ajuste Vent</a></li>
                 <li><a TARGET = "_blank" href="<?=site_url("inventario/notas")?>">Notas</a></li>
		</ul>
	  </li>
           <li class="memu-root">
		<a TARGET = "_blank" href="<?=site_url("ventas/inicio")?>">Ventas</a>
		<ul>
		 <li><a TARGET = "_blank" href="<?=site_url("ventas/devolucion")?>">Devolucion</a></li>
		 <li><a TARGET = "_blank" href="<?=site_url("ventas/devolucion/agotados")?>">Agotados</a></li>
		</ul>
	  </li>
           <li class="memu-root">
		<a TARGET = "_blank" href="<?=site_url("cargue/inicio")?>">Cargue</a>		
	  </li>
           <li class="memu-root">
		<a TARGET = "_blank" href="<?=site_url("pedidos/inicio")?>">Pedidos</a>
		<ul>
		 <li><a TARGET = "_blank" href="<?=site_url("pedidos/mensajes")?>">Mensajes</a></li>
		 
		</ul>
	  </li>
          <li class="memu-root">
		<a TARGET = "_blank" href="<?=site_url("informes/inicio")?>">Informes</a>
		<ul>
		 <li> <a TARGET = "_blank" href="<?=site_url("informes/productos")?>">Rentabilidad</a></li>
		  <li><a TARGET = "_blank" href="<?=site_url("informes/inventario")?>">Inventario</a></li>
                  <li><a TARGET = "_blank" href="<?=site_url("informes/ventas")?>">Contable</a></li>
                  <li><a TARGET = "_blank" href="<?=site_url("informes/presupuesto")?>">Presupuesto</a></li>
                  <li><a TARGET = "_blank" href="<?=site_url("informes/desempeno")?>">Desempeño</a></li>
                  <li><a TARGET = "_blank" href="<?=site_url("informes/productos/movimiento")?>">Movimiento</a></li>
                  <li><a TARGET = "_blank" href="<?=site_url("informes/desempeno/ventas")?>">Ventas agrup</a></li>
                  <li><a TARGET = "_blank" href="<?=site_url("informes/ventas/ventasxtrans")?>">Ventas trans</a></li>
                  <li><a TARGET = "_blank" href="<?=site_url("informes/desempeno/ventas_vendedor")?>">Ventas vend</a></li>
                  <li><a TARGET = "_blank" href="<?=site_url("informes/inventario/entradas_salidas")?>">Entra salida</a></li>
                  <li><a TARGET = "_blank" href="<?=site_url("informes/nomina")?>">Nomina</a></li>
		  <li><a TARGET = "_blank" href="<?=site_url("informes/pedidos/index")?>">Pedidos</a></li>
		  <li><a TARGET = "_blank" href="<?=site_url("informes/general/index")?>">General</a></li>		
                </ul>
	  </li>
          <li class="memu-root">
		<a TARGET = "_blank" href="<?=site_url("nomina/transportadores")?>">Nomina</a>
		<ul>
		 <li><a TARGET = "_blank" href="<?=site_url("nomina/transportadores")?>">Trasportador</a></li>
		 <li><a TARGET = "_blank" href="<?=site_url("nomina/vendedores")?>">Vendedores</a></li>
		</ul>
	  </li>
          <li class="memu-root">
		<a TARGET = "_blank" href="<?=site_url("prestamos/inicio")?>">Prestamos</a>
		<ul>
		 <li><a TARGET = "_blank" href="<?=site_url("prestamos/cargue")?>">P.cargue</a></li>
		 <li><a TARGET = "_blank" href="<?=site_url("prestamos/cxc")?>">CxC.Vendedor</a></li>
		</ul>
	  </li>
          <li class="memu-root">
		<a TARGET = "_blank" href="<?=site_url("backup/inicio")?>">Backup</a>
		
	  </li>
        </ul>
        </li>    
        </ul>  
</div>     
<?endif;?>    
	</body>
	
</html>
