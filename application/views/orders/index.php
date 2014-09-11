<?php 

echo form_open('orders/search_meli'); 
echo form_label('Busqueda:', 'search_string');
echo form_input('search_string');
echo form_submit("search_btn", "Buscar");
echo form_close();
?>