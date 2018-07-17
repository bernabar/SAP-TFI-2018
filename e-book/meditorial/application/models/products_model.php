<?php

    class Products_Model extends CI_Model {

    public function get_products(){

    $this->db->order_by('category', 'asc');
    $this->db->where('deleted',0);
    $query = $this->db->get('items')->result();    

    return $query;

    }
	function get_product($id) {

    $query = $this->db->get_where('items', array('item_id' => $id))->result();

    $result = $query[0];

    if ($result->valores) {
    $result->valores = explode(',',$result->valores);
    }

    return $result;
    }
   
    }
