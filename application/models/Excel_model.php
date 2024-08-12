<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Excel_model extends CI_Model {

    public function insert_data_kategori($data) {
        $this->db->insert_batch('tb_kategori', $data);
    }

    public function insert_data_barang($data) {
        $this->db->insert_batch('tb_barang', $data);
    }

    public function insert_data_rekening($data) {
        $this->db->insert_batch('tb_rekening', $data);
    }

    public function insert_data_satuan($data) {
        $this->db->insert_batch('tb_satuan', $data);
    }
    
}
?>
