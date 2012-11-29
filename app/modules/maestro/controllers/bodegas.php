<?php

class bodegas extends MY_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->model('bodegas_model');
        $this->load->model('paginador_model');
        $this->load->library('pagination');
    }

    function index()
    {
        $filtro_bodegas = $this->input->post('bodegas');

        $filtros_bodegas = $this->paginador_model->filtro($filtro_bodegas,'bodega_filtro');
        /**
         * configuracion de paginacion
         */
        $data['bodegas'] = $this->bodegas_model->get_bodegas($filtros_bodegas);

        $total_rows= (($data['bodegas']==false))? 0 : $data['bodegas']->num_rows();
        $base_url =  site_url('maestro/bodegas/index');
        $config = $this->paginador_model->paginar( $total_rows,$base_url);
        $perpage = $this->paginador_model->get_perpage();
        $this->pagination->initialize($config);
        /**
        * fin paginacion.
        */

        $data['per_page'] = $perpage;

        $data['bodegas'] = $this->bodegas_model->get_bodegas($filtros_bodegas,$perpage,$this->uri->segment(4));
        $data1['companias'] = $this->bodegas_model->buscar('companias',Array('comp_estado'=>'A'));
        $data['vista_nueva_bodega'] = $this->load->view('nueva_bodega_view',$data1,true);
        $data['vista_editar_bodega'] = $this->load->view('editar_bodega_view',null,true);
        $data['vista_buscar_bodega'] = $this->load->view('buscar_bodega_view',null,true);

        $menu = array ( array('callback' =>'nueva_bodega();return false;','val' => '<img class="qtip" alt="Nueva bodega"  src="'.base_url().'assets/images/add-files.png" />'),
              array('callback' =>'buscar_bodega();return false;','val' => '<img class="qtip" alt="Buscar bodega" src="'.base_url().'assets/images/search.png" />'),
              array('val' => '<img class="qtip" alt="Mostrar todas" src="'.base_url().'assets/images/all.png" />','href'=>site_url('maestro/bodegas/todos'))

              );

        $this->run('bodegas_view',$data,'Listado de bodegas', $menu, null,null,'bodegas.js');


    }
    function guardar()
    {   
        $bodegas = $this->input->post('bodegas');
        $bodegas['bode_comp_id']=  $this->session->userdata('compania_id');
          /**
           * se verifica si el codigo existe
           */
        $result = $this->bodegas_model->buscar('bodegas', Array('bode_codigo'=>$bodegas['bode_codigo']));

          if(!$result){
             
                  $result=$this->bodegas_model->insertar_tablas('bodegas', $bodegas);
                  if($result){
                      $bodegas['bode_id']=$result;
                      $this->ajax_result(true,"Bodega agregada correctamente",$bodegas);
                  }else{$this->ajax_result(true,"No hubo cambios!");}
           }else{ $this->ajax_result(false,"El codigo de bodega ya existe!"); }
    }
    function editar()
    {
        $id_bodega = $this->input->post('id_editar_bodega');
        $bodegas = $this->input->post('bodegas');
        $codigo_recibido=$bodegas['bode_codigo'];

        $codigo_actual=  $this->bodegas_model->buscar('bodegas', array('bode_id'=>$id_bodega));
        $codigo_actual= $codigo_actual->row();
        $codigo_actual= $codigo_actual->bode_codigo;

          if($codigo_recibido==$codigo_actual){

              $result = $this->bodegas_model->modificar_tablas('bodegas', 'bode_id',$bodegas, $id_bodega);

              if($result){
                  $bodegas['bode_id']=$result;
                  $this->ajax_result(true, "Bodega modificada correctamente",$bodegas);
              }else{$this->ajax_result(false, "No hubo cambios!");}

          }else if($codigo_recibido != $codigo_actual ){
               $result=  $this->bodegas_model->buscar('bodegas', array('bode_codigo'=>$codigo_recibido));

               if($result){
                       $this->ajax_result(false, "El codigo de la bodega ya existe!");
               }else{
                   $result = $this->bodegas_model->modificar_tablas('bodegas', 'bode_id',$bodegas, $id_bodega);

                   if($result){
                       $bodegas['bode_id']=$result;
                       $this->ajax_result(true, "Bodega modificada correctamente",$bodegas);
                   }else{$this->ajax_result(false, "No hubo cambios!");}
               }
          }

    }
    function todos()
    {
        $this->session->unset_userdata('bodega_filtro');
        redirect('maestro/bodegas/index');
    }

}