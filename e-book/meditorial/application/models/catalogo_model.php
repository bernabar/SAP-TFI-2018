<?php

class Catalogo_model extends CI_Model {

    public function construct() {
        parent::__construct();
    }

    function filas() {
        $consulta = $this->db->get('items');
        return $consulta->num_rows();
    }

    function total_productos_paginados($por_pagina, $segmento) {
        $consulta = $this->db->get('items', $por_pagina, $segmento);
        if ($consulta->num_rows() > 0) {
            foreach ($consulta->result() as $fila) {              
              if ($fila->deleted == '0') {
                $data[] = $fila;
              }  
            }
            return $data;  
        }
    }

    function porId($id) {
		$this->db->from('items');	
		$this->db->where('item_id',$id);
		//echo $id. 'sdasdsadasds';
		$productos = $this->db->get();
		//print_r ($productos). 'sdasdsadasds';
        foreach ($productos->result() as $producto) {
            $data[] = $producto;
        }
        if ($producto->opciones) {
            $producto->opciones = explode(',', $producto->opciones);
        }
        return $producto;  
    }
}
/*application/models/catalogo_model.php
 * el modelo
 */
