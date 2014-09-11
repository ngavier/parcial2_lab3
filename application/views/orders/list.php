<?php

if (!empty($meli_items["body"]->results))
{
    echo form_open('orders/save'); 
    $tmpl = array (
                    'table_open'          => '<table border="0" cellpadding="4" cellspacing="0" align="center" width="75%">',

                    'heading_row_start'   => '<tr>',
                    'heading_row_end'     => '</tr>',
                    'heading_cell_start'  => '<th>',
                    'heading_cell_end'    => '</th>',

                    'row_start'           => '<tr>',
                    'row_end'             => '</tr>',
                    'cell_start'          => '<td>',
                    'cell_end'            => '</td>',

                    'row_alt_start'       => '<tr>',
                    'row_alt_end'         => '</tr>',
                    'cell_alt_start'      => '<td>',
                    'cell_alt_end'        => '</td>',

                    'table_close'         => '</table>'
              );
    $this->table->set_template($tmpl);
     $this->table->set_heading('','ID','Img', 'Titulo', 'Precio');

     foreach ($meli_items["body"]->results as $item)
     {
        $checkbox = form_checkbox("items[]", $item->id) ;
        $title = anchor($item->permalink, $item->title) ;
        $img = img($item->thumbnail);
        $id = $item->id;
        
        echo form_hidden('title_'.$item->id, $item->title);
        echo form_hidden('thumbnail_'.$item->id, $item->thumbnail);
        echo form_hidden('prices_'.$item->id, $item->price);
     
        $this->table->add_row($checkbox,$id,$img, $title, "$".$item->price); 
     }
     echo $this->table->generate(); 
     
     echo form_label("Numero de Pedido: ", 'num');
     echo form_input('num');
     echo form_label("DNI: ", 'dni');
     echo form_input('dni');
     echo form_label("Nombre: ", 'nombre');
     echo form_input('nombre');
     
     echo form_submit("guardar_btn", "Guardar!");
     echo form_close();
} ?>

