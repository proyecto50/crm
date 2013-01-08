<?php

class MY_Model extends Model{
	private $_table;
	
	public function __construct( $table ){
		parent::__construct();
		$this->_table = $table;
	}
		
        function modificar_tablas($tabla,$campoid,$data,$id){

          if(!is_null($id)){
            $this->db->where($campoid, $id);
          }
            $this->db->update($tabla, $data);
            

       //echo $this->db->last_query();

        if($this->db->affected_rows()>0){
            return $id;//ultimo insertado
        }else{
            //echo "error al ingresar datos a la tabla region o no se modifico nada";
            return false;
        }

}

        function modificar_tablas_general($tabla,$data,$campo_in=null,$where_in=null,$where=null){
                   
          if(!is_null($where_in)){
          $query = $this->db->where_in($campo_in, $where_in);
          }
          
          if(!is_null($where)){
          $query = $this->db->where($where);
          }
          
          $this->db->update($tabla, $data);         
     
          if($this->db->affected_rows()>0){
            return true;
         }else{          
            return false;
        }

}

        function insertar_tablas($tabla,$vecdata){

        $this->db->insert($tabla, $vecdata);

        //log_message('debug',$this->db->last_query());

        if($this->db->affected_rows()>0){

            return $this->db->insert_id();//ultimo insertado
        }else{

            return false;
        }

}

        function buscar($tabla=null,$where=null,$limit=null,$offset=null,$like=null,$where2=null,$order_by=null,$order_tipo='asc',$in=null){

         if(!is_null($where))$query = $this->db->where($where);
         if(!is_null($where2))$query = $this->db->where_not_in($where2[0],$where2[1]);
         if(!is_null($in))$query = $this->db->where_in($in[0],$in[1]);
        
         if(!is_null($like))$query = $this->db->like($like);
         if(!is_null($order_by))$query = $this->db->order_by ($order_by,$order_tipo);
         
         $query =  $this->db->get($tabla,$limit,$offset);

         return ($query->num_rows() > 0) ? $query : false;

          }

        function eliminar($tabla,$field, $val){
		$this->db->where($field,$val);
		$this->db->delete($tabla);
		return ($this->db->affected_rows() > 0) ? $this->db->affected_rows() : 0;
	}
        
        function eliminar_general($tabla,$arreglo){
		$this->db->delete($tabla, $arreglo); 
		return ($this->db->affected_rows() > 0) ? $this->db->affected_rows() : 0;
	}

        function option_select($resulset=null,$id=null,$nombre=null,$select=null,$nombre2=null){

           if($resulset){
               if(!is_null($select)){
                $option = '<option value="">Seleccionar</option>';  
               }else{
               $option ='';}
               foreach($resulset->result() as $re ){
                if(is_null($nombre2)){   
                $option.='<option value="'.$re->$id.'">'.$re->$nombre.'</option>';
                }else{
                $option.='<option value="'.$re->$id.'">'.$re->$nombre.'-'.$re->$nombre2.'</option>';    
                }
               }
               return $option;
           }else{
               
                return null;
                
           }

           
       }

        function export_zip($query=null, $campos=null,$nombre='fichero'){
        
       if (!$query ) {
		return null;
	}
        
        if (is_null($campos) ) {
		return null;
	}
        
       $txt = fopen("assets/archivos/".$nombre.".txt","w"); 

       foreach ($query->result() as $row){
        
         $line = ''; 
         foreach($campos as $campo){
           if( isset($row->$campo) ){
              $line .= $row->$campo.';';
              }             
         } 
    
     $line = substr($line,0,  strlen($line)-1 );    
     $line = $line."\r\n";
      
     fputs($txt,$line);
       }
     fclose($txt); 
       $this->load->library('zip');
       
       $this->zip->read_file("assets/archivos/".$nombre.".txt");
       $this->zip->download($nombre.'.zip'); 
       }
       
        function correo($correo=null,$asunto=null,$msg=null){     
        $this->load->library('email');
        $config['mailtype'] = 'html';

        $this->email->initialize($config);
        $this->email->from('jhon.atencio@gmail.com', 'Senscore');
        $this->email->to($correo);
        $this->email->subject($asunto);        
        $this->email->message($msg);
        $v = $this->email->send();
 
        return $v;
 
        }

}
