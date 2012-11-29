<?php
class Inicio extends Controller {

	public function __construct(){
	  parent::__construct();
          $this->load->model('auth_model');
	}
	
	public function index($msg=null){
         $data['msg']=$msg;        
         $this->load->view('auth_view',$data);
        }
	      
        function valid_user(){
        $msg = "Error";
        $usuario = $this->input->post('usuario');

        $result =  $this->_validar($usuario);
        if($result){
          redirect('control/inicio');
        }else{
           redirect('auth/inicio/index/'.$msg);
        }
                
        
        }
        
        function _validar($usuario){
            $result = $this->auth_model->auth_usuario($usuario);
            if($result){
                 $credenciales = Array(
                     'logged_in'=>true,
                     'rol'=>$result->rol_id,
                     'rol_nombre'=>$result->rol_nombre,
                     'usuario_cedula'=>$result->usua_cedula,
                     'usuario_nombre'=>$result->usua_nombre,
                     'usuario_id'=>$result->usua_id,
                     'usuario_clave'=>$result->usua_clave,
                     'compania_id'=>$result->comp_id,
                     'compania_nit'=>$result->comp_nit,
                     'compania_nombre'=>$result->comp_nombre,
                     'compania_id'=>$result->comp_id,
                     'compania_direccion'=>$result->comp_direccion,
                     'compania_ciudad'=>$result->comp_ciudad,
                     'compania_telefono'=>$result->comp_telefono,
                     'compania_resolucion'=>$result->comp_resolucion,
                     'compania_init_factura'=>$result->comp_init_factura,
                     'compania_end_factura'=>$result->comp_init_factura,
                     'bode_id'=>$result->bode_id ,
                     'bode_nombre'=>$result->bode_nombre
                 );
             $this->session->set_userdata($credenciales);
             return true;
            }else{
             return false;
            }
            
        }
      
        public function logout(){
	$this->session->sess_destroy();
	redirect('auth/inicio');
	}
        
}
