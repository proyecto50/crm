<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of inventario_model
 *
 * @author erick
 */
class inventario_model extends MY_Model{
    function __construct() {
        parent::Model();
    }

    function get_inventario($filtros=null, $limit=null, $offset=null){
    
        if(!is_null($filtros)){
           if(!empty($filtros['inve_codigo'])) $query= $this->db->where('inve_codigo',$filtros['inve_codigo']);
           if(!empty($filtros['inve_descripcion'])) $query= $this->db->like('inve_descripcion',$filtros['inve_descripcion']);
           }
       
       $query = $this->db->join('bodegas','bode_id=inve_bode_id');
       $query = $this->db->join('companias','bode_comp_id=comp_id');
       $query= $this->db->order_by('inve_fecha', 'desc');
       $query= $this->db->get('inventarios',$limit,$offset);
      ;

       return ($query->num_rows >0 ) ? $query : false;

    }
    
    function get_producto($filtro=null)
    {
        
          if(!is_null($filtro)){
           if(!empty($filtro['inve_codigo'])) $query= $this->db->where('inve_codigo',$filtro['inve_codigo']);
           if(!empty($filtro['inve_id'])) $query= $this->db->where('inve_id',$filtro['inve_id']);
          }
          $query = $this->db->join('bodegas','bode_id=inve_bode_id');
          $query= $this->db->get('inventarios');
  
         return ($query->num_rows >0 ) ? $query : false;
    }
   
   
     
   
    
    
       
    

}
