<?php
class meli_items extends CI_Model{
    
    function get_sites()
    {
        $this->load->library('Meli');
        
        return $this->meli->get("/sites/");
    }
    
    function search($site_id, $search_string)
    {
        $this->load->library('Meli');
        $params = array('q' => $search_string);
        
        $params["q"] = urlencode($search_string);
        
        return $this->meli->get("/sites/".$site_id."/search", $params);
    }
    
    function view($item_id,$mode)
    {
        $this->load->library('Meli');
        switch ($mode) {
            case 'detalles':
                return $this->meli->get("/items/".$item_id);
            case 'descripcion':
                return $this->meli->get("/items/".$item_id.'/description');
            default:
                break;
        }
        return NULL;
    }
}
