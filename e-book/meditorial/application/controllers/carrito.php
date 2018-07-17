<?php
class Carrito extends CI_Controller
{
    function __construct() {
        parent::__construct();
        $this->load->model('catalogo_model');
    }
    
    function index()
    {
       $data['title'] = 'Catálogo codeIgniter';
        $pages = 5; //Número de registros mostrados por páginas
        $this->load->library('pagination'); //Cargamos la librería de paginación
        $config['base_url'] = base_url() . 'index.php/carrito/pagina/'; // parametro base de la aplicación, si tenemos un .htaccess nos evitamos el index.php
        $config['total_rows'] = $this->catalogo_model->filas();
        $config['per_page'] = $pages;
        $config['num_links'] = 20; //Número de links mostrados en la paginación
        $config['first_link'] = 'Primera';
        $config['last_link'] = 'Última';
        $config['next_link'] = 'Siguiente';
        $config['prev_link'] = 'Anterior';
        $config['full_tag_open'] = '<div id="paginacion">';
        $config['full_tag_close'] = '</div>';
        $this->pagination->initialize($config);
 
        $data["productos"] = $this->catalogo_model->total_productos_paginados($config['per_page'], $this->uri->segment(3));
        $this->load->view('carrito/catalogo_view', $data);
    }
  
    function agregarProducto()
    {   
        $id = $this->input->post('id');
        $producto = $this->catalogo_model->porId($id);
        $cantidad = 1;
        $carrito = $this->cart->contents();

        foreach ($carrito as $item) {
            //si el id del producto es igual que uno que ya tengamos en la cesta le sumamos uno a la cantidad      
             if ($item['id'] == $id) {
                $cantidad = $item['qty'] + 1; 
             }
        }
        //agarramos los productos en un array para insertarlos en el carrito
         
        $insert = array(
             
            'id' => $id,
            'qty' => $cantidad,
            'price' => $producto->unit_price,
            'name' => $producto->name   
        );

        //insertamos al carrito
        $this->cart->insert($insert);
        //ponemos la url para redirigir a la página en la que estabamos
        $uri = $this->input->post('uri');
        //redirigimos mostrando un mensaje con las sesiones flashdata
        $this->session->set_flashdata('agregado', 'El producto fue agregado correctamente');
        redirect('carrito/pagina/'.$uri, 'refresh');
    }
    
    function eliminarProducto($rowid) 
    {
        //para eliminar un producto en especifico lo que hacemos es conseguir su rowid
        //y actualizarlo poniendo qty que es la cantidad a 0
        $producto = array(
            'rowid' => $rowid,
            'qty' => 0
        );
        //después simplemente utilizamos la función update de la librería cart
        //para actualizar el carrito pasando el array a actualizar
        $this->cart->update($producto);
        
        $this->session->set_flashdata('productoEliminado', 'El producto fue eliminado correctamente');
        redirect('carrito', 'refresh');
    }
    
    function eliminarCarrito() {
        $this->cart->destroy();
        $this->session->set_flashdata('destruido', 'El carrito fue eliminado correctamente');
        redirect('carrito', 'refresh');
    }
    
    function checkout(){    
                           
    if($cart=$this->cart->contents()){
      
       // $this->table->set_heading('Articulo', 'Detalle','Cantidad','Precio', 'Total'); 

        foreach($cart as $item){
            $selected = '';       
            
            if ($this->cart->has_options($item['rowid'])) {
                foreach ($this->cart->product_options($item['rowid']) as $option => $value) {
                                $selected = $option . ": <em>" . $value . "</em>";
                          }
                      }
              
                $price = ($item['price']*$item['qty']); 
              //     $this->table->add_row($item['name'], $selected, $item['qty'], $price);
                                   
                } // fin del foreach
         
         
        //  $this->table->add_row('Total', '', '', '', $this->cart->format_number($this->cart->total()));
             
        //  $message = 'Señor(a): '.$name.br(1).'Celular: '.$mobil.br(1).'Email: '.$email.br(2).'Detalles del pedido'; 
        //  $pedido = $message.$this->table->generate();  // concatenamos el mensaje con la tabla que contiene el pedido
            $pedido = 'Señor(a) M-Editorial. Detalles del pedido ';                                    
             
            $this->load->library('email');
            
            $this->email->initialize(array(
              'smtp_crypto' => 'tls',
              'protocol' => 'smtp',
              'mailtype' => 'html',              
              'smtp_host' => 'ssl://smtp.gmail.com',
              'smtp_user' => 'seb.barretp@gmail.com',
              'smtp_pass' => 'Chaquenia01',
              'smtp_port' => 465,
              'crlf' => "\r\n",
              'newline' => "\r\n"
            ));
            
            $this->email->from('pedidos@ebooK.com', 'EbooK');
            $this->email->to('blasterbarreto@hotmail.com');
            $this->email->subject('Email Test');
            $this->email->message('Testing the email class.');
            $this->email->send();
            
            echo $this->email->print_debugger();
                       
            $this->cart->destroy();
            $this->session->set_flashdata('destruido', 'El pedido fue registrado para su preparacion');
            redirect('carrito', 'refresh');          
          
        } // fin del else
   
    } // fin del método    
    
}
/*application/controllers/catalogo.php
 * el controlador
 */
