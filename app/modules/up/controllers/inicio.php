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
    function __construct() {
    parent::__construct(); 
    $this->load->model('up_model');
    set_time_limit(0);
   }
    
    public function mapf_inventario(){		
    $config['upload_path']   = './tmp/inventario/';
    $config['allowed_types'] = 'csv';
    $config['max_size']	     = '1000';  
    
    $data['formato'] = 'FORMATO_INVENTARIO.xlsx';
    $data['action']  = 'mapf_inventario';
    $this->load->library('upload', $config);
    if ( !$this->upload->do_upload()){
    $data['error'] =  $this->upload->display_errors();
    $this->run('map_form',$data,'Mapeo de Inventario');
    }else{
    $data['upload_data'] = $this->upload->data();
    $return  = $this->map_inventario($data['upload_data']['file_name']);
    $data['map_result'] = $return;
    $this->run('map_success',$data,'Mapeo de Inventario Realizado');
	}
    }

    public function map_inventario( $filename ){
    $path = './tmp/inventario/'.$filename;
    if(!file_exists( $path ) ){
    return 'El archivo ' . $filename . ' no existe.';
    }
    $l = fopen($path,'r');
    $i = 0;  
    $productos  = 0;
    $cantidades = 0;    
    //inicio de la transaccion
    $this->db->trans_begin();
    $this->db->truncate('inventarios'); 		
    // Recorremos cada linea.
    while($line = fgets($l)){
    // Separamos los campos
    $fields = explode( ';',$line );
    
    if($i>5){
    if($fields[0] !=''){    
    $producto['inve_codigo'] = $fields[0] ;
    $producto['inve_descripcion'] = $fields[1] ;
    $producto['inve_precio_con_iva'] = str_replace('.','',$fields[2]);
    $producto['inve_porcentaje_iva'] = 16;
    $producto['inve_descuento'] = 0;
    $producto['inve_cantidad'] =str_replace('.','',$fields[3]);
    $producto['inve_bode_id'] =1;
    $producto['inve_estado'] ='A';
    $producto['inve_fecha'] =Date('Y-m-d H:i:s');
    if($fields[4]=='PROMOCION')$producto['inve_tipo'] ='PM';
    if($fields[4]=='LINEA')$producto['inve_tipo'] ='F';
    if($fields[4]=='PREVENTA')$producto['inve_tipo'] ='PV';   
    
    $result=$this->up_model->insertar_tablas('inventarios', $producto);
    $productos++;
    $cantidades+=str_replace('.','',$fields[3]);    
      
    }
    }   
   $i++;			
   }//fin while
    $this->up_model->insertar_tablas('log_inventarios',Array('logi_usua_id'=>  $this->session->userdata('usuario_id'),'logi_fechasistema'=>Date('Y-m-d H:i:s')) ); 
        
    if($this->db->trans_status() == false){
            $this->db->trans_rollback();
            return 'No se pudo actualizar el inventario.';
         }else{
             $this->db->trans_commit();            
             return 'Inventario actualizado correctamente.<br/>Productos '.$productos.'<br/>Cantidades '.$cantidades;
         }		
   }
   
    public function mapf_clientes(){		
    $config['upload_path']   = './tmp/clientes/';
    $config['allowed_types'] = 'csv';
    $config['max_size']	     = '1000';  
    
    $data['formato'] = 'FORMATO_CLIENTES.xlsx';
    $data['action']  = 'mapf_clientes';
    $this->load->library('upload', $config);
    if ( !$this->upload->do_upload()){
    $data['error'] =  $this->upload->display_errors();
    $this->run('map_form',$data,'Mapeo de Clientes');
    }else{
    $data['upload_data'] = $this->upload->data();
    $return  = $this->map_clientes($data['upload_data']['file_name']);
    $data['map_result'] = $return;
    $this->run('map_success',$data,'Mapeo de Clientes Realizado');
	}
    }

    public function map_clientes( $filename ){
    $path = './tmp/clientes/'.$filename;
    if(!file_exists( $path ) ){
    return 'El archivo ' . $filename . ' no existe.';
    }
    $l = fopen($path,'r');
    $i = 0;  
    $clientes  = 0;
   
    //inicio de la transaccion
    $this->db->trans_begin();
    $this->db->truncate('clientes'); 		
    // Recorremos cada linea.
    while($line = fgets($l)){
    // Separamos los campos
    $fields = explode( ';',$line );
    
    if($i>0){
    if($fields[0] !=''){    
    $cliente['clie_cedula']   = $fields[0];
    $cliente['clie_sucursal'] = $fields[1];
    $cliente['clie_cliente'] = $fields[2];
    $cliente['clie_negocio'] = $fields[3];
    $cliente['clie_direccion'] = $fields[4];
    $cliente['clie_barrio']     = $fields[5];
    $cliente['clie_telefono'] = $fields[6];
    $cliente['clie_fax'] = $fields[7];
    $cliente['clie_mail'] = $fields[8];
    $cliente['clie_cupo'] = $fields[9];
    $cliente['clie_fechacreacion'] = Date('Y-m-d',strtotime($fields[10]));
    $cliente['clie_comentarios'] = $fields[11];
    $cliente['clie_ciudad'] = $fields[12];   
    $cliente['clie_fechasistema'] = Date('Y-m-d H:i:s');
    
    $result=$this->up_model->insertar_tablas('clientes', $cliente);
    $clientes++;    
    }
    }   
   $i++;			
   }//fin while
   $this->up_model->insertar_tablas('log_clientes',Array('logc_usua_id'=>  $this->session->userdata('usuario_id'),'logc_fechasistema'=>Date('Y-m-d H:i:s')) ); 
   if($this->db->trans_status() == false){
            $this->db->trans_rollback();
            return 'No se pudo actualizar la base de datos de clientes.';
         }else{
             $this->db->trans_commit();            
             return 'Base de datos de clientes actualizada correctamente.<br/>Clientes '.$clientes;
         }      	
   }
   
    public function mapf_cartera(){		
    $config['upload_path']   = './tmp/cartera/';
    $config['allowed_types'] = 'csv';
    $config['max_size']	     = '1000';  
    
    $data['formato'] = 'FORMATO_CARTERA.xlsx';
    $data['action']  = 'mapf_cartera';
    $this->load->library('upload', $config);
    if ( !$this->upload->do_upload()){
    $data['error'] =  $this->upload->display_errors();
    $this->run('map_form',$data,'Mapeo de Cartera');
    }else{
    $data['upload_data'] = $this->upload->data();
    $return  = $this->map_cartera($data['upload_data']['file_name']);
    $data['map_result'] = $return;
    $this->run('map_success',$data,'Mapeo de Cartera Realizado');
	}
    }
   
    public function map_cartera( $filename ){
    $path = './tmp/cartera/'.$filename;
    if(!file_exists( $path ) ){
    return 'El archivo ' . $filename . ' no existe.';
    }
    $l = fopen($path,'r');
    $i               = 0;  
    $total           = 0;
    $cedula_anterior ='';
    $tipo_anterior   = '';
   
    //inicio de la transaccion
    $this->db->trans_begin();
    $this->db->truncate('estado_cuenta'); 		
    // Recorremos cada linea.
    while($line = fgets($l)){
    // Separamos los campos
    $fields = explode( ';',$line );
    
    if($i>3){
    if($fields[3] !=''){ 
        
    if($fields[0]==''){
    $cartera['estc_clie_cedula']= $cedula_anterior;     
    }else{
      $cartera['estc_clie_cedula']= $fields[0];
      $cedula_anterior = $fields[0];
    }    
    if($fields[2]==''){
    $cartera['estc_tipo_documento']=  $tipo_anterior;
    }else{
    $cartera['estc_tipo_documento']=  $fields[2] ; 
    $tipo_anterior =  $fields[2] ; 
    }
    
    $cartera['estc_factura']=  $fields[3] ; 
    $cartera['estc_fecha']=  Date('Y-m-d',strtotime($fields[4]));
    $cartera['estc_fecha_vencimiento']=  Date('Y-m-d',strtotime($fields[5]));
    $cartera['estc_dias_mora']=  $fields[6];
    $cartera['estc_saldo']=  str_replace('.','',$fields[7]);
    $cartera['estc_usua_id']=  $this->session->userdata('usuario_id');
    $cartera['estc_fechasistema']=  Date('Y-m-d H:i:s');   
    
    $result=$this->up_model->insertar_tablas('estado_cuenta', $cartera);
    $total+=$cartera['estc_saldo'];   
    }
    }   
   $i++;			
   }//fin while
   $this->up_model->insertar_tablas('log_cartera',Array('logc_usua_id'=>  $this->session->userdata('usuario_id'),'logc_fechasistema'=>Date('Y-m-d H:i:s')) ); 
   if($this->db->trans_status() == false){
            $this->db->trans_rollback();
            return 'No se pudo actualizar la cartera.';
         }else{
             $this->db->trans_commit();            
             return 'Cartera actualizada correctamente.<br/>Total General '.$total;
         }      	
   }
   
}