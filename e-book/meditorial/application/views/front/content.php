<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active"></li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Arma tu pedido On-line</h1>
			</div>
		</div><!--/.row-->
		
		<!--div class="row">
			<div class="col-xs-12 col-md-6 col-lg-3">
				<div class="panel panel-blue panel-widget ">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<svg class="glyph stroked bag"><use xlink:href="#stroked-bag"></use></svg>
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large">120</div>
							<div class="text-muted">New Orders</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-md-6 col-lg-3">
				<div class="panel panel-orange panel-widget">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<svg class="glyph stroked empty-message"><use xlink:href="#stroked-empty-message"></use></svg>
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large">52</div>
							<div class="text-muted">Comments</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-md-6 col-lg-3">
				<div class="panel panel-teal panel-widget">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg>
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large">24</div>
							<div class="text-muted">New Users</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-md-6 col-lg-3">
				<div class="panel panel-red panel-widget">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<svg class="glyph stroked app-window-with-content"><use xlink:href="#stroked-app-window-with-content"></use></svg>
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large">25.2k</div>
							<div class="text-muted">Page Views</div>
						</div>
					</div>
				</div>
			</div>
		</div--><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading"><?=heading($title, 2);?> </div>
					<div class="panel-body"> 

					<table class="table"   >
						    <thead>
						    <tr>
							    <th>nombre</th>
						        <th>imagen</th>
						        <th>categoria</th>
								 <th>precio</th>
						        <th>descripción</th>
								 <th></th>
						       							  
						    </tr>
						    </thead>
						 <tbody>
<?php foreach($results as $result): ?>
   <?=form_open('/carrito/products/add'); ?>
   <tr> 
  <td><?php   echo $result->name." "; ?></td>      
  <td><img src="<?=base_url().'images/'.$result->name.'.jpg'; ?>" width="100" height="100"></td>
  
 <td><div class="category"><?=$result->category;?></div></td>              
  <td><div class="price"><?='Precio: '.'$'.$result->unit_price;?></div></td>
       <td> 
	   <div >     
                  <?php if($result->description):?>                
                    <?=form_label($result->description);?>
                    <?php endif; ?>             
		</div>
       </td> 
       <td>			 
            <?=form_hidden('id', $result->id); ?>
            <?=form_hidden('segment', $this->uri->segment(3));?>
            <?=form_submit('action', 'Comprar'); ?>
      
	  </td>       
  </tr>
   <?=form_close(); ?>	
  <?php endforeach; ?> 
   </tbody>		 
		</table>
					
					</div>
				</div>
			</div>
		</div><!--/.row-->
		


	</div>	<!--/.main-->
