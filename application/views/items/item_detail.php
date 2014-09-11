<div style="float:left;">
<?php

echo '<h2>'.$detalles["body"]->title.'</h2>';
echo '<p>ID: '.$detalles["body"]->id.'</p>';
echo '<p>Precio: $'.$detalles["body"]->price.'('.$detalles["body"]->currency_id.')</p>';
echo '<p>Métodos de Pago: ';
$payment_methods = $detalles["body"]->non_mercado_pago_payment_methods;
foreach ($payment_methods as $method)
{
    echo $method->description;
    echo ', ';
}
if ($detalles["body"]->accepts_mercadopago)
{
    echo ' MercadoPago';
}
echo '</p>';
?>
</div>
<div style="float: left; width: 50%;">
    <div class="imagenes" style="text-align:center;"> <h3>Imagenes</h3>
<div id="sliderFrame">
        <div id="slider">
            <!--<img src="images/image-slider-1.jpg" alt="Welcome to Menucool.com" />
            <img src="images/image-slider-2.jpg" alt="" />
            <img src="images/image-slider-3.jpg" alt="Pure Javascript. No jQuery. No flash." />
            <img src="images/image-slider-4.jpg" alt="#htmlcaption" />
            <img src="images/image-slider-5.jpg" /> -->
        
<?php $pics = $detalles["body"]->pictures;
foreach ($pics as $pic)
{
    $image_properties = array(
          'src' => $pic->url,
          'width' => '500',
          'height' => '306',
          'title' => $detalles["body"]->title ,
          'alt' => $detalles["body"]->title,
    );
    //echo img($pic->url);
    echo img($image_properties);
} ?>
    </div>
</div>
</div>
</div>
<div class="clearfix"></div>
<?php //echo br();
/*foreach ($pics as $pic)
{
    $image_properties = array(
          'src' => 'images/picture.jpg',
          'width' => '500',
          'height' => '306',
          'title' => $detalles["body"]->title ,
          'alt' => $detalles["body"]->title,
    );
    echo img($pic->url);
}*/
if($descripcion["body"]->plain_text)
{
    echo '<h3>Descripción del Producto:</h3> ';
    echo br();
    echo $descripcion["body"]->plain_text;
}
echo br();
if($descripcion["body"]->text)
{
    echo '<h3>Descripción: </h3>';
    echo $descripcion["body"]->text;
}

    
    
?>