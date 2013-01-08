<?php

class transportadoras extends MY_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->model('transportadoras_model');
        $this->load->model('paginador_model');
        $this->load->library('pagination');
    }

    function index()
    {
        $filtro_transportadoras = $this->input->post('transportadoras');

        $filtros_transportadoras = $this->paginador_model->filtro($filtro_transportadoras,'transportadora_filtro');
        /**
         * configuracion de paginacion
         */
        $data['transportadoras'] = $this->transportadoras_model->get_transportadoras($filtros_transportadoras);

        $total_rows= (($data['transportadoras']==false))? 0 : $data['transportadoras']->num_rows();
        $base_url =  site_url('maestro/transportadoras/index');
        $config = $this->paginador_model->paginar( $total_rows,$base_url);
        $perpage = $this->paginador_model->get_perpage();
        $this->pagination->initialize($config);
        /**
        * fin paginacion.
        */

        $data['per_page'] = $perpage;

        $data['transportadoras'] = $this->transportadoras_model->get_transportadoras($filtros_transportadoras,$perpage,$this->uri->segment(4));
       
        $data['vista_nueva_transportadora'] = $this->load->view('nueva_transportadora_view',null,true);
        $data['vista_editar_transportadora'] = $this->load->view('editar_transportadora_view',null,true);
        $data['vista_buscar_transportadora'] = $this->load->view('buscar_transportadoras_view',null,true);

        $menu = array ( array('callback' =>'nueva_transportadora();return false;','val' => '<img class="qtip" alt="Nueva transportadora"  src="'.base_url().'assets/images/add-files.png" />'),
              array('callback' =>'buscar_transportadora();return false;','val' => '<img class="qtip" alt="Buscar transportadora" src="'.base_url().'assets/images/search.png" />'),
              array('val' => '<img class="qtip" alt="Mostrar todas" src="'.base_url().'assets/images/all.png" />','href'=>site_url('maestro/transportadoras/todos'))

              );

        $this->run('transportadoras_view',$data,'Listado de transportadoras', $menu, null,null,'transportadoras.js');


    }
    function guardar()
    {   
        $transportadoras = $this->input->post('transportadoras');
    
          /**
           * se verifica si el codigo existe
           */
        $result = $this->transportadoras_model->buscar('transportadoras', Array('tran_codigo'=>$transportadoras['tran_codigo']));

          if(!$result){
             
                  $result=$this->transportadoras_model->insertar_tablas('transportadoras', $transportadoras);
                  if($result){
                      $transportadoras['tran_id']=$result;
                      $this->ajax_result(true,"Transportadora agregada correctamente",$transportadoras);
                  }else{$this->ajax_result(true,"No hubo cambios!");}
           }else{ $this->ajax_result(false,"El codigo de transportadora ya existe!"); }
    }
    function editar()
    {
        $id_transportadora = $this->input->post('id_editar_transportadora');
        $transportadoras = $this->input->post('transportadoras');
        $codigo_recibido=$transportadoras['tran_codigo'];

        $codigo_actual=  $this->transportadoras_model->buscar('transportadoras', array('tran_id'=>$id_transportadora));
        $codigo_actual= $codigo_actual->row();
        $codigo_actual= $codigo_actual->tran_codigo;

          if($codigo_recibido==$codigo_actual){

              $result = $this->transportadoras_model->modificar_tablas('transportadoras', 'tran_id',$transportadoras, $id_transportadora);

              if($result){
                  $transportadoras['tran_id']=$result;
                  $this->ajax_result(true, "Transportadora modificada correctamente",$transportadoras);
              }else{$this->ajax_result(false, "No hubo cambios!");}

          }else if($codigo_recibido != $codigo_actual ){
               $result=  $this->transportadoras_model->buscar('transportadoras', array('tran_codigo'=>$codigo_recibido));

               if($result){
                       $this->ajax_result(false, "El codigo de la transportadora ya existe!");
               }else{
                   $result = $this->transportadoras_model->modificar_tablas('transportadoras', 'tran_id',$transportadoras, $id_transportadora);

                   if($result){
                       $transportadoras['tran_id']=$result;
                       $this->ajax_result(true, "Transportadora modificada correctamente",$transportadoras);
                   }else{$this->ajax_result(false, "No hubo cambios!");}
               }
          }

    }
    function todos()
    {
        $this->session->unset_userdata('transportadora_filtro');
        redirect('maestro/transportadoras/index');
    }

}