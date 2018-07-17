<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8" />
    	<title><?php echo $title;  ?></title>
	</head>   
	<body>
    	<h1 align="center">Registros de la Bd con Codeigniter</h1>
		<h3 align="center">
			<form action="<?php echo base_url(); ?>carrito/agregar_carrito" method="post">
                <div class="grid_5" id="contenidoCarrito">
                    <table>
                       <legend>Seleccion de productos</legend>
                        <tr>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>Descripcion</th>
                            <th>Precio</th>
                            <th>Cantidad</th>
                            <th></th>
                        </tr>
                    <?php
                    $a = $data['datos'];
                    foreach ($item as $a) {
                        ?>
                        <tr>
                            <td><?= ucfirst($item['name']) ?></td>
                            <td>
                                <?php
                                $nombres = array('nombre' => ucfirst($item['name']));

                                $precio = $item['price'];
                                if ($this->cart->has_options($item['rowid'])) {
                                    foreach ($this->cart->product_options($item['rowid']) as $opcion => $value) {
                                        echo $opcion . ": <em>" . $value . "</em>";
                                    }
                                }
                                ?>
                            </td>
                            <td><?= $item['price'] ?></td>
                            <td><?= $item['qty'] ?></td>
                            <td id="eliminar"><?= anchor('../catalogo/eliminarProducto/' . $item['rowid'], 'Eliminar') ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                    <tr id="total">
                        <td><strong>Total:</strong></td>
                        <td colspan="1"><?= $this->cart->total() ?> euros.</td>
                        <td colspan="4" id="eliminarCarrito"><?= anchor('../catalogo/eliminarCarrito', 'Vaciar carrito')?></td>
                    </tr>
                </table>
                </div>
 		</h3>
	</body>
</html>
