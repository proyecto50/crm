<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of inicio
 *
 * @author erick
 */
class inicio extends MY_Controller{
    function __construct() {
        parent::__construct();
        $this->load->model('inventario_model');
        $this->load->model('paginador_model');
        $this->load->library('pagination');
        $this->load->plugin('to_excel_pi');
    }

    function index(){
      $filtro = $this->input->post('inventarios');

      $filtros_inventarios = $this->paginador_model->filtro($filtro,'inventarios_filtro');
     /**
      * configuracion de paginacion
      */
      $data['inventarios'] = $this->inventario_model->get_inventario($filtros_inventarios);

      $total_rows= (($data['inventarios']==false))? 0 : $data['inventarios']->num_rows();
      $base_url =  site_url('inventario/inicio/index');
      $config = $this->paginador_model->paginar( $total_rows,$base_url);
      $perpage = $this->paginador_model->get_perpage();
      $this->pagination->initialize($config);
     /**
      * fin paginacion.
      */
      $data['per_page'] = $perpage;

      $data['inventarios'] = $this->inventario_model->get_inventario($filtros_inventarios,$perpage,$this->uri->segment(4));

      $data0['bodegas']=  $this->inventario_model->buscar('bodegas');
      
      $data['vista_nuevo_inventario']= $this->load->view('nuevo_inventario_view', $data0, true);
      $data['vista_editar_inventario']= $this->load->view('editar_inventario_view', $data0, true);
      $data['vista_buscar_inventario']= $this->load->view('buscar_inventario_view', null, true);
     
      $menu= array (array('callback' =>'nuevo_producto();return false;','val' => '<img class="qtip" alt="Nuevo producto"  src="'.base_url().'assets/images/add-files.png" />'),
                    array('callback' => 'buscar_producto();return false;','val' => '<img class="qtip" alt="Buscar Inventario" src="'.base_url().'assets/images/search.png" />'),
                    array('val' => '<img class="qtip" alt="Mostrar todos" src="'.base_url().'assets/images/all.png" />','href'=>site_url('inventario/inicio/todos')),
                    array('val' => '<img class="qtip" alt="Exportar inventario" src="'.base_url().'assets/images/xls1.png" />','title' => '','href'=>site_url('inventario/inicio/exportar')),
                    array('callback' =>'imprimir_todas();return false;','val' => '<img class="qtip" alt="Imprimir inventario" src="'.base_url().'assets/images/print-24.png" />','title' => '')
                          
             );

     $this->run('inventarios_view',$data,'Listado de productos en inventario', $menu, null,null,'inventario.js');
    }

    function guardar(){
     $result=0;
     $producto = $this->input->post('inventarios');
     $producto['inve_fecha'] = date("Y-m-d h:i:s");
      /**
           * se verifica si el codigo del producto existe en inventario
      */
     $result = $this->inventario_model->buscar('inventarios', Array('inve_codigo'=>$producto['inve_codigo']));
     if(!$result){
          $result=$this->inventario_model->insertar_tablas('inventarios', $producto);
          if($result){
             $producto['inve_id']=$result;
             $result=$this->inventario_model->get_producto(array('inve_id'=>$result));
             $result=$result->row();
             $producto['bode_nombre']=$result->bode_nombre;
             $producto['inve_tipo']=$result->inve_tipo;
             $this->ajax_result(true,"Producto agregado correctamante",$producto);
          }else{ $this->ajax_result(false,"No se pudo agregar el producto");}
      }else{
               $this->ajax_result(false,"El codigo del producto ya existe!");
              }
         
    }
    
    function editar(){
      $id_producto = $this->input->post('id_editar_producto');
      $bode_name = $this->input->post('bode_nombre');
      $inventarios = $this->input->post('inventarios');
      $codigo_recibido=$inventarios['inve_codigo'];
      
      $codigo_actual=  $this->inventario_model->buscar('inventarios', array('inve_id'=>$id_producto));
      $codigo_actual= $codigo_actual->row();
      $inventarios['inve_fecha']=$codigo_actual->inve_fecha;
      $codigo_actual= $codigo_actual->inve_codigo;
           
      if($codigo_recibido==$codigo_actual){
         $result = $this->inventario_model->modificar_tablas('inventarios', 'inve_id',$inventarios, $id_producto);
         if($result){
            $inventarios['inve_id']=$result;
            $inventarios['bode_nombre']=$bode_name;
            $this->ajax_result(true, "Producto modificado correctamente",$inventarios);
          }else{$this->ajax_result(false, "El Producto no fue editado");}

        }else if($codigo_recibido != $codigo_actual ){
                 $result=  $this->inventario_model->buscar('inventarios', array('inve_codigo'=>$codigo_recibido));
                 if($result){
                    $this->ajax_result(false, "El codigo del producto ya existe!");
                  }else{
                    $result = $this->inventario_model->modificar_tablas('inventarios', 'inve_id',$inventarios, $id_producto);
                    if($result){
                       $inventarios['inve_id']=$result;
                       $inventarios['bode_nombre']=$bode_name;
                       $this->ajax_result(true, "Producto modificado correctamente",$inventarios);
                     }else{$this->ajax_result(false, "El producto no fue editado");}
                   }
           }
    }

    function todos(){
      $this->session->unset_userdata('inventarios_filtro');
      redirect('inventario/inicio/index');
    }
   
    function eliminar(){
     $result=0;
     $this->load->model('inventario_model');   
     $id = $this->input->post('id');   
        
     $result=$this->inventario_model->eliminar('inventarios','inve_id',$id);
     if($result){
     $this->ajax_result(true,"Producto eliminado correctamente!");
     }else{
          $this->ajax_result(false,"El producto no fue eliminado");
     }
    }
     
    function exportar(){
     $filtros_inventarios =   $this->session->userdata('inventarios_filtro');  
     $data['inventarios'] = $this->inventario_model->get_inventario($filtros_inventarios);
     $data['filtro'] = $filtros_inventarios ;     
     
     $this->load->view('exportar_inventario_view',$data);   
    } 
    
    function imprimir_todas(){
      $filtros_inventario =   $this->session->userdata('inventarios_filtro');  
      $data['inventarios'] = $this->inventario_model->get_inventario($filtros_inventario);
      $data['filtro'] = $filtros_inventario ;     
      $this->imprimir('imprimir_inventario_view',$data);
     }
    
   

}
