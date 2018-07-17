<?php
class carrito extends CI_controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Products_Model');
	}

    public function index(){
		$data['datos']=$this->Products_Model->get_products();
		$data['title']='Reserva tus articulos'; 
		$data['controller_name']=strtolower(get_class());
		$this->load->view('carrito/manage',$data);

    }	
}
?>
