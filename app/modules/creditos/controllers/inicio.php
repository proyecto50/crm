<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of inicio
 *
 * @author erick
 */
class inicio extends MY_Controller{
function __construct() {
        parent::__construct();
        $this->load->model('credito_model');
        $this->load->model('paginador_model');
        $this->load->library('pagination');
        $this->load->plugin('to_excel_pi');
       }

  function index(){
  $filtro = $this->input->post('creditos');

  $filtros_creditos = $this->paginador_model->filtro($filtro,'creditos_filtro');
  $filtros_creditos['rol_id'] = $this->session->userdata('rol');
      /**
      * configuracion de paginacion
      */
  $data['creditos'] = $this->credito_model->get_credito($filtros_creditos);
                 
  $total_rows= (($data['creditos']==false))? 0 : $data['creditos']->num_rows();
  $base_url =  site_url('credito/inicio/index');
  $config = $this->paginador_model->paginar( $total_rows,$base_url);
  $perpage = $this->paginador_model->get_perpage();
  $this->pagination->initialize($config);
     /**
      * fin paginacion.
      */
  $data['per_page'] = $perpage;
  $data['creditos'] = $this->credito_model->get_credito($filtros_creditos,$perpage,$this->uri->segment(4));

  $menu= array (array('href'=>  site_url('creditos/inicio/nuevo'), 'callback' =>'','val' => '<img class="qtip" alt="Nuevo credito"  src="'.base_url().'assets/images/add-files.png" />'),
                    array('callback' => 'buscar_credito();return false;','val' => '<img class="qtip" alt="Buscar Credito" src="'.base_url().'assets/images/search.png" />')
                   );
  $this->run('creditos_view',$data,'Listado de creditos', $menu, null,null,'credito.js');
  }
    
  function nuevo(){
  $menu = array ( array('callback'=>'guardar_credito();return false;','val' => '<img class="qtip" alt="Guardar"  src="'.base_url().'assets/images/save.png" />')
                    ); 
  $this->run('nuevo_credito_view',null,'Nuevo credito', $menu, null,null,'credito.js');
  }
   
  function guardar(){
  $result=0;
  $cliente= $this->input->post('clientes');
  $credito = $this->input->post('creditos');
  $credito['cred_fecha_sistema'] = date("Y-m-d h:i:s");
  $cliente['clie_fechacreacion'] = date("Y-m-d h:i:s");
      /**
           * se verifica si el cliente existe
      */
  $result = $this->credito_model->buscar('clientes', Array('clie_cedula'=>$cliente['clie_cedula']));
  if(!$result){
      $result=$this->credito_model->insertar_tablas('clientes', $cliente);
      if($result){
         $data0['clie_id']=$result;
         $credito['cred_clie_cedula']=$cliente['clie_cedula'];
         $credito['cred_clie_cliente']=$cliente['clie_cliente'];
         $credito['cred_clie_negocio']=$cliente['clie_negocio'];
         $credito['cred_clie_direccion']=$cliente['clie_direccion'];
         $credito['cred_clie_telefono']=$cliente['clie_telefono'];
         $credito['cred_clie_movil']=$cliente['clie_movil'];
         $credito['cred_clie_ciudad']=$cliente['clie_ciudad'];
         $credito['cred_clie_barrio']=$cliente['clie_barrio'];
         $credito['cred_clie_cupo']=$cliente['clie_cupo'];
         $credito['cred_esta_en']=$this->session->userdata('rol');
         $result=  $this->credito_model->insertar_tablas('creditos',$credito);
         if($result){
             $credito['cred_id']=$result;
             $data0['creditos']=$credito;
             $this->ajax_result(true,"Credito agregado correctamante!",$data0);
             }else{$this->ajax_result(false,"Error al guardar el credito");}
      }else{ $this->ajax_result(false,"El cliente no ha sido guardado");}
    }else{$this->ajax_result(false,"El cliente ya existe!");}
  }
    
  function editar($id=null){
  $menu = array ( array('callback'=>'editar_credito();return false;','val' => '<img class="qtip" alt="Guardar"  src="'.base_url().'assets/images/save.png" />')
                    ); 
  $data['creditos']=  $this->credito_model->get_credito(array('cred_id'=>$id));
  $data['creditos']=$data['creditos']->row();
  $this->run('editar_credito_view',$data,'Editar credito', $menu, null,null,'credito.js');
  }
    
