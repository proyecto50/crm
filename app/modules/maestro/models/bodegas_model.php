<?php

class bodegas_model extends MY_Model
{
    function __construct()
    {
      parent::Model();
    }

    function get_bodegas($filtros=null, $limit=null, $offset=null)
    {
        if(!is_null($filtros))
        {
         if(!empty ($filtros['bode_codigo'])) $query = $this->db->where ('bode_codigo',$filtros['bode_codigo']);
         if(!empty ($filtros['bode_nombre'])) $query = $this->db->like ('bode_nombre',$filtros['bode_nombre']);
         if(!empty ($filtros['bode_estado'])) $query = $this->db->like ('bode_estado',$filtros['bode_estado']);
        }
       
        $query = $this->db->join('companias','comp_id=bode_comp_id');
        $query= $this->db->get('bodegas',$limit, $offset);

        return ($query->num_rows() >0 ) ? $query : false;
        
    }

}