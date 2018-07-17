<?php $this->load->view("partial/header"); ?>

<div id="title_bar">
	<div id="page_title"><?php echo $this->lang->line('common_list_of').' '.$this->lang->line('module_'.$controller_name); ?></div>
</div>

<div id="feedback_bar"></div>
<?php $this->load->view('carrito/catalogo_view',$data); ?>
<?php $this->load->view("partial/footer"); ?>
