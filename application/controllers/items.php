<?php
class Items extends CI_Controller
{
    public function __construct() 
    {
        parent::__construct();
        $this->load->model('meli_items');
        $this->load->helper('form');
        $this->load->helper('html');
        $this->load->helper('url');
    }
    function view($item_id)
    {
        $data['detalles'] = $this->meli_items->view($item_id,'detalles');
        $data['descripcion'] = $this->meli_items->view($item_id,'descripcion');
        
        $dataTemp['title'] = 'Detalle Item';
        
        $this->load->view('templates/header',$dataTemp);
        $this->load->view('items/item_detail', $data);
        $this->load->view('templates/footer');
        
        
        
        
    }
};