  function guardar_editar(){
  $creditos = $this->input->post('creditos');
  $clientes= $this->input->post('clientes');
  $clie_id= $this->input->post('clie_id');
  $cred_id= $this->input->post('cred_id');
  $codigo_recibido=$clientes['clie_cedula'];
       
  $codigo_actual=  $this->credito_model->buscar('clientes', array('clie_id'=>$clie_id));
  $codigo_actual= $codigo_actual->row();
  $codigo_actual= $codigo_actual->clie_cedula;
           
  if($codigo_recibido==$codigo_actual){
     $this->proceso_guardado($clientes,$creditos,$clie_id, $cred_id);
  }else if($codigo_recibido != $codigo_actual ){
              $result=  $this->credito_model->buscar('clientes', array('clie_cedula'=>$codigo_recibido));
               if($result){ $this->ajax_result(false, "La cedula ya existe!");}
                else{ $this->proceso_guardado($clientes,$creditos,$clie_id,$cred_id);}
      }
  }
  function proceso_guardado($clientes=null,$creditos=null,$clie_id=null, $cred_id=null){
  $rs_cliente=0;
  $rs_credito=0;
  $rs_cliente = $this->credito_model->modificar_tablas('clientes', 'clie_id',$clientes, $clie_id);
  $creditos['cred_clie_cedula']=$clientes['clie_cedula'];
  $creditos['cred_clie_cliente']=$clientes['clie_cliente'];
  $creditos['cred_clie_negocio']=$clientes['clie_negocio'];
  $creditos['cred_clie_direccion']=$clientes['clie_direccion'];
  $creditos['cred_clie_telefono']=$clientes['clie_telefono'];
  $creditos['cred_clie_movil']=$clientes['clie_movil'];
  $creditos['cred_clie_ciudad']=$clientes['clie_ciudad'];
  $creditos['cred_clie_barrio']=$clientes['clie_barrio'];
  $creditos['cred_clie_cupo']=$clientes['clie_cupo'];
  $rs_credito = $this->credito_model->modificar_tablas('creditos', 'cred_id',$creditos, $cred_id);
    
  if(($rs_cliente)){
      $this->ajax_result(true,"Datos del cliente editados!");
  }else if( !($rs_cliente) && ($rs_credito)){
              $this->ajax_result(true,"Datos del credito editados!");
         }else{$this->ajax_result(false,"No hubieron cambios");}
 }
  function detalle($id=null){
  $data['creditos']=  $this->credito_model->get_credito(array('cred_id'=>$id));
      
  if($data['creditos']){
     $data['creditos']=$data['creditos']->row();
     $enviar=null;
     $estado=null;
     $guardar=null;
     $devolver=null;
     $enviar_gerencia= null;
     if($data['creditos']->cred_estado=='A'){
        $enviar = array('callback'=>'enviar_credito('.$data['creditos']->cred_id.','.$this->session->userdata('usuario_id').',\'E'.'\',2);return false;',  'val' => '<img class="qtip" alt="Enviar a Cartera"  src="'.base_url().'assets/images/proy.png" />');
       }
         
     if($data['creditos']->cred_estado!='A'){
        $leido = $this->credito_model->buscar('creditos_leidos', Array('cred_leid_cred_id'=>$id,'cred_leid_usua_id'=>$this->session->userdata('usuario_id')) ) ;
        if(!$leido){
            $data0['cred_leid_cred_id'] = $id;
            $data0['cred_leid_usua_id'] = $this->session->userdata('usuario_id');
            $data0['cred_leid_comentarios'] = "Leido por ".$this->session->userdata('rol_nombre');
            $data0['cred_leid_fecha'] = Date('Y-m-d H:i:s');
            $this->credito_model->insertar_tablas('creditos_leidos', $data0);   
          }  
         }
         //si el usuario es cartera, le habilitamos la opcion enviar a bodega o a gerencia
     if($this->session->userdata('rol_nombre')=="CARTERA"){
        $enviar = array('callback'=>'enviar_credito_general('.$data['creditos']->cred_id.','.$this->session->userdata('usuario_id').',\'E'.'\',3'.',\'BODEGA'.'\');return false;',  'val' => '<img class="qtip" alt="Enviar a Bodega"  src="'.base_url().'assets/images/proy.png" />');
        $enviar_gerencia = array('callback'=>'enviar_credito_general('.$data['creditos']->cred_id.','.$this->session->userdata('usuario_id').',\'E'.'\',7'.',\'GERENCIA'.'\');return false;',  'val' => '<img class="qtip" alt="Enviar a Gerencia"  src="'.base_url().'assets/images/ver_estado.png" />');
        $devolver = array('callback'=>'enviar_credito_general('.$data['creditos']->cred_id.','.$this->session->userdata('usuario_id').',\'A'.'\',9'.',\'VENDEDOR'.'\');return false;',  'val' => '<img class="qtip" alt="Devolver a Vendedor"  src="'.base_url().'assets/images/bajas.png" />');
        $estado = array('callback'=>'estado_credito_general('.$data['creditos']->cred_id.','.$this->session->userdata('usuario_id').');return false;',  'val' => '<img class="qtip" alt="Cambiar estado"  src="'.base_url().'assets/images/bajar.png" />');
     }
        
     if($this->session->userdata('rol_nombre')=="BODEGA"){
        $enviar  = array('callback'=>'enviar_credito_general('.$data['creditos']->cred_id.','.$this->session->userdata('usuario_id').',\'E'.'\',4'.',\'FACTURACION'.'\');return false;',  'val' => '<img class="qtip" alt="Enviar a Facturacion"  src="'.base_url().'assets/images/proy.png" />');
        $devolver = array('callback'=>'enviar_credito_general('.$data['creditos']->cred_id.','.$this->session->userdata('usuario_id').',\'E'.'\',2'.',\'CARTERA'.'\');return false;',  'val' => '<img class="qtip" alt="Devolver a Cartera"  src="'.base_url().'assets/images/bajas.png" />');
        $estado  = array('callback'=>'estado_credito_general('.$data['creditos']->cred_id.','.$this->session->userdata('usuario_id').');return false;',  'val' => '<img class="qtip" alt="Cambiar estado"  src="'.base_url().'assets/images/bajar.png" />');
     } 
        
     if($this->session->userdata('rol_nombre')=="FACTURACION"){
        $estado  = array('callback'=>'estado_credito_general('.$data['creditos']->cred_id.','.$this->session->userdata('usuario_id').');return false;',  'val' => '<img class="qtip" alt="Cambiar estado"  src="'.base_url().'assets/images/bajar.png" />');
        $devolver = array('callback'=>'enviar_credito_general('.$data['creditos']->cred_id.','.$this->session->userdata('usuario_id').',\'E'.'\',3'.',\'BODEGA'.'\');return false;',  'val' => '<img class="qtip" alt="Devolver a Bodega"  src="'.base_url().'assets/images/bajas.png" />');
     }  
         
     if($this->session->userdata('rol_nombre')=="GERENCIA"){
        $enviar = array('callback'=>'enviar_credito_general('.$data['creditos']->cred_id.','.$this->session->userdata('usuario_id').',\'E'.'\',3'.',\'BODEGA'.'\');return false;',  'val' => '<img class="qtip" alt="Enviar a Bodega"  src="'.base_url().'assets/images/proy.png" />');
        $devolver = array('callback'=>'enviar_credito_general('.$data['creditos']->cred_id.','.$this->session->userdata('usuario_id').',\'E'.'\',2'.',\'CARTERA'.'\');return false;',  'val' => '<img class="qtip" alt="Devolver a Cartera"  src="'.base_url().'assets/images/bajas.png" />');
        $estado  = array('callback'=>'estado_credito_general('.$data['creditos']->cred_id.','.$this->session->userdata('usuario_id').');return false;',  'val' => '<img class="qtip" alt="Cambiar estado"  src="'.base_url().'assets/images/bajar.png" />');
     }  
         
     $data['vista_comentarios_credito'] =  $this->load->view('comentarios_credito_view',null,true);
     $data['vista_estado_credito'] =  $this->load->view('estado_credito_view',null,true);
     $menu = array (array('href'=>  site_url('creditos/inicio/index'),'val' => '<img class="qtip" alt="Volver"  src="'.base_url().'assets/images/left.png" />'),
                    array('callback'=>'imprimir_credito('.$id.');return false;',  'val' => '<img class="qtip" alt="Imprimir"  src="'.base_url().'assets/images/printer.png" />'), 
                      $estado,
                      $enviar,
                      $guardar,
                      $devolver,
                      $enviar_gerencia
                
                   );
     $this->run('detalle_credito_view',$data,'Detalle credito', $menu, null,null,'credito.js');
      }
    }
  function enviar_credito_general(){
  $usua_id           = $this->input->post('usua_id');       
  $cred_id           = $this->input->post('cred_id');
  $estado            = $this->input->post('estado');
  $enviado_a         = $this->input->post('enviado_a');
  $esta_en           = $this->input->post('esta_en');
  $comentarios       = $this->input->post('comentarios');
  $this->credito_model->modificar_tablas('creditos','cred_id', Array('cred_estado'=>$estado,'cred_esta_en'=>$esta_en ), $cred_id);

  $data1['esta_cred_cred_id'] = $cred_id;
  $data1['esta_cred_usua_id'] = $usua_id;
  $data1['esta_cred_estado'] = $estado;
  $data1['esta_cred_enviado_a'] = $enviado_a; 
  $data1['esta_cred_comentarios'] = $comentarios;
  $data1['esta_cred_fecha'] = Date('Y-m-d H:i:s'); 

  $leido = $this->credito_model->buscar('creditos_leidos', Array('cred_leid_cred_id'=>$cred_id,'cred_leid_usua_id'=>$this->session->userdata('usuario_id')) ) ;

  if($leido){
     $data1['esta_cred_cred_leid_id'] = $leido->row()->cred_leid_id;   
     }
  $this->credito_model->insertar_tablas('estados_creditos', $data1);
  $this->ajax_result(true,"Estado actualizado correctamente."); 
  }
    
  function cambiar_estado(){
  $comen_comentarios = $this->input->post('comen_comentarios');
  $usua_id           = $this->input->post('usua_id');        
  $cred_id           = $this->input->post('cred_id');
  $estado            = $this->input->post('estado');
  $comen_esta_en     = $this->input->post('comen_esta_en');

  $this->credito_model->modificar_tablas('creditos','cred_id', Array('cred_estado'=>$estado,'cred_esta_en'=>$comen_esta_en ), $cred_id);
  if($estado=="E"){  
     $leido = $this->credito_model->buscar('creditos_leidos', Array('cred_leid_cred_id'=>$cred_id,'cred_leid_usua_id'=>$this->session->userdata('usuario_id')) ) ;
     if(!$leido){   
         $data['cred_leid_cred_id'] = $cred_id;
         $data['cred_leid_usua_id'] = $usua_id;
         $data['cred_leid_comentarios'] = "Leido por VENDEDOR";
         $data['cred_leid_fecha'] = Date('Y-m-d H:i:s');
         $leid_id = $this->credito_model->insertar_tablas('creditos_leidos', $data);
     }else{
      $leid_id = $leido->row()->cred_leid_id;    
      }
      $data1['esta_cred_cred_id'] = $cred_id;
      $data1['esta_cred_usua_id'] = $usua_id;
      $data1['esta_cred_cred_leid_id'] = $leid_id;
      $data1['esta_cred_estado'] = "E";
      $data1['esta_cred_enviado_a'] = "CARTERA";
      $data1['esta_cred_comentarios'] = $comen_comentarios ; 
      $data1['esta_cred_fecha'] = Date('Y-m-d H:i:s'); 
      $this->credito_model->insertar_tablas('estados_creditos', $data1);
    }
    $this->ajax_result(true,"Credito enviado correctamente.");
  } 
  
