<h3>Search Orders</h3>
<?php 
    echo form_open('orders/search_order');
    
    echo form_label('Order_ID: ', 'search_order_id');
    echo form_input('search_order_id');
    echo form_label('DNI: ', 'search_dni');
    echo form_input('search_dni');
    echo form_submit('search_btn','Buscar');
    
    echo form_close();
    
    if ($error) echo '<h4 style="color:red;">*Complete por lo menos un campo</h4>';
    else echo '<h4>*Complete por lo menos un campo</h4>';
    
    if(!empty($db_orders))
    {   
        $this->table->set_heading('ID','Img', 'Titulo', 'Precio', 'Detalle');
        foreach($db_orders as $order)
        {
            $orderID = $order['order_id'];
            $thumbnail = img($order['meli_item_thumbnail_url']);
            $itemTitle = $order['meli_item_title'];
            $price = $order['meli_item_price'];
            $detalle = anchor('./items/view/'.$order['meli_item_id'],'Ver Detalle');
            
            $this->table->add_row($orderID,$thumbnail,$itemTitle,$price,$detalle);
        }
        echo $this->table->generate(); 
    }
    
    
?>