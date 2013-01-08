<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of usuario_model
 *
 * @author erick
 */
class clientes_model extends MY_Model {
    function __construct() {
        parent::Model();
    }

    function get_clientes($filtros=null,$limit=null,$offset=null){
     
      if(!is_null($filtros))
      {
       if(!empty ($filtros['clie_cedula'])) $query = $this->db->where ('clie_cedula',$filtros['clie_cedula']);
       if(!empty ($filtros['clie_cliente'])) $query = $this->db->like ('clie_cliente',$filtros['clie_cliente']);
       if(!empty ($filtros['clie_negocio'])) $query = $this->db->like ('clie_negocio',$filtros['clie_negocio']);
       if(!empty ($filtros['clie_id'])) $query = $this->db->where ('clie_id',$filtros['clie_id']);
       
      }
     
      $query = $this->db->get('clientes',$limit,$offset);

      return ($query->num_rows() > 0) ? $query : false;
    }
    
    function get_dcliente($filtros=null,$limit=null,$offset=null){
     
    if(!is_null($filtros))
    {
       if(!empty ($filtros['clie_id'])) $query = $this->db->where ('clie_id',$filtros['clie_id']);
    }   
    $query= $this->db->join('clientes', 'clie_cedula=estc_clie_cedula');
    $query = $this->db->get('estado_cuenta',$limit,$offset);

    return ($query->num_rows() > 0) ? $query : false;
    }
}