  function cambiar_estado_general(){
  $usua_id           = $this->input->post('estado_usua_id');       
  $cred_id           = $this->input->post('estado_cred_id');
  $estado            = $this->input->post('estado_estado');
  $estado_comentarios = $this->input->post('estado_comentarios');
  $this->credito_model->modificar_tablas('creditos','cred_id', Array('cred_estado'=>$estado), $cred_id);

  $data1['esta_cred_cred_id'] = $cred_id;
  $data1['esta_cred_usua_id'] = $usua_id;
  $data1['esta_cred_estado'] = $estado;
  $data1['esta_cred_enviado_a'] = $this->session->userdata('rol_nombre');
  $data1['esta_cred_comentarios'] = $estado_comentarios ; 
  $data1['esta_cred_fecha'] = Date('Y-m-d H:i:s'); 

    $leido = $this->credito_model->buscar('creditos_leidos', Array('cred_leid_cred_id'=>$cred_id,'cred_leid_usua_id'=>$this->session->userdata('usuario_id')) ) ;
  if($leido){
     $data1['esta_cred_cred_leid_id'] = $leido->row()->cred_leid_id;   
    }

  $this->credito_model->insertar_tablas('estados_creditos', $data1);
  $this->ajax_result(true,"Estado actualizado correctamente."); 
 }

 function todos(){
 $this->session->unset_userdata('creditos_filtro');
 redirect('credito/inicio/index');
 }
   
 function eliminar(){
 $result=0;
 $this->load->model('credito_model');   
 $id = $this->input->post('id');   
       
 $result=$this->credito_model->eliminar('creditos','cred_id',$id);
 if($result){
     $this->ajax_result(true,"Producto eliminado correctamente!");
     }else{
          $this->ajax_result(false,"El credito no fue eliminado");
      }
 }
     
 function exportar(){
 $filtros_creditos =   $this->session->userdata('creditos_filtro');  
 $data['creditos'] = $this->credito_model->get_credito($filtros_creditos);
 $data['filtro'] = $filtros_creditos ;     
 $this->load->view('exportar_credito_view',$data);   
 } 
    
 function impresion($cred_id){
 $data['creditos'] = $this->credito_model->get_credito(Array('cred_id'=>$cred_id) );
 if($data['creditos']){
    $data['creditos']= $data['creditos']->row();
    $this->imprimir('impresion_credito_view',$data,null,null,null,null,'credito.js');  
  }       
 }  
 function mostrar_estados(){ 
 $cred_id = $this->input->post('cred_id');    
 $data['creditos'] = $this->credito_model->get_estados(Array('esta_cred_cred_id'=>$cred_id));
 $this->load->view('estados_creditos_view',$data);
}   
   
      
   
    
}

