<?php

class estado_cuenta extends MY_Controller
{
   public function __construct()
   {
		parent::__construct();
                $this->load->model('estado_cuenta_model');
                $this->load->model('paginador_model');
                $this->load->library('pagination');
                
   }

   public function index()
   {

   $filtro_estado_cuenta = $this->input->post('estados_cuenta');
   $filtros_estado_cuenta = $this->paginador_model->filtro($filtro_estado_cuenta,'estado_cuenta_filtro');
    /**
     * configuracion de paginacion
     */
   $data['estado_cuentas'] = $this->estado_cuenta_model->get_estado_cuenta($filtros_estado_cuenta);
   $total_rows= (($data['estado_cuentas']==false))? 0 : $data['estado_cuentas']->num_rows();
   $base_url =  site_url('maestro/estado_cuenta/index');
   $config = $this->paginador_model->paginar( $total_rows,$base_url);
   $perpage = $this->paginador_model->get_perpage();
   $this->pagination->initialize($config);
    /**
    * fin paginacion.
    */
   $data['per_page'] = $perpage;
   $data['estado_cuentas'] = $this->estado_cuenta_model->get_estado_cuenta($filtros_estado_cuenta,$perpage,$this->uri->segment(4));
   $data['vista_nuevo_estado_cuenta'] = $this->load->view('nuevo_estado_cuenta_view',null,true);
   $data['vista_editar_estado_cuenta'] = $this->load->view('editar_estado_cuenta_view',null,true);
   $data['vista_buscar_estado_cuenta'] = $this->load->view('buscar_estado_cuenta_view',null,true);

   $menu = array ( array('callback' =>'nuevo_estado_cuenta();return false;','val' => '<img class="qtip" alt="Nuevo estado cuenta"  src="'.base_url().'assets/images/add-files.png" />'),
                    array('callback' =>'buscar_estc();return false;','val' => '<img class="qtip" alt="Buscar estado cuenta" src="'.base_url().'assets/images/search.png" />'),
                    array('val' => '<img class="qtip" alt="Mostrar Todos" src="'.base_url().'assets/images/all.png" />','href' => site_url('maestro/estado_cuenta/todos')),
                   );

   $this->run('estado_cuenta_view',$data,'Listado cartera', $menu, null,null,'estado_cuenta.js');
 }

  function guardar()
  {
   $result=null;
   $insertar=null;
   $estado_cuentas = $this->input->post('estados_cuenta');
   $estado_cuentas['estc_fechasistema'] = date("Y-m-d h:i:s");
   $estado_cuentas['estc_usua_id'] = $this->session->userdata('usuario_id');  
   
     /**
       * se verifica si la cedula del estado_cuenta existe
        */
   
   $insertar=$this->estado_cuenta_model->insertar_tablas('estado_cuenta', $estado_cuentas);
   if($insertar){
      $result=$this->estado_cuenta_model->buscar('clientes',Array('clie_cedula'=>$estado_cuentas['estc_clie_cedula']));
      if($result){
         $estado_cuentas['clie_cliente']=$result=$result->row()->clie_cliente;
        }else{$estado_cuentas['clie_cliente']='';}
       $estado_cuentas['estc_id']=$insertar;
       $this->ajax_result(true,"Estado de cuenta agregado correctamente",$estado_cuentas);
    }else{ $this->ajax_result(true,"No se pudo agregar el estado de cuenta");}
             
   }
        
 function editar(){
 $insertar=null;
 $id_estado_cuenta = $this->input->post('id_editar_estc');
 $estado_cuentas = $this->input->post('estados_cuenta');
   
 $insertar = $this->estado_cuenta_model->modificar_tablas('estado_cuenta', 'estc_id',$estado_cuentas, $id_estado_cuenta);
 if($insertar){
    $result=$this->estado_cuenta_model->buscar('estado_cuenta',Array('estc_clie_cedula'=>$estado_cuentas['estc_clie_cedula']));
    $estado_cuentas['estc_fechasistema']=$result=$result->row()->estc_fechasistema;
    $result=$this->estado_cuenta_model->buscar('clientes',Array('clie_cedula'=>$estado_cuentas['estc_clie_cedula']));
    if($result){
       $estado_cuentas['clie_cliente']=$result=$result->row()->clie_cliente;
     }else{$estado_cuentas['clie_cliente']='';}
           $estado_cuentas['estc_id']=$insertar;
           $this->ajax_result(true, "Estado de cuenta modificado correctamente",$estado_cuentas);
       }else{$this->ajax_result(false, "No hubo cambios!");}
 }

 function todos(){
 $this->session->unset_userdata('estado_cuenta_filtro');
 redirect('maestro/estado_cuenta/index');
 }

 function exportar()
 {
 $filtros_estado_cuentas =   $this->session->userdata('estado_cuenta_filtro');  
 $data['estado_cuentas'] = $this->estado_cuenta_model->get_estado_cuenta($filtros_estado_cuentas);
 $data['filtro'] = $filtros_estado_cuentas ;     

 $this->load->view('exportar_estado_cuentas_view',$data);   
 }

 function imprimir_todas()
 {
  $filtros_estado_cuentas =   $this->session->userdata('estado_cuenta_filtro');  
  $data['estado_cuentas'] = $this->estado_cuenta_model->get_estado_cuenta($filtros_estado_cuentas);
  $data['filtro'] = $filtros_estado_cuentas ;     
  $this->imprimir('imprimir_estado_cuentas_view',$data);
 }
 function eliminar()
 {
  $result=0;
  $this->load->model('estado_cuenta_model');   
  $id = $this->input->post('id');   
  
  $result=$this->estado_cuenta_model->eliminar('estado_cuenta','estc_id',$id);
  if($result){
     $this->ajax_result(true,"Estado de cuenta eliminado correctamente!");
     }else{
           $this->ajax_result(false,"El estado de cuenta no fue eliminado");
     }
   }             
 }