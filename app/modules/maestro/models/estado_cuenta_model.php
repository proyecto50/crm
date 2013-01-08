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
class estado_cuenta_model extends MY_Model {
    function __construct() {
        parent::Model();
    }

    function get_estado_cuenta($filtros=null,$limit=null,$offset=null){
     
      if(!is_null($filtros))
      {
       if(!empty ($filtros['estc_clie_cedula'])) $query = $this->db->where ('estc_clie_cedula',$filtros['estc_clie_cedula']);
       if(!empty ($filtros['clie_cliente'])) $query = $this->db->like ('clie_cliente',$filtros['clie_cliente']);
       if(!empty ($filtros['estc_tipo_documento'])) $query = $this->db->like ('estc_tipo_documento',$filtros['estc_tipo_documento']);
       if(!empty ($filtros['estc_factura'])) $query = $this->db->like ('estc_factura',$filtros['estc_factura']);
       if(!empty ($filtros['estc_fecha_fi'])) $query = $this->db->where ('estc_fecha >=',$filtros['estc_fecha_fi']);
       if(!empty ($filtros['estc_fecha_ff'])) $query = $this->db->where ('estc_fecha <=',$filtros['estc_fecha_ff']);
       if(!empty ($filtros['estc_fecha_vencimiento_fi'])) $query = $this->db->where ('estc_fecha_vencimiento >=',$filtros['estc_fecha_vencimiento_fi']);
       if(!empty ($filtros['estc_fecha_vencimiento_ff'])) $query = $this->db->where ('estc_fecha_vencimiento <=',$filtros['estc_fecha_vencimiento_ff']);
     
       }
      $query= $this->db->select('estado_cuenta.*,clie_cedula,clie_cliente'); 
     
      $query= $this->db->distinct();
      $query= $this->db->join('clientes','estc_clie_cedula=clie_cedula','left');
      $query = $this->db->get('estado_cuenta',$limit,$offset);

      return ($query->num_rows() > 0) ? $query : false;
    }
}

