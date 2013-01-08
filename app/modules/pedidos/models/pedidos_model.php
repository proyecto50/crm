<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of cargues_model
 *
 * @author erick
 */
class pedidos_model extends MY_Model {
  function __construct() {
        parent::Model();
    }

  function get_pedidos($filtros=null,$limit=null,$offset=null,$not=null) {
      ini_set('memory_limit', '250M');
     
      if(!is_null($filtros)){
        if(!empty($filtros['pedi_id']))       $query = $this->db->where('pedi_id',$filtros['pedi_id']);
        if(!empty($filtros['pedi_codigo']))   $query = $this->db->where('pedi_codigo',$filtros['pedi_codigo']);
        if(!empty($filtros['clie_cedula']))   $query = $this->db->where('clie_cedula',$filtros['clie_cedula']);
        if(!empty($filtros['clie_id']))       $query = $this->db->where('clie_id',$filtros['clie_id']);
        
        if(!empty($filtros['clie_cliente']))  $query = $this->db->like('clie_cliente',$filtros['clie_cliente']);
        if(!empty($filtros['clie_negocio']))  $query = $this->db->like('clie_negocio',$filtros['clie_negocio']);
       
        if(!empty($filtros['usua_id']))       $query = $this->db->where('usua_id',$filtros['usua_id']);
        if(!empty($filtros['rol_id']))        $query = $this->db->where('rol_id',$filtros['rol_id']);
        
        if( !empty($filtros['fi']) )          $query =$this->db->where('pedi_fecha >= ',$filtros['fi']);
        if( !empty($filtros['ff']) )          $query =$this->db->where('pedi_fecha <= ',$filtros['ff'].' 23:59:59');
        if( !empty($filtros['pedi_estado']) ) $query =$this->db->where('pedi_estado',$filtros['pedi_estado']);
        if( !empty($filtros['pedi_tipo']) )   $query =$this->db->where('pedi_tipo',$filtros['pedi_tipo']);
       }    
       
       if(!is_null($not)){
        $query = $this->db->where_not_in('pedi_estado', $not);   
       }
       
      $query = $this->db->select('*');
      $query= $this->db->select('DATE_FORMAT(pedi_fecha,"%Y-%m-%d")pedi_fecha',false);
      $query= $this->db->select('sum(dped_cantidad) cantidad',false);
      $query= $this->db->select('sum( dped_precio_coniva * dped_cantidad ) total',false);
      $query= $this->db->select('sum( dped_precio_sugerido * dped_cantidad ) total_sugerido',false);
      $query= $this->db->join('usuarios', 'pedi_usua_id=usua_id');
      $query= $this->db->join('clientes', 'pedi_clie_cedula=clie_cedula and pedi_clie_sucursal=clie_sucursal','left');
      $query= $this->db->join('detalle_pedidos', 'dped_pedi_id=pedi_id');
      $query= $this->db->join('inventarios', 'inve_codigo=dped_inve_codigo','left');      
      $query= $this->db->join('roles', 'pedi_esta_en=rol_id','left');      
    
      $query = $this->db->group_by('pedi_id');
       $query = $this->db->order_by('pedi_id','desc');
      
      $query = $this->db->get('pedidos',$limit,$offset);
          
      return ($query->num_rows() > 0) ? $query : false;
      
    }
          
  function get_detalle($filtros=null){
     
      if(!is_null($filtros)){
        if(!empty($filtros['pedi_id']))     $query = $this->db->where('pedi_id',$filtros['pedi_id']);
        if(!empty($filtros['pedi_numero'])) $query = $this->db->where('pedi_numero',$filtros['pedi_numero']);
        if(!empty($filtros['clie_cedula'])) $query = $this->db->where('clie_cedula',$filtros['clie_cedula']);
        if(!empty($filtros['clie_cliente']))$query = $this->db->like('clie_cliente',$filtros['clie_cliente']);
        if(!empty($filtros['usua_id']))     $query = $this->db->where('usua_id',$filtros['usua_id']);
        if(!empty($filtros['fi']) )         $query =$this->db->where('pedi_fecha >= ',$filtros['fi']);
        if(!empty($filtros['ff']) )         $query =$this->db->where('pedi_fecha <= ',$filtros['ff'].' 23:59:59');
        if(!empty($filtros['pedi_estado'])) $query =$this->db->where('pedi_estado = ',$filtros['pedi_estado']);
      
      }
      $query = $this->db->select('*');
      $query= $this->db->join('detalle_pedidos', 'pedi_id=dped_pedi_id');
      $query= $this->db->join('inventarios','inve_codigo=dped_inve_codigo','left');          
      $query= $this->db->join('clientes', 'pedi_clie_cedula=clie_cedula and pedi_clie_sucursal=clie_sucursal','left');
      $query= $this->db->join('usuarios', 'pedi_usua_id=usua_id');
                
      $query = $this->db->get('pedidos');
  
      return ($query->num_rows() > 0) ? $query : false;
    }
            
  function eliminar_pedidos($in){
         $this->db->where_in('pedi_id', $in);
         $this->db->delete('pedidos');
     }
   
  function get_estados($filtros=null){
  if(!is_null($filtros)){
     if(!empty($filtros['pedi_id']))     $query = $this->db->where('pedi_id',$filtros['pedi_id']);          
  }  
  $query= $this->db->join('usuarios', 'esta_usua_id=usua_id');
  $query= $this->db->join('pedidos','esta_pedi_id=pedi_id');          
  $query= $this->db->join('leidos', 'esta_leid_id=leid_id','left');             
  $query = $this->db->get('estados');  
  return ($query->num_rows() > 0) ? $query : false;
  }   
              
    }   
