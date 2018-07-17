<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active"></li>
			</ol>
		</div><!--/.row-->

		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading"><?=heading($title, 2);?> </div>
					<div class="panel-body"> 

<?php   if($message){echo $message;} 
if ($cart = $this->cart->contents()):   ?>       
<div id="cart">
<table data-toggle="table"   data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
<tr>
  <th>Portatil</th><th>Detalle</th><th>Cantidad</th><th colspan="3">Sub-Total</th>
</tr>
        <?php foreach($cart as $item): ?>
            <tr>
                <td><?=$item['name']; ?></td>
                <td>
                    <?php if ($this->cart->has_options($item['rowid'])) {
                        foreach ($this->cart->product_options($item['rowid']) as $option => $value) {
                            echo $option . ": <em>" . $value . "</em>";
                        }
                       
                    } ?>
                </td>
                <td><?=$item['qty']; ?></td>
                <td>$<?=$this->cart->format_number($item['subtotal'])?></td>
                    <td class="add">
                    <?php 
                      $row = $item['rowid']."-".($item['qty']+1);
                    echo anchor('index.php/carrito/products/update_cart/'.$row,'+'); ?>
                </td>
                <td class="remove">
                    <?=anchor('index.php/carrito/products/remove/'.$item['rowid'],'X');?>
                </td>
                 
    </tr>
           
        <?php endforeach; ?>
        <tr>
            <td colspan="2" ><strong>Total</strong></td>
            <td colspan="1"><strong><?=$this->cart->total_items()?></strong></td>
            <td colspan="5"><strong>$<?=$this->cart->format_number($this->cart->total());?></strong></td>
               
        </tr>
        <tr>
            <td colspan="2" class="pedido"><?=anchor('index.php/carrito/products/checkout/','Comprar Pedido'); ?></td>
            <td class="remove" colspan="4"><?=anchor('index.php/carrito/products/delete/','Vaciar Carrito'); ?></td>           
        </tr>
   
        </table>       
    </div>
       
    <?php endif; ?>
<?=br(1).anchor('index.php/carrito/products','Regresar'); ?> 
</div>
				</div>
			</div>
		</div><!--/.row-->
		


	</div>	<!--/.main--> 
