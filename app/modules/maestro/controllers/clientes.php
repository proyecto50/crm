<?php

class clientes extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
                $this->load->model('clientes_model');
                $this->load->model('paginador_model');
                $this->load->library('pagination');
                
	}

	public function index(){
        $filtro_cliente = $this->input->post('clientes');

        $filtros_cliente = $this->paginador_model->filtro($filtro_cliente,'cliente_filtro');
        /**
         * configuracion de paginacion
         */
        $data['clientes'] = $this->clientes_model->get_clientes($filtros_cliente);
      
        $total_rows= (($data['clientes']==false))? 0 : $data['clientes']->num_rows();
        $base_url =  site_url('maestro/clientes/index');
        $config = $this->paginador_model->paginar( $total_rows,$base_url);
        $perpage = $this->paginador_model->get_perpage();
        $this->pagination->initialize($config);
        /**
        * fin paginacion.
        */
    
        $data['per_page'] = $perpage;

        $data['clientes'] = $this->clientes_model->get_clientes($filtros_cliente,$perpage,$this->uri->segment(4));
    
        $data['vista_nuevo_cliente'] = $this->load->view('nuevo_cliente_view',null,true);
        $data['vista_editar_cliente'] = $this->load->view('editar_cliente_view',null,true);
        $data['vista_buscar_cliente'] = $this->load->view('buscar_cliente_view',null,true);

        $menu = array ( array('callback' =>'nuevo_cliente();return false;','val' => '<img class="qtip" alt="Nuevo Cliente"  src="'.base_url().'assets/images/add-files.png" />'),
                        array('callback' =>'buscar_cliente();return false;','val' => '<img class="qtip" alt="Buscar Cliente" src="'.base_url().'assets/images/search.png" />'),
                        array('val' => '<img class="qtip" alt="Mostrar Todos" src="'.base_url().'assets/images/all.png" />','href' => site_url('maestro/clientes/todos')),
                        array('val' => '<img class="qtip" alt="Exportar clientes" src="'.base_url().'assets/images/xls1.png" />','title' => '','href'=>site_url('maestro/clientes/exportar')),
                        array('callback' =>'imprimir_todas();return false;','val' => '<img class="qtip" alt="Imprimir clientes" src="'.base_url().'assets/images/print-24.png" />','title' => '')
                 
                      );

        $this->run('clientes_view',$data,'Listado de clientes', $menu, null,null,'cliente.js');

       }

       function guardar(){
       $result=0;
       $clientes = $this->input->post('clientes');
       $clientes['clie_fechacreacion'] = date("Y-m-d h:i:s");
         /**
           * se verifica si la cedula del cliente existe
            */
       $result = $this->clientes_model->buscar('clientes', Array('clie_cedula'=>$clientes['clie_cedula'],'clie_sucursal'=>$clientes['clie_sucursal']));
       if(!$result){
           $result=$this->clientes_model->insertar_tablas('clientes', $clientes);
           if($result){
              $clientes['clie_id']=$result;
              $this->ajax_result(true,"Cliente agregado correctamente",$clientes);
            }else{ $this->ajax_result(false,"No se pudo guardar el cliente");}
        }else{
               $this->ajax_result(false,"Ya existe un cliente en esta sucursal!");
              }
         }
        
       function editar(){
       $result=null;
       $consulta=null;
       $id_cliente = $this->input->post('id_editar_cliente');
       $clientes = $this->input->post('clientes');
       $codigo_recibido=$clientes['clie_cedula'];
       $sucursal_recibida=$clientes['clie_sucursal'];

       $consulta=  $this->clientes_model->buscar('clientes', array('clie_id'=>$id_cliente));
       $consulta= $consulta->row();
       $clientes['clie_fechacreacion']=$consulta->clie_fechacreacion;
       $codigo_actual= $consulta->clie_cedula;
       $sucursal_actual=$consulta->clie_sucursal;
          
       if( ($codigo_recibido ) == ($codigo_actual ) ){
            if($sucursal_recibida!=$sucursal_actual){
               $result=$this->clientes_model->buscar('clientes', array('clie_cedula'=>$codigo_recibido,'clie_sucursal'=>$sucursal_recibida));
               if($result){
                  $this->ajax_result(false,"Esta cedula ya existe en esta sucursal!");
                }else{
                      $result = $this->clientes_model->modificar_tablas('clientes', 'clie_id',$clientes, $id_cliente);
                      if($result){
                         $clientes['clie_id']=$result;
                         $this->ajax_result(true,"Cliente modificado correctamente!",$clientes);
                       }else{ $this->ajax_result(false,"No hubo cambios!");}
                    }
              }else{
                    $result = $this->clientes_model->modificar_tablas('clientes', 'clie_id',$clientes, $id_cliente);
                    if($result){
                       $clientes['clie_id']=$result;
                       $this->ajax_result(true,"Cliente modificado correctamente!",$clientes);
                     }else{ $this->ajax_result(false,"El cliente no fue modificado!"); }
               }
         }else if($codigo_recibido != $codigo_actual ){
                 if($sucursal_recibida!=$sucursal_actual){
                    $result=$this->clientes_model->buscar('clientes', array('clie_cedula'=>$codigo_recibido,'clie_sucursal'=>$sucursal_recibida));
                    if($result){
                       $this->ajax_result(false,"Esta cedula ya existe en esta sucursal");
                    }else{
                          $result = $this->clientes_model->modificar_tablas('clientes', 'clie_id',$clientes, $id_cliente);
                          if($result){
                             $clientes['clie_id']=$result;
                             $this->ajax_result(true,"Cliente modificado correctamente!",$clientes);
                           }else{ $this->ajax_result(false,"El cliente no fue modificado!");}
                         }
                 }else{
                       $result = $this->clientes_model->modificar_tablas('clientes', 'clie_id',$clientes, $id_cliente);
                       if($result){
                          $clientes['clie_id']=$result;
                          $this->ajax_result(true,"Cliente modificado correctamente!",$clientes);
                        }else{ $this->ajax_result(false,"El cliente no fue modificado!"); }
                      }   
          }
       }//end function 

       function todos(){
       $this->session->unset_userdata('cliente_filtro');
       redirect('maestro/clientes/index');
       }
        
       function exportar(){
       $filtros_clientes =   $this->session->userdata('cliente_filtro');  
       $data['clientes'] = $this->clientes_model->get_clientes($filtros_clientes);
       $data['filtro'] = $filtros_clientes ;     
     
       $this->load->view('exportar_clientes_view',$data);   
       } 
     
       function exportar_cartera($id=null){
       $filtros_clientes =   $this->session->userdata('cliente_filtro');  
       $data['clientes']    = $this->clientes_model->get_clientes(Array('clie_id'=>$id));
       $data['clientes']=$data['clientes']->row();
       $data['detalle']    = $this->clientes_model->get_dcliente(Array('clie_id'=>$id));
       $data['filtro'] = $filtros_clientes ;     
       $this->load->view('exportar_cliente_estc_view',$data); 
       }
     
      function imprimir_todas(){
      $filtros_clientes =   $this->session->userdata('cliente_filtro');  
      $data['clientes'] = $this->clientes_model->get_clientes($filtros_clientes);
      $data['filtro'] = $filtros_clientes ;     
      $this->imprimir('imprimir_clientes_view',$data);
      }
      
      function imprimir_cartera($id){
      $filtros_clientes =   $this->session->userdata('cliente_filtro');  
      $data['detalle'] = $this->clientes_model->get_dcliente(Array('clie_id'=>$id));
      $data['clientes']    = $this->clientes_model->get_clientes(Array('clie_id'=>$id));
      $data['clientes']=$data['clientes']->row();
      $data['filtro'] = $filtros_clientes ;     
      $this->imprimir('imprimir_clientes_estc_view',$data);
      }
     
      function detalle($id=null){
      $data['clientes']    = $this->clientes_model->get_clientes(Array('clie_id'=>$id));
      $data['clientes']= $data['clientes']->row();
      $data['detalle']    = $this->clientes_model->get_dcliente(Array('clie_id'=>$id));
       
      $menu = array ( array('href'=>  site_url('maestro/clientes/index'),'val' => '<img class="qtip" alt="Volver"  src="'.base_url().'assets/images/left.png" />'),
                      array('val' => '<img class="qtip" alt="Exportar cartera" src="'.base_url().'assets/images/xls1.png" />','title' => '','href'=>site_url().'maestro/clientes/exportar_cartera/'.$id),
                      array('callback' =>'imprimir_cartera('.$id.');return false;','val' => '<img class="qtip" alt="Imprimir cartera" src="'.base_url().'assets/images/print-24.png" />','title' => '')
                     );
  
      $this->run('detalle_cliente_view',$data,'Detalle cartera', $menu, null,null,'cliente.js');
      }
               
      function mostrar_editar(){ 
      $clie_id = $this->input->post('clie_id');    
      $this->ajax_result(false,"llego!");
      return false;
      $data['cliente'] = $this->clientes_model->get_clientes(Array('clie_id'=>$clie_id));
      if($data['cliente']){
         $data['cliente']=$data['cliente']->row();
      }else{
         $data['cliente']=null;
     }
     $this->load->view('editar_cliente_view',$data);
     }   
              
     
}//end class