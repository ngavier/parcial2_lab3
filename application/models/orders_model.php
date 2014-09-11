<?php
class orders_model extends CI_Model{
    
    public function __construct() 
    {
        $this->load->database();
    }
    public function save($data)
    {
        if($this->db->insert('orders',$data)) return true;
        else return false;
    }
    public function search($order_id, $dni)
    {
        if (!$order_id && !$dni)return NULL;
        
        if ($order_id && $dni)
        {
            $this->db->where('order_id',$order_id);
            $this->db->where('DNI',$dni);
            $query = $this->db->get('orders');
            return $query->result_array();
        }
        if (!$order_id)
        {
            $this->db->where('DNI',$dni);
        }
        else
        {
            $this->db->where('order_id',$order_id);
        }
        $query = $this->db->get('orders');
        return $query->result_array();
        
        
        
        
    }
}