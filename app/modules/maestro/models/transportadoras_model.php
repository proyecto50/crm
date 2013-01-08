<?php

class transportadoras_model extends MY_Model
{
    function __construct()
    {
      parent::Model();
    }

    function get_transportadoras($filtros=null, $limit=null, $offset=null)
    {
        if(!is_null($filtros))
        {
         if(!empty ($filtros['tran_codigo'])) $query = $this->db->where ('tran_codigo',$filtros['tran_codigo']);
         if(!empty ($filtros['tran_nombre'])) $query = $this->db->like ('tran_nombre',$filtros['tran_nombre']);
        }
       
       $query= $this->db->get('transportadoras',$limit, $offset);

        return ($query->num_rows() >0 ) ? $query : false;
        
    }

}