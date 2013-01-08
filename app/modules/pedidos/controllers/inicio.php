<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of inicio
 *
 * @author jhon
 */
class inicio extends MY_Controller{
 public function __construct() {
      parent::__construct(); 
     $this->load->model('pedidos_model');  
    }    
    
function index(){
 set_time_limit(100); 
 $this->load->model('paginador_model');
 $this->load->library('pagination');
            
 $filtro = $this->input->post('pedidos');
 
 $filtros_pedidos = $this->paginador_model->filtro($filtro,'pedidos_filtro'); 
 $filtros_pedidos['rol_id'] = $this->session->userdata('rol');
 
 $data1['sallers']  = $this->pedidos_model->buscar('usuarios',Array('usua_estado'=>'A','usua_rol_id'=>9));
 $data1['tarjet'] = 'index';
 $data['tarjet'] = 'index';
 $data['detalle']='';
 $data['buscar_pedido_view'] = $this->load->view('buscar_pedido_view',$data1,true);

 $menu = array ( array('href'=>  site_url('pedidos/inicio/nuevo'), 'callback' =>'','val' => '<img class="qtip" alt="Agregar Pedido"  src="'.base_url().'assets/images/add-files.png" />'),
                            array('callback' =>'buscar_pedido();return false;','val' => '<img class="qtip" alt="Buscar pedido" src="'.base_url().'assets/images/search.png" />'),
                            array('val' => '<img class="qtip" alt="Eliminar filtro" src="'.base_url().'assets/images/search_elimine.png" />','href' => site_url('pedidos/inicio/todos/index')),
                           );
 $data['pedidos'] = $this->pedidos_model->get_pedidos($filtros_pedidos);

            $total_rows= (($data['pedidos']==false))? 0 : $data['pedidos']->num_rows();
            $base_url =  site_url('pedidos/inicio/index');
            $config = $this->paginador_model->paginar( $total_rows,$base_url);
            $perpage = $this->paginador_model->get_perpage();
            $this->pagination->initialize($config);
            /**
            * fin paginacion.
            */
           
            $data['per_page'] = $perpage;

            $data['pedidos'] = $this->pedidos_model->get_pedidos($filtros_pedidos,$perpage,$this->uri->segment(4));
                       
            $this->run('pedidos_view',$data,'Listado de pedidos', $menu, null,null,'pedidos.js');

 } 
 
function nuevo(){  
   $menu = array ( array('callback'=>'guardar_pedido();return false;','val' => '<img class="qtip" alt="Guardar"  src="'.base_url().'assets/images/save.png" />'),
                    ); 
   $data['vista_agregar_producto'] =  $this->load->view('agregar_producto_pedido_view',null,true);
   
   $data['vendedores']  = $this->pedidos_model->buscar('usuarios',Array('usua_estado'=>'A','usua_rol_id'=>9));
   $this->run('nuevo_pedido_view',$data,'Nuevo pedido', $menu, null,null,'pedidos.js');
 
 }
 
function guardar(){       
       $pedido        = $this->input->post('pedido');       
       $cod_producto  = $this->input->post('cod_producto');
       $nombre_pro    = $this->input->post('nombre_pro');
       $cantidad      = $this->input->post('cantidad');
       $precio_sug    = $this->input->post('precio_sug'); 
       $precio_coniva = $this->input->post('prconi'); 
       $porci         = $this->input->post('porci');
       $fecha         = $this->input->post('fecha');
       
       if(!$cod_producto){
        $this->ajax_result(false, "Debe agregar por lo menos un producto.");  
        return false;
       }
       //inicio de la transacccion
       $this->db->trans_begin();
       $pedido['pedi_esta_en'] = $this->session->userdata('rol');
       $pedido['pedi_fechacreado'] = Date('Y-m-d H:i:s');
       $pedido['pedi_bode_id']= $this->session->userdata('bode_id');
       $pedi_id = $this->pedidos_model->insertar_tablas('pedidos', $pedido);
       $numero_articulos = count($cod_producto) ;
       if($pedi_id>0){
        
       for($i=0; $i<$numero_articulos;$i++){
           $detalle = Array();
           $detalle['dped_inve_codigo']= $cod_producto[$i];
           $detalle['dped_cantidad']= $cantidad[$i];
           $detalle['dped_precio_coniva']= $precio_coniva[$i];
           $detalle['dped_porc_iva']= $porci[$i];
           $detalle['dped_precio_sugerido']= $precio_sug[$i];
           $detalle['dped_pedi_id']= $pedi_id;
           $detalle['dped_fecha_entrega']= $fecha[$i];

           $this->pedidos_model->insertar_tablas('detalle_pedidos',$detalle); 
           
       } 
       
       if ($this->db->trans_status() == FALSE){
           $this->db->trans_rollback();
           $this->ajax_result(false,'No se pudo agregar');
          return false;
           }else{
           $this->db->trans_commit();
           $this->ajax_result(true,'Pedido agregado correctamente.');
           return false;
           } 
           
       }else{
       $this->db->trans_rollback();              
       $this->ajax_result(false,"No se pudo agregar el pedido");    
       return false;
       }
 
 }
 
function guardar_editar(){            
       $pedido        = $this->input->post('pedido');       
       $cod_producto  = $this->input->post('cod_producto');
       $nombre_pro    = $this->input->post('nombre_pro');
       $cantidad      = $this->input->post('cantidad');
       $precio_sug    = $this->input->post('precio_sug'); 
       $precio_coniva = $this->input->post('prconi'); 
       $porci         = $this->input->post('porci');
       $fecha         = $this->input->post('fecha');
       
       $pedi_id       = $this->input->post('pedi_id');
       
       if(!$cod_producto){
        $this->ajax_result(false, "Debe agregar por lo menos un producto.");  
        return false;
       }
       //inicio de la transacccion
       $this->db->trans_begin();
       $this->pedidos_model->modificar_tablas('pedidos','pedi_id', $pedido,$pedi_id);
       $this->pedidos_model->eliminar('detalle_pedidos','dped_pedi_id', $pedi_id);
       $numero_articulos = count($cod_producto) ;
       if($pedi_id>0){
        
       for($i=0; $i<$numero_articulos;$i++){
           $detalle = Array();
           $detalle['dped_inve_codigo']= $cod_producto[$i];
           $detalle['dped_cantidad']= $cantidad[$i];
           $detalle['dped_precio_coniva']= $precio_coniva[$i];
           $detalle['dped_porc_iva']= $porci[$i];
           $detalle['dped_precio_sugerido']= $precio_sug[$i];
           $detalle['dped_pedi_id']= $pedi_id;
           $detalle['dped_fecha_entrega']= $fecha[$i];

           $this->pedidos_model->insertar_tablas('detalle_pedidos',$detalle); 
           
       } 
       
       if ($this->db->trans_status() == FALSE){
           $this->db->trans_rollback();
           $this->ajax_result(false,'No se pudo agregar');
          return false;
           }else{
           $this->db->trans_commit();
           $this->ajax_result(true,'Pedido actualizado correctamente.');
           return false;
           } 
           
       }else{
       $this->db->trans_rollback();              
       $this->ajax_result(false,"No se pudo agregar el pedido");    
       return false;
       }
 
 }
 
function completar_cliente(){    
    $filtro = $this->input->post('filtro');    
    $filtro['clie_estado']='A';
    $registros = $this->pedidos_model->buscar('clientes',null,null,null,$filtro);
    //log_message('debug', $this->db->last_query());
     if($registros){
         $registros = $registros->result_array();
         echo  '{"registros":'.json_encode($registros).'}';
         return true;
     }else{
         return false;
     }
   }

function completar_codigo_insumo(){
     $filtro = $this->input->post('filtro');        
     $filtro['inve_estado']='A';
     $insumos = $this->pedidos_model->buscar('inventarios',null,null,null,$filtro);

     if($insumos){
         $insumos = $insumos->result_array();
         echo  '{"insumos":'.json_encode($insumos).'}';
         return true;
     }else{
         return false;
     }
  
    

   }
 
function editar($pedi_id=null){ 
 $menu = null;
 
 $data['vista_agregar_producto'] =  $this->load->view('agregar_producto_pedido_view',null,true);
 $data['vendedores']             = $this->pedidos_model->buscar('usuarios',Array('usua_estado'=>'A','usua_rol_id'=>9));
 $data['detalle']                = $this->pedidos_model->get_detalle(Array('pedi_id'=>$pedi_id));
 $data['pedido']                 = $this->pedidos_model->get_pedidos(Array('pedi_id'=>$pedi_id) );
 
 if($data['pedido']){
 $data['pedido']= $data['pedido']->row();
 if($this->session->userdata('rol_nombre')=='VENDEDOR' && $data['pedido']->pedi_estado=='A' )
 $menu = array ( array('callback'=>'guardar_pedido_editar();return false;','val' => '<img class="qtip" alt="Guardar"  src="'.base_url().'assets/images/save.png" />'),
                    ); 
 $this->run('editar_pedido_view',$data,'Editar pedido', $menu, null,null,'pedidos.js');
 } 
 }  
 
function detalle($pedi_id=null){
$data['detalle']    = $this->pedidos_model->get_detalle(Array('pedi_id'=>$pedi_id));
$data['pedido']     = $this->pedidos_model->get_pedidos(Array('pedi_id'=>$pedi_id) );
if($data['pedido']){
$data['pedido']     = $data['pedido']->row();
$enviar  = null;
$estado  = null;
$guardar = null;
$devolver= null;
$enviar_gerencia= null;

if($data['pedido']->pedi_estado=="A"){
$enviar = array('callback'=>'enviar_pedido('.$data['pedido']->pedi_id.','.$data['pedido']->usua_id.',\'E'.'\',2);return false;',  'val' => '<img class="qtip" alt="Enviar a Cartera"  src="'.base_url().'assets/images/proy.png" />');

}

if($data['pedido']->pedi_estado!="A"){
  $leido = $this->pedidos_model->buscar('leidos', Array('leid_pedi_id'=>$pedi_id,'leid_usua_id'=>$this->session->userdata('usuario_id')) ) ;
  if(!$leido){
   $data0['leid_pedi_id'] = $pedi_id;
   $data0['leid_usua_id'] = $this->session->userdata('usuario_id');
   $data0['leid_comentarios'] = "Leido por ".$this->session->userdata('rol_nombre');
   $data0['leid_fecha'] = Date('Y-m-d H:i:s');
   $leid_id = $this->pedidos_model->insertar_tablas('leidos', $data0);   
  }  
}

IF($this->session->userdata('rol_nombre')=="CARTERA"){
 $hay_dif_precio = false;   
 FOREACH($data['detalle']->result() as $r){
  if($r->dped_precio_coniva>$r->dped_precio_sugerido)$hay_dif_precio= true;  
 }  
 if($hay_dif_precio && $data['pedido']->pedi_estado!="N"){
 //se envia el pedido a gerencia.    
 $enviar = array('callback'=>'enviar_pedido_general('.$data['pedido']->pedi_id.','.$this->session->userdata('usuario_id').',\'E'.'\',7'.',\'GERENCIA'.'\');return false;',  'val' => '<img class="qtip" alt="Enviar a Gerencia"  src="'.base_url().'assets/images/proy.png" />');
 } 
 if(!$hay_dif_precio && $data['pedido']->pedi_estado!="N"){ 
 //se envia el pedido a bodega    
 $enviar = array('callback'=>'enviar_pedido_general('.$data['pedido']->pedi_id.','.$this->session->userdata('usuario_id').',\'E'.'\',3'.',\'BODEGA'.'\');return false;',  'val' => '<img class="qtip" alt="Enviar a Bodega"  src="'.base_url().'assets/images/proy.png" />');
 $enviar_gerencia = array('callback'=>'enviar_pedido_general('.$data['pedido']->pedi_id.','.$this->session->userdata('usuario_id').',\'E'.'\',7'.',\'GERENCIA'.'\');return false;',  'val' => '<img class="qtip" alt="Enviar a Gerencia"  src="'.base_url().'assets/images/ver_estado.png" />');

 
 }
 $estado = array('callback'=>'estado_pedido_general('.$data['pedido']->pedi_id.','.$this->session->userdata('usuario_id').');return false;',  'val' => '<img class="qtip" alt="Cambiar estado"  src="'.base_url().'assets/images/bajar.png" />');
 
 $devolver = array('callback'=>'enviar_pedido_general('.$data['pedido']->pedi_id.','.$this->session->userdata('usuario_id').',\'A'.'\',9'.',\'VENDEDOR'.'\');return false;',  'val' => '<img class="qtip" alt="Devolver a Vendedor"  src="'.base_url().'assets/images/bajas.png" />');
 
 }

IF($this->session->userdata('rol_nombre')=="GERENCIA"){
$enviar  = array('callback'=>'enviar_pedido_general('.$data['pedido']->pedi_id.','.$this->session->userdata('usuario_id').',\'E'.'\',3'.',\'BODEGA'.'\');return false;',  'val' => '<img class="qtip" alt="Enviar a Bodega"  src="'.base_url().'assets/images/proy.png" />');
$devolver = array('callback'=>'enviar_pedido_general('.$data['pedido']->pedi_id.','.$this->session->userdata('usuario_id').',\'E'.'\',2'.',\'CARTERA'.'\');return false;',  'val' => '<img class="qtip" alt="Devolver a Cartera"  src="'.base_url().'assets/images/bajas.png" />');
$estado  = array('callback'=>'estado_pedido_general('.$data['pedido']->pedi_id.','.$this->session->userdata('usuario_id').');return false;',  'val' => '<img class="qtip" alt="Cambiar estado"  src="'.base_url().'assets/images/bajar.png" />');
$guardar = array('callback'=>'guardar_pedido_editar(true);return false;','val' => '<img class="qtip" alt="Guardar"  src="'.base_url().'assets/images/save_16.png" />');     
}

IF($this->session->userdata('rol_nombre')=="BODEGA"){
$enviar  = array('callback'=>'enviar_pedido_general('.$data['pedido']->pedi_id.','.$this->session->userdata('usuario_id').',\'E'.'\',4'.',\'FACTURACION'.'\');return false;',  'val' => '<img class="qtip" alt="Enviar a Facturacion"  src="'.base_url().'assets/images/proy.png" />');
$devolver = array('callback'=>'enviar_pedido_general('.$data['pedido']->pedi_id.','.$this->session->userdata('usuario_id').',\'E'.'\',2'.',\'CARTERA'.'\');return false;',  'val' => '<img class="qtip" alt="Devolver a Cartera"  src="'.base_url().'assets/images/bajas.png" />');
$data['transportadoras'] = $this->pedidos_model->buscar('transportadoras', Array('tran_estado'=>'A') ) ;

$estado  = array('callback'=>'estado_pedido_general('.$data['pedido']->pedi_id.','.$this->session->userdata('usuario_id').');return false;',  'val' => '<img class="qtip" alt="Cambiar estado"  src="'.base_url().'assets/images/bajar.png" />');
$guardar = array('callback'=>'guardar_pedido_editar(true);return false;','val' => '<img class="qtip" alt="Guardar"  src="'.base_url().'assets/images/save_16.png" />');     
} 

IF($this->session->userdata('rol_nombre')=="FACTURACION"){
$estado  = array('callback'=>'estado_pedido_general('.$data['pedido']->pedi_id.','.$this->session->userdata('usuario_id').');return false;',  'val' => '<img class="qtip" alt="Cambiar estado"  src="'.base_url().'assets/images/bajar.png" />');
$devolver = array('callback'=>'enviar_pedido_general('.$data['pedido']->pedi_id.','.$this->session->userdata('usuario_id').',\'E'.'\',3'.',\'BODEGA'.'\');return false;',  'val' => '<img class="qtip" alt="Devolver a Bodega"  src="'.base_url().'assets/images/bajas.png" />');
$data['transportadoras'] = $this->pedidos_model->buscar('transportadoras', Array('tran_estado'=>'A') ) ;
$guardar = array('callback'=>'guardar_pedido_editar(true);return false;','val' => '<img class="qtip" alt="Guardar"  src="'.base_url().'assets/images/save_16.png" />');     

} 
 
$data['vista_comentarios_pedido'] =  $this->load->view('comentarios_pedido_view',null,true);
$data['vista_estado_pedido'] =  $this->load->view('estado_pedido_view',null,true);

$menu = array ( array('href'=>  site_url('pedidos/inicio/index'),'val' => '<img class="qtip" alt="Volver"  src="'.base_url().'assets/images/left.png" />'),
                array('callback'=>'imprimir_pedido('.$pedi_id.');return false;',  'val' => '<img class="qtip" alt="Imprimir"  src="'.base_url().'assets/images/printer.png" />'), 
                array('href'=>site_url('pedidos/inicio/exportar/'.$pedi_id),  'val' => '<img class="qtip" alt="Exportar"  src="'.base_url().'assets/images/xls1_16.png" />'), 
                $estado,
                $enviar,
                $guardar,
                $devolver,
                $enviar_gerencia
                );
  
$this->run('detalle_pedido_view',$data,'Detalle pedido', $menu, null,null,'pedidos.js');
 } 

} 
 
function detalle2($pedi_id=null){
$data['detalle']    = $this->pedidos_model->get_detalle(Array('pedi_id'=>$pedi_id));
$data['pedido']     = $this->pedidos_model->get_pedidos(Array('pedi_id'=>$pedi_id) );
if($data['pedido']){
$data['pedido']     = $data['pedido']->row();

$data['transportadoras'] = $this->pedidos_model->buscar('transportadoras', Array('tran_estado'=>'A') ) ;

 
$data['vista_comentarios_pedido'] =  $this->load->view('comentarios_pedido_view',null,true);
$data['vista_estado_pedido'] =  $this->load->view('estado_pedido_view',null,true);

$menu = array ( array('href'=>  site_url('pedidos/inicio/index'),'val' => '<img class="qtip" alt="Volver"  src="'.base_url().'assets/images/left.png" />'),
                array('callback'=>'imprimir_pedido('.$pedi_id.');return false;',  'val' => '<img class="qtip" alt="Imprimir"  src="'.base_url().'assets/images/printer.png" />'), 
                array('href'=>site_url('pedidos/inicio/exportar/'.$pedi_id),  'val' => '<img class="qtip" alt="Exportar"  src="'.base_url().'assets/images/xls1_16.png" />'), 
                
                );
  
$this->run('detalle_pedido_view',$data,'Detalle pedido', $menu, null,null,'pedidos.js');
 } 

} 

function impresion($pedi_id){
$data['detalle']    = $this->pedidos_model->get_detalle(Array('pedi_id'=>$pedi_id));
$data['pedido']     = $this->pedidos_model->get_pedidos(Array('pedi_id'=>$pedi_id) );

if($data['pedido']){
$data['pedido']= $data['pedido']->row();
$this->imprimir('impresion_pedido_view',$data,null,null,null,null,'pedidos.js');  
    }       
 }  
 
function exportar($pedi_id){
$data['detalle']    = $this->pedidos_model->get_detalle(Array('pedi_id'=>$pedi_id));
$data['pedido']     = $this->pedidos_model->get_pedidos(Array('pedi_id'=>$pedi_id) );

if($data['pedido']){
$data['pedido']= $data['pedido']->row();
$this->load->view('exportar_pedido_view',$data);  
    }       
 }  
 
function eliminar(){    
    $pedi_id = $this->input->post('pedi_id');
    $this->pedidos_model->eliminar('pedidos','pedi_id', $pedi_id);
    $this->ajax_result(TRUE, "Pedido eliminado correctamente");
 }
 
function todos($tarjet){
  $this->session->unset_userdata('pedidos_filtro');
  redirect('pedidos/inicio/'.$tarjet);
     }
      
function cambiar_estado(){
$usua_id           = $this->input->post('usua_id');       
$pedi_id           = $this->input->post('pedi_id');
$estado            = $this->input->post('estado');
$comen_comentarios = $this->input->post('comen_comentarios');
$comen_esta_en     = $this->input->post('comen_esta_en');

$this->pedidos_model->modificar_tablas('pedidos','pedi_id', Array('pedi_estado'=>$estado,'pedi_esta_en'=>$comen_esta_en ), $pedi_id);
if($estado=="E"){  
 $leido = $this->pedidos_model->buscar('leidos', Array('leid_pedi_id'=>$pedi_id,'leid_usua_id'=>$this->session->userdata('usuario_id')) ) ;
 if(!$leido){   
 $data['leid_pedi_id'] = $pedi_id;
 $data['leid_usua_id'] = $usua_id;
 $data['leid_comentarios'] = "Leido por VENDEDOR";
 $data['leid_fecha'] = Date('Y-m-d H:i:s');
 $leid_id = $this->pedidos_model->insertar_tablas('leidos', $data);
 }else{
 $leid_id = $leido->row()->leid_id;    
 }
 
 $data1['esta_pedi_id'] = $pedi_id;
 $data1['esta_usua_id'] = $usua_id;
 $data1['esta_leid_id'] = $leid_id;
 $data1['esta_estado'] = "E";
 $data1['esta_enviado_a'] = "CARTERA";
 $data1['esta_comentarios'] = $comen_comentarios ; 
 $data1['esta_fecha'] = Date('Y-m-d H:i:s'); 
 $this->pedidos_model->insertar_tablas('estados', $data1);
 
 if(!$leido){   
 $pedido = $this->pedidos_model->buscar('pedidos',Array('pedi_id'=>$pedi_id) );
 
 if($pedido){
     $pedido = $pedido->row_array();
     $pedido['pedi_pedi_id']=$pedi_id;
     $copy_id = $this->pedidos_model->insertar_tablas('pedidos_copy', $pedido);
     
     $detalle_pedido = $this->pedidos_model->buscar('detalle_pedidos',Array('dped_pedi_id'=>$pedi_id) );
     
     if($detalle_pedido){
       foreach($detalle_pedido->result_array() as $d){
       $this->pedidos_model->insertar_tablas('detalle_pedidos_copy', $d);    
       }  
     }
 }
 }
 
}
$this->ajax_result(true,"Pedido enviado correctamente.");
} 

function cambiar_estado_general(){
$usua_id           = $this->input->post('estado_usua_id');       
$pedi_id           = $this->input->post('estado_pedi_id');
$estado            = $this->input->post('estado_estado');
$estado_comentarios = $this->input->post('estado_comentarios');
$this->pedidos_model->modificar_tablas('pedidos','pedi_id', Array('pedi_estado'=>$estado), $pedi_id);

$data1['esta_pedi_id'] = $pedi_id;
$data1['esta_usua_id'] = $usua_id;
$data1['esta_estado'] = $estado;
$data1['esta_enviado_a'] = $this->session->userdata('rol_nombre');
$data1['esta_comentarios'] = $estado_comentarios ; 
$data1['esta_fecha'] = Date('Y-m-d H:i:s'); 

$leido = $this->pedidos_model->buscar('leidos', Array('leid_pedi_id'=>$pedi_id,'leid_usua_id'=>$this->session->userdata('usuario_id')) ) ;

if($leido){
 $data1['esta_leid_id'] = $leido->row()->leid_id;   
}

$this->pedidos_model->insertar_tablas('estados', $data1);
$this->ajax_result(true,"Estado actualizado correctamente."); 
}

function enviar_pedido_general(){     
$usua_id           = $this->input->post('usua_id');       
$pedi_id           = $this->input->post('pedi_id');
$estado            = $this->input->post('estado');
$enviado_a         = $this->input->post('enviado_a');
$esta_en           = $this->input->post('esta_en');
$comentarios       = $this->input->post('comentarios');
$this->pedidos_model->modificar_tablas('pedidos','pedi_id', Array('pedi_estado'=>$estado,'pedi_esta_en'=>$esta_en ), $pedi_id);

$data1['esta_pedi_id'] = $pedi_id;
$data1['esta_usua_id'] = $usua_id;
$data1['esta_estado'] = $estado;
$data1['esta_enviado_a'] = $enviado_a; 
$data1['esta_comentarios'] = $comentarios;
$data1['esta_fecha'] = Date('Y-m-d H:i:s'); 

$leido = $this->pedidos_model->buscar('leidos', Array('leid_pedi_id'=>$pedi_id,'leid_usua_id'=>$this->session->userdata('usuario_id')) ) ;

if($leido){
 $data1['esta_leid_id'] = $leido->row()->leid_id;   
}

$this->pedidos_model->insertar_tablas('estados', $data1);
$this->ajax_result(true,"Estado actualizado correctamente."); 

}

function mostrar_estados(){
$pedi_id = $this->input->post('pedi_id');    
$data['estados'] = $this->pedidos_model->get_estados(Array('pedi_id'=>$pedi_id));
$this->load->view('estados_view',$data);
}    
   
function seguir(){
 set_time_limit(100); 
 $this->load->model('paginador_model');
 $this->load->library('pagination');
            
 $filtro = $this->input->post('pedidos');
 
 $filtros_pedidos = $this->paginador_model->filtro($filtro,'pedidos_filtro');
 if($this->session->userdata('rol_nombre')=='VENDEDOR'){
 $filtros_pedidos['pedi_usua_id'] = $this->session->userdata('usuario_id');}
 
 $data1['sallers']  = $this->pedidos_model->buscar('usuarios',Array('usua_estado'=>'A','usua_rol_id'=>9));
 $data1['tarjet'] = 'seguir';
 $data['tarjet'] = 'seguir';
 $data['detalle']='2';
 $data['buscar_pedido_view'] = $this->load->view('buscar_pedido_view',$data1,true);

 $menu = array ( array('callback' =>'buscar_pedido();return false;','val' => '<img class="qtip" alt="Buscar pedido" src="'.base_url().'assets/images/search.png" />'),
                 array('val' => '<img class="qtip" alt="Eliminar filtro" src="'.base_url().'assets/images/search_elimine.png" />','href' => site_url('pedidos/inicio/todos/seguir')),
               );
 $data['pedidos'] = $this->pedidos_model->get_pedidos($filtros_pedidos);

            $total_rows= (($data['pedidos']==false))? 0 : $data['pedidos']->num_rows();
            $base_url =  site_url('pedidos/inicio/seguir');
            $config = $this->paginador_model->paginar( $total_rows,$base_url);
            $perpage = $this->paginador_model->get_perpage();
            $this->pagination->initialize($config);
            /**
            * fin paginacion.
            */
           
            $data['per_page'] = $perpage;

            $data['pedidos'] = $this->pedidos_model->get_pedidos($filtros_pedidos,$perpage,$this->uri->segment(4));
                       
            $this->run('pedidos_view',$data,'Seguimiento de pedidos', $menu, null,null,'pedidos.js');

 } 

}