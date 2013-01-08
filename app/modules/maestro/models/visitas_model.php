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
class visitas_model extends MY_Model {
    function __construct() {
        parent::Model();
    }

    function get_visitas($filtros=null,$limit=null,$offset=null){
     
      if(!is_null($filtros))
      {
       if(!empty ($filtros['tvis_codigo'])) $query = $this->db->where ('tvis_codigo',$filtros['tvis_codigo']);
       if(!empty ($filtros['tvis_nombre'])) $query = $this->db->like ('tvis_nombre',$filtros['tvis_nombre']);
        
      }
     
      $query = $this->db->get('tipo_visita',$limit,$offset);

      return ($query->num_rows() > 0) ? $query : false;
    }
}


?>
