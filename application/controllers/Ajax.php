<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ajax extends CI_Controller
{
    public function edit_satuan()
    {
        if ($this->input->is_ajax_request()) {
            $id = $this->input->post('satuan');
            $satuan_barang = $this->db->get_where('satuan_barang', ['id' => $id])->row();
            echo json_encode($satuan_barang);
        } else {
            redirect('eror');
        }
    }
    public function edit_jenis()
    {
        if ($this->input->is_ajax_request()) {
            $id = $this->input->post('jenis');
            $jenis_barang = $this->db->get_where('jenis_barang', ['id' => $id])->row();
            echo json_encode($jenis_barang);
        } else {
            redirect('eror');
        }
    }
    public function edit_barang()
    {
        if ($this->input->is_ajax_request()) {
            $id = $this->input->post('barang');
            $barang = $this->db->get_where('barang', ['kd_barang' => $id])->row();
            echo json_encode($barang);
        } else {
            redirect('eror');
        }
    }
    public function cari()
    {
        $barang = $_GET['barang'];
        $cari = $this->db->query("SELECT * FROM barang, satuan_barang WHERE barang.satuan=satuan_barang.id AND kd_barang=$barang")->result();
        echo json_encode($cari);
    }
}
