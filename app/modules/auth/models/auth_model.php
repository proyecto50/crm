<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of auth_model
 *
 * @author jhon
 */
class auth_model extends MY_Model {

    function __construct() {
        parent::__construct(null);
    }


    function auth_usuario($filtro=null){

      $query = $this->db->where($filtro);
      $query = $this->db->where('usua_estado','A');
      $query = $this->db->join('roles','rol_id=usua_rol_id');
      $query = $this->db->join('bodegas','bode_id=usua_bode_id');
      $query = $this->db->join('companias','comp_id=bode_comp_id');
      $query = $this->db->get('usuarios');
 
      return ($query->num_rows() > 0) ? $query->row() : false;
    }    
    
    function auth_vendedor($filtro=null){
     $query = $this->db->where($filtro);  
     $query = $this->db->where('vend_estado','A');
     $query = $this->db->join('companias','comp_id=vend_comp_id');
     $query = $this->db->get('vendedores'); 
     return ($query->num_rows() > 0) ? $query->row() : false;  
    }
}