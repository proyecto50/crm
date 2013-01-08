<?php

class visitas extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
                $this->load->model('visitas_model');
                $this->load->model('paginador_model');
                $this->load->library('pagination');
                
	}

	public function index()
        {

        $filtro_visitas = $this->input->post('visitas');

        $filtros_visitas = $this->paginador_model->filtro($filtro_visitas,'visitas_filtro');
        /**
         * configuracion de paginacion
         */
        $data['visitas'] = $this->visitas_model->get_visitas($filtros_visitas);
      
        $total_rows= (($data['visitas']==false))? 0 : $data['visitas']->num_rows();
        $base_url =  site_url('maestro/visitas/index');
        $config = $this->paginador_model->paginar( $total_rows,$base_url);
        $perpage = $this->paginador_model->get_perpage();
        $this->pagination->initialize($config);
        /**
        * fin paginacion.
        */
    
        $data['per_page'] = $perpage;

        $data['visitas'] = $this->visitas_model->get_visitas($filtros_visitas,$perpage,$this->uri->segment(4));
           
        $data['vista_nueva_visita'] = $this->load->view('nueva_visita_view',null,true);
        $data['vista_editar_visita'] = $this->load->view('edit_visita_view',null,true);
        $data['vista_buscar_visita'] = $this->load->view('buscar_visita_view',null,true);

        $menu = array ( array('callback' =>'nueva_visita();return false;','val' => '<img class="qtip" alt="Nueva visita"  src="'.base_url().'assets/images/add-files.png" />'),
                        array('callback' =>'buscar_visita();return false;','val' => '<img class="qtip" alt="Buscar visita" src="'.base_url().'assets/images/search.png" />'),
                        array('val' => '<img class="qtip" alt="Mostrar Todos" src="'.base_url().'assets/images/all.png" />','href' => site_url('maestro/visitas/todos'))
                    
                      );

        $this->run('visitas_view',$data,'Listado de visitas', $menu, null,null,'visitas.js');

      }

      function guardar()
      {
         $result=0;
         $visitas = $this->input->post('visitas');
            
         /**
           * se verifica si la codigo de la visita existe
            */
         $result = $this->visitas_model->buscar('tipo_visita', Array('tvis_codigo'=>$visitas['tvis_codigo']));
         if(!$result){
             $result=$this->visitas_model->insertar_tablas('tipo_visita', $visitas);
                  if($result){
                        $visitas['tvis_id']=$result;
                        $this->ajax_result(true,"Visita agregada correctamente",$visitas);
                  }else{ $this->ajax_result(true,"No se pudo agregar la visita");}
         }else{
               $this->ajax_result(false,"El codigo ya existe!");
              }
      }
        
      function editar()
      {
           $id_visita = $this->input->post('id_edit_visita');
           $visitas = $this->input->post('visitas');
           $codigo_recibido=$visitas['tvis_codigo'];

           $codigo_actual=  $this->visitas_model->buscar('tipo_visita', array('tvis_id'=>$id_visita));
           $codigo_actual= $codigo_actual->row();
           $codigo_actual= $codigo_actual->tvis_codigo;
          
          if($codigo_recibido==$codigo_actual){

              $result = $this->visitas_model->modificar_tablas('tipo_visita', 'tvis_id',$visitas, $id_visita);

              if($result){
                  $visitas['tvis_id']=$result;
                  $this->ajax_result(true, "Visita modificada correctamente",$visitas);
              }else{$this->ajax_result(false, "La visita no fue editada");}

          }else if($codigo_recibido != $codigo_actual ){
               $result=  $this->visitas_model->buscar('tipo_visita', array('tvis_codigo'=>$codigo_recibido));

               if($result){
                       $this->ajax_result(false, "El codigo de la visita ya existe!");
               }else{
                   $result = $this->visitas_model->modificar_tablas('tipo_visita', 'tvis_id',$visitas, $id_visita);

                   if($result){
                       $visitas['tvis_id']=$result;
                       $this->ajax_result(true, "Visita modificada correctamente",$visitas);
                   }else{$this->ajax_result(false, "La visita no fue editada");}
               }
          }
     }
     function todos()
     {
         $this->session->unset_userdata('visitas_filtro');
	 redirect('maestro/visitas/index');
     }
}
