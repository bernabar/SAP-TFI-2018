<article class="header">
	<? echo anchor('product_view','Volver al listado');?>
    <hr> 
	<form action="<? echo base_url();?>productos/actualizar_carrito" method="post"> 
		<table class="carrito"> 
			<tr>
				<th>Nombre del producto</th>
				<th>Precio</th>
				<th>Cantidad</th>
				<th>Subtotal</th>
			</tr>
			<?
			$i = 1;
			foreach ($this->cart->contents() as $item);
				?>
				<input type="hidden" name="<? echo $i;?>[rowid]" value="<? echo $item['rowid']; ?>">
				<tr>
					<td>
						<?
						echo $item['name'];
						?>
					</td>
					<td>Pesos <? echo number_format($item['price'],2,',','.'); ?></td>
					<td>
						<input type="text" name="<? echo $i;?>[qty]" value="<? echo $item['qty']; ?>" maxlength="3" size="5">
					</td>
					<td>Pesos <? echo number_format($item['subtotal'],2,',','.'); ?></td>
				</tr>
			    <?
			    endforeach;
			    $i++;
			    ?>
	<tr>
		<td colspan="2">
			<input type="submit" name="actualizar" value="Actualizar Carrito">
			<? echo anchor('products_view/vaciar_carrito', 'Vaciar Carrito'); ?>
		</td>
		<td>Total:</td>
		<td>Pesos <? echo number_format($this->cart-total(),2,',','.'); ?></td>
	</tr>
</table>
</form>
</article>
