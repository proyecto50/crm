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
class credito_model extends MY_Model{
    function __construct() {
        parent::Model();
    }

    function get_credito($filtros=null, $limit=null, $offset=null){
    if(!is_null($filtros)){
    if(!empty($filtros['cred_id'])) $query= $this->db->where('cred_id',$filtros['cred_id']);
    if(!empty($filtros['cred_codigo'])) $query= $this->db->where('cred_codigo',$filtros['cred_codigo']);
    if(!empty($filtros['cred_descripcion'])) $query= $this->db->like('cred_descripcion',$filtros['cred_descripcion']);
    if(!empty($filtros['rol_id'])) $query= $this->db->where('rol_id',$filtros['rol_id']);
     }
    $query = $this->db->select('*');
    $query= $this->db->select('DATE_FORMAT(cred_fecha_sistema,"%Y-%m-%d")cred_fecha_sistema',false);
    $query= $this->db->join('clientes', 'cred_clie_cedula=clie_cedula');
    $query= $this->db->join('roles', 'cred_esta_en=rol_id','left');
    $query= $this->db->get('creditos',$limit,$offset);
    return ($query->num_rows >0 ) ? $query : false;

    }
    
    function get_estados($filtros=null){
    if(!is_null($filtros)){
    if(!empty($filtros['esta_cred_cred_id']))     $query = $this->db->where('esta_cred_cred_id',$filtros['esta_cred_cred_id']);          
     }  
    $query = $this->db->select('*');
    $query= $this->db->select('DATE_FORMAT(esta_cred_fecha,"%Y-%m-%d")esta_cred_fecha',false);
    $query= $this->db->join('creditos', 'esta_cred_cred_id=cred_id');      
    $query= $this->db->join('usuarios','esta_cred_usua_id=usua_id');
    $query= $this->db->join('creditos_leidos','cred_leid_cred_id=esta_cred_cred_leid_id','left');
    $query = $this->db->get('estados_creditos');  
    return ($query->num_rows() > 0) ? $query : false;
   } 
}
