<?php

class empresa extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
                $this->load->model('empresa_model');
	}

	public function index(){

        $menu = array ( array('callback' =>'editar_empresa(); return false;','val' => '<img class="qtip" alt="Guardar"  src="'.base_url().'assets/images/save.png" />')
			);
        $where['comp_id'] = $this->session->userdata('compania_id');
    	$data['empresa'] = $this->empresa_model->buscar('companias', $where);
        $data['empresa'] = $data['empresa']->row();
        $this->run('empresa_view',$data,'Informaci&oacute;n dela empresa', $menu,null,null,'empresa.js');
        }

        function editar($id_empresa){

        $empresa    = $this->input->post('empresa');
        $id_empresa = $this->input->post('id_empresa');
        $result = $this->empresa_model->modificar_tablas('companias','comp_id',$empresa, $id_empresa);
 
        if($result) {
            $this->ajax_result(true,'Empresa actualizada');

            }else{  $this->ajax_result(false,'No hubo cambios.');
            }
        }
}
