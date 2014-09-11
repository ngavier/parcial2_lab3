<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Orders extends CI_Controller 
{
        public function __construct() 
        {
            parent::__construct();
            $this->load->model('meli_items');
            $this->load->model('orders_model');
            $this->load->helper('form');
            $this->load->helper('html');
            $this->load->helper('url');
            $this->load->library('table');
            $this->load->library('form_validation');
        }
	public function index()
	{
            $dataTemp['title'] = "Buscador MELI";
            $this->load->view('templates/header', $dataTemp);
            $this->load->view('orders/index');
            $this->load->view('templates/footer');

	}
        public function search_meli()
        {
            $search_string = $this->input->post('search_string');
        
            if ($search_string != NULL)
            {
                $data["meli_items"] = $this->meli_items->search("MLA", $search_string);
            }
            $dataTemp['title'] = "Resultados MELI";
            $this->load->view('templates/header', $dataTemp);
            $this->load->view('orders/list', $data);
            $this->load->view('templates/footer');
        }
        public function save()
        {
            $this->form_validation->set_rules('num', 'num', 'required');
            $this->form_validation->set_rules('dni', 'dni', 'required');
            $this->form_validation->set_rules('nombre', 'nombre', 'required');
            if ($this->form_validation->run() === true)
            {
                $pedido = $this->input->post('num');
                $dni = $this->input->post('dni');
                $nombre = $this->input->post('nombre');
                $itemsID = $this->input->post('items');
                
                for ($i = 0;$i<count($itemsID);$i++)
                {
                    $thumbnails = $this->input->post('thumbnail_'.$itemsID[$i]);
                    $titles = $this->input->post('title_'.$itemsID[$i]);
                    //$permalinks = $this->input->post('permalink');
                    $precios = $this->input->post('prices_'.$itemsID[$i]);
                    $data = Array(
                        'order_id'=>$pedido,
                        'DNI'=>$dni,
                        'name'=>$nombre,
                        'meli_item_id'=>$itemsID[$i],
                        'meli_item_title'=> $titles,
                        'meli_item_price'=>$precios,
                        'meli_item_thumbnail_url'=> $thumbnails                    
                        );
                    
                    $dataTemp['title'] = '[Pedidos Guardados] <br /> Buscador MELI ';
                    $this->orders_model->save($data);
                    
                }
            }
            else
            {
                $dataTemp['title'] = 'Pedidos No Guardados - Ocurrio un error';
            }
            
            $this->load->view('templates/header',$dataTemp);
            $this->load->view('orders/index');
            $this->load->view('templates/footer');
                
        }
        
        public function search_order()
        {
            $busqueda = false;
            $orderID = '';
            $dni = '';
            if ($this->input->post('search_btn'))
            {
                $busqueda = true;
                $orderID = $this->input->post('search_order_id');
                $dni = $this->input->post('search_dni');
            }
            $data['db_orders'] = '';
            $data['error'] = FALSE;
            if ($busqueda)
            {
                if($orderID && $dni)
                {
                    $data['db_orders'] = $this->orders_model->search($orderID,$dni);
                }
                else
                {
                    if(!$dni && $orderID)
                    {
                        $data['db_orders'] = $this->orders_model->search($orderID,NULL);
                    }
                    if(!$orderID && $dni)
                    {
                        $data['db_orders'] = $this->orders_model->search(NULL,$dni);
                    }
                    if(!$orderID && !$dni)
                    {
                        $data['db_orders'] = '';
                        $data['error'] = true;
                    }
                }
            }
            
            $dataTemp['title'] = 'Busqueda de Orders DB';
            $this->load->view('templates/header',$dataTemp);
            $this->load->view('orders/search_orders',$data);
            $this->load->view('templates/footer');
        }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */