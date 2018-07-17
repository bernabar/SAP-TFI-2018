<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>css/estilos.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>css/960.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>css/text.css" media="screen" />
        <link rel="stylesheet" type="text/css" href="<?= base_url() ?>css/reset.css" media="screen" />
        <title><?= $title ?></title>
    </head>
    <body>
        <!--cpntenedor principal-->
        <div class="container_12" id="contenedor">
            <!--contenedor de los artículos-->
            <ul class="grid_7" id="subcontenedor">
                <?php
                $agregado = $this->session->flashdata('agregado');
                $destruido = $this->session->flashdata('destruido');
                $productoEliminado = $this->session->flashdata('productoEliminado');
                if ($agregado) {
                    ?>
                    <li class="grid_6" id="productoAgregado"><?= $agregado ?></li>
                    <?php
                }elseif($destruido)
                {
                    ?>
                    <li class="grid_6" id="productoAgregado"><?= $destruido ?></li>
                    <?php
                }elseif($productoEliminado)
                {
                    ?>
                    <li class="grid_6" id="productoAgregado"><?= $productoEliminado ?></li>
                    <?php
                }
                ?>
                <?php
                //sacamos todos los productos del array productos
                foreach ($productos as $producto) {
                    ?>
                    <li id="individual">
                        <?php
                        //si existen opciones en el producto las separamos con explode
                        //cada vez que haya una coma, sino no hacemos nada
                        if ($producto->opciones) {
                            $producto->opciones = explode(',', $producto->opciones);
                        }
                        //para cada producto creamos un formulario que apuntará a la función
                        //agregarProducto del controlador catalogo para insertarlo en la cesta
                        ?>
                        <?= form_open(base_url() . 'index.php/carrito/agregarProducto') ?>
                        <div id="nombre">
                            <?= ucfirst($producto->name) ?>
                        </div>
                        <!--mostramos las imagenes de los productos-->
                        <div id="imagen">
                            <img src="http://localhost/meditorial/images/<?= $producto->name ?>" width="120" height="110" />
                        </div>
                        <!------------------------------------------->
                        <div id="precio">
                            <?= $producto->precio ?>
                        </div>
                        <div id="opciones">
                            <?php
                            if ($producto->opcion) {
                                echo form_label(ucfirst($producto->opcion), 'opcion_' . $producto->id);
                                echo form_dropdown(
                                        $producto->opcion, $producto->opciones, NULL, 'id="opcion_' . $producto->id . '"'
                                );
                            }
                            ?>
                        </div>
                        <?= form_hidden('uri', $this->uri->segment(3)) ?>
                        <?= form_hidden('id', $producto->item_id) ?>
                        <?= form_submit('action', 'Agregar al carrito') ?>
                        <?= form_close() ?>
                        <?php
                    }
                    ?>
                </li>
            </ul>

            <!--fin del contenedor de los articulos-->

            <!--mostramos el contenido de nuestro carrito-->
            <?php
            //si el carrito contiene productos los mostramos
            if ($carrito = $this->cart->contents()) {
                ?>
                <div class="grid_5" id="contenidoCarrito">
                    <table>
                       <legend>Carrito de la compra</legend>
                        <tr>
                            <th>Nombre</th>
                            <th>Opción</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th>Eliminar</th>
                        </tr>
                    <?php
                    foreach ($carrito as $item) {
                        ?>
                        <tr>
                            <td><?= ucfirst($item['name']) ?></td>
                            <td>
                                <?php
                                $nombres = array('nombre' => ucfirst($item['name']));

                                $precio = $item['unit_price'];
                                if ($this->cart->has_options($item['rowid'])) {
                                    foreach ($this->cart->product_options($item['rowid']) as $opcion => $value) {
                                        echo $opcion . ": <em>" . $value . "</em>";
                                    }
                                }
                                ?>
                            </td>
                            <td><?= $item['price'] ?></td>
                            <td><?= $item['qty'] ?></td>
                            <td id="eliminar"><?= anchor('carrito/eliminarProducto/' . $item['rowid'], 'Eliminar') ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                    <tr id="total">
                        <td><strong>Total:</strong></td>
                        <td colspan="1"><?= $this->cart->total() ?> pesos.</td>
                        <td colspan="4" id="eliminarCarrito"><?= anchor('carrito/eliminarCarrito', 'Vaciar carrito')?></td>
                    </tr>
                    <tr id="confirmar">
                        <td><strong>Confirmar:</strong></td>
                       <td colspan="4" id="checkout"><?= anchor('carrito/checkout', 'Confirmar carrito')?></td>
                    </tr>                    
                </table>
                </div>
            <?php
            }
            ?>
            <!--fin de nuestro carrito-->
            <!--creamos los enlaces de la paginación-->
            <div class="grid_7">
                <?= $this->pagination->create_links() ?>
            </div>
        </div>
        <div class="volver_desde_carrito">
           Volver: <a href="http://localhost/meditorial">Sistema e-Book</a> 
        </div>   
        <?php $this->load->view("partial/footer"); ?>        
        <!--fin del contenedor principal-->
    </body>
</html>
