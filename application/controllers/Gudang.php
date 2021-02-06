<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Gudang extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->library('form_validation');
        $this->load->model('Pemilik');

        $this->load->model('gudang_model');
        $this->load->model('dashboard');
        $this->load->model('laporan');
        $this->load->model('alert');

        $barang = $this->db->query("SELECT * FROM barang WHERE stok <= rop AND barang.sts != 1")->row_array();
        $kd = $barang['kd_barang'];
        if ($barang != null) {
            $tgl = date("Y-m-d");
            $jumlah = 10;
            $ket = 'Pemesanan Otomatis Sistem';
            $data = [
                'barang' => $kd,
                'tgl_diajukan' => $tgl,
                'jumlah' => $jumlah,
                'ket' => $ket,
                'status' => 'pending'
            ];
            $this->db->insert('pengajuan', $data);
            $this->db->where(['kd_barang' => $kd]);
            $this->db->update('barang', ['sts' => 1]);
        }
    }

    public function index()
    {
        $data['pegawai'] = $this->dashboard->_pegawai();
        $data['supplier'] = $this->dashboard->_supplier();
        $data['barang'] = $this->dashboard->_barang();
        $data['pengajuan'] = $this->dashboard->_pengajuan();
        $data['teks'] = "Halaman Pegawai Sistem Persedian Barang Gamalama Indah Hotel, pegawai dapat menajemen data barang, menginputkan data barang masuk, keluar, manajeman stok dan Melakukan Pengajuan Barang";
        $data['role'] = 'Pegawai';
        $data['judul'] = 'Dashboard';
        $this->load->view('temp/header', $data);
        $this->load->view('temp/topbar');
        $this->load->view('temp/sidebar');
        $this->load->view('temp/dashboard', $data);
        $this->load->view('temp/footer');
    }


    public function supplier()
    {
        $data['supplier'] = $this->Pemilik->read('supplier')->result();

        $data['judul'] = 'Supplier';

        $this->load->view('temp/header', $data);
        $this->load->view('temp/topbar');
        $this->load->view('temp/sidebar');
        $this->load->view('owner/supplier', $data);
        $this->load->view('temp/footer');
    }

    public function supplier_add()
    {

        $data['judul'] = 'Tambah Supplier';
        $this->load->view('temp/header', $data);
        $this->load->view('temp/topbar');
        $this->load->view('temp/sidebar');
        $this->load->view('owner/supplier_add', $data);
        $this->load->view('temp/footer');
    }

    public function supplier_add_act()
    {
        $this->form_validation->set_rules('sup_name', 'Sup_name', 'trim|required');
        $this->form_validation->set_rules('owner', 'Owner', 'trim|required');
        $this->form_validation->set_rules('hp', 'Hp', 'trim|required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');

        if ($this->form_validation->run() == false) {
            $data['status'] = $this->alert->notifikasi();
            $data['alert'] = $this->alert->notif();
            $data['judul'] = 'Tambah Supplier';
            $this->load->view('temp/header', $data);
            $this->load->view('temp/topbar');
            $this->load->view('temp/sidebar');
            $this->load->view('owner/supplier_add', $data);
            $this->load->view('temp/footer');
        } else {
            //validasi sukses
            $nama_sup = $this->input->post('sup_name', true);
            $owner = $this->input->post('owner', true);
            $no_hp = $this->input->post('hp', true);
            $alamat = $this->input->post('alamat', true);
            $data = [
                'nama_supp' => $nama_sup,
                'owner' => $owner,
                'no_hp' => $no_hp,
                'alamat' => $alamat
            ];

            $this->Pemilik->insert($data, 'supplier');
            redirect('gudang/supplier');
        }
    }

    public function supplier_edt($id_sup)
    {
        $data['judul'] = 'Edit Supplier';
        // $data['status'] = $this->alert->notifikasi();
        $data['supplier'] = $this->Pemilik->edit(['kd_supp' => $id_sup], 'supplier');

        $this->load->view('temp/header', $data);
        $this->load->view('temp/topbar');
        $this->load->view('temp/sidebar');
        $this->load->view('owner/supplier_edt', $data);
        $this->load->view('temp/footer');
    }
    public function supplier_edt_act($id_sup)
    {
        $where = array('kd_supp' => $id_sup);
        // $data['status'] = $this->alert->notifikasi();
        $this->form_validation->set_rules('sup_name', 'Sup_name', 'trim|required');
        $this->form_validation->set_rules('owner', 'Owner', 'trim|required');
        $this->form_validation->set_rules('hp', 'Hp', 'trim|required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required');
        // $data['alert'] = $this->alert->notif();
        $data['judul'] = 'Edit Supplier';
        if ($this->form_validation->run() == false) {
            $this->load->view('temp/header', $data);
            $this->load->view('temp/topbar');
            $this->load->view('temp/sidebar');
            $this->load->view('owner/supplier_edt', $data);
            $this->load->view('temp/footer');
        } else {
            //validasi sukses
            $nama_sup = $this->input->post('sup_name', true);
            $owner = $this->input->post('owner', true);
            $no_hp = $this->input->post('hp', true);
            $alamat = $this->input->post('alamat', true);
            $data = [
                'nama_supp' => $nama_sup,
                'owner' => $owner,
                'no_hp' => $no_hp,
                'alamat' => $alamat
            ];

            $this->Pemilik->update($where, $data, 'supplier');
            redirect('gudang/supplier');
        }
    }

    // =====================================  end supplier =========================================================




    public function material()
    {
        $kd = $this->session->userdata('pegawai');
        $data['user'] = $this->gudang_model->user($kd);
        $data['jenis'] = $this->gudang_model->material_enum('barang', 'jenis');
        $data['material'] = $this->gudang_model->stok_gudang();
        $data['judul'] = 'Stok Barang';
        $this->load->view('temp/header', $data);
        $this->load->view('temp/topbar');
        $this->load->view('temp/sidebar');
        $this->load->view('gudang/material', $data);
        $this->load->view('temp/footer');
    }

    public function material_add_act()
    {

        $nama = $this->input->post('name', true);
        $jenis = $this->input->post('jenis', true);
        $brand = $this->input->post('brand', true);
        if ($brand == null) {
            $brand = '-';
        } else {
            $brand = $brand;
        }
        $data = [
            'nama_barang' => $nama,
            'brand' => $brand,
            'jenis' => $jenis
        ];
        $this->gudang_model->insert($data, 'barang');
        redirect('gudang/material');
    }

    public function material_edt($kd_material)
    {
        $kd = $this->session->userdata('pegawai');
        $data['user'] = $this->gudang_model->user($kd);
        $data['alert'] = $this->alert->notif();
        $data['material'] = $this->gudang_model->read('material')->result();
        $data['varian'] = $this->gudang_model->material_enum('material', 'varian');
        $data['bentuk'] = $this->gudang_model->material_enum('material', 'bentuk');
        // $data['tipe'] = $this->gudang_model->material_enum('material', 'tipe');
        $data['detail'] = $this->gudang_model->material_enum('material', 'detail');
        $data['edit'] = $this->gudang_model->material_edt($kd_material);
        $data['status'] = $this->alert->notifikasi();
        $this->load->view('default/header');
        $this->load->view('default/sidebar', $data);
        $this->load->view('default/topbar', $data);
        $this->load->view('gudang/material_edt', $data);
        $this->load->view('default/footer');
    }

    public function material_edt_act($kd_material)
    {

        $where = array('kd_material' => $kd_material);
        $nama = $this->input->post('name', true);
        $varian = $this->input->post('varian', true);
        $tipe = $this->input->post('tipe', true);
        $data = [
            'nama' => $nama,
            'varian' => $varian,
            'detail' => 'Gudang'
        ];

        $this->gudang_model->update($where, $data, 'material');
        redirect('gudang/material');
    }

    public function cari()
    {
        $barang = $_GET['barang'];
        $cari = $this->gudang_model->stok($barang);
        echo json_encode($cari);
    }

    public function material_in()
    {
        $data['barang'] = $this->gudang_model->read('barang')->result();
        $data['supplier'] = $this->gudang_model->read('supplier')->result();
        $data['masuk'] = $this->gudang_model->material_msk();
        $data['detail'] = $this->gudang_model->material_enum('barang', 'detail');
        $data['judul'] = 'Barang Masuk';
        $this->load->view('temp/header', $data);
        $this->load->view('temp/topbar');
        $this->load->view('temp/sidebar');
        $this->load->view('gudang/material_in', $data);
        $this->load->view('temp/footer');
    }

    public function material_in_act()
    {
        $barang = $this->input->post('barang', true);
        $waktu = date("Y-m-d H:i:s");
        $jumlah = $this->input->post('jml', true);
        $supplier = $this->input->post('supplier', true);
        $detail = $this->input->post('detail', true);

        $data = [
            'kd_barang' => $barang,
            'waktu' => $waktu,
            'jumlah' => $jumlah,
            'detail' => $detail,
            'supplier' => $supplier
        ];

        $this->gudang_model->insert($data, 'barang_masuk');
        $this->gudang_model->update(['kd_barang' => $barang], ['sts' => 0], 'barang');
        redirect('gudang/material_in');
    }

    public function material_in_edt($kd_masuk)
    {
        // $kd = $this->session->userdata('pegawai');
        // $data['user'] = $this->gudang_model->user($kd);
        // $data['alert'] = $this->alert->notif();
        $data['barang'] = $this->gudang_model->read('barang')->result();
        $data['edit'] = $this->gudang_model->stok_gudang_edt($kd_masuk);
        $data['supplier'] = $this->gudang_model->read('supplier')->result();
        $data['judul'] = 'Edit Barang Masuk';
        $this->load->view('temp/header', $data);
        $this->load->view('temp/topbar');
        $this->load->view('temp/sidebar');
        $this->load->view('gudang/material_in_edt', $data);
        $this->load->view('temp/footer');
    }
    public function material_update($kd_masuk)
    {
        $material = $this->input->post('material', true);
        $waktu = date("Y-m-d H:i:s");
        $jumlah = $this->input->post('jumlah', true);
        $supplier = $this->input->post('supplier', true);

        $barang = $this->input->post('barang', true);
        $waktu = date("Y-m-d H:i:s");
        $jumlah = $this->input->post('jml', true);
        $supplier = $this->input->post('supplier', true);

        $data = [
            'kd_barang' => $barang,
            'waktu' => $waktu,
            'jumlah' => $jumlah,
            'supplier' => $supplier
        ];
        $where = array('kd_masuk' => $kd_masuk);

        $this->gudang_model->update($where, $data, 'barang_masuk');
        redirect('gudang/material_in');
    }

    public function material_in_del($kd_masuk)
    {
        $where = array('kd_masuk' => $kd_masuk);
        $this->gudang_model->delete($where, 'barang_masuk');
        redirect('gudang/material_in');
    }

    public function material_out()
    {
        // $data['alert'] = $this->alert->notif();
        // $kd = $this->session->userdata('pegawai');
        // $data['user'] = $this->gudang_model->user($kd);
        $data['barang'] = $this->gudang_model->read('barang')->result();
        $data['masuk'] = $this->gudang_model->material_out();
        // $data['status'] = $this->alert->notifikasi();
        $data['judul'] = 'Barang Keluar';
        $this->load->view('temp/header', $data);
        $this->load->view('temp/topbar');
        $this->load->view('temp/sidebar');
        $this->load->view('gudang/material_out', $data);
        $this->load->view('temp/footer');
    }

    public function material_out_edt($kd)
    {
        $data['judul'] = 'Edit barang Keluar';
        $data['out'] = $this->gudang_model->edit_out($kd);
        $this->load->view('temp/header', $data);
        $this->load->view('temp/topbar');
        $this->load->view('temp/sidebar');
        $this->load->view('gudang/material_out_edt', $data);
        $this->load->view('temp/footer');
    }
    public function material_out_act()
    {
        $barang = $this->input->post('barang', true);
        $waktu = date("Y-m-d H:i:s");
        $jumlah = $this->input->post('jumlah', true);
        $stok = $this->input->post('stok');
        if ($jumlah <= $stok) {
            $data = [
                'kd_barang' => $barang,
                'waktu' => $waktu,
                'jumlah' => $jumlah
            ];
            $this->gudang_model->insert($data, 'barang_keluar');
            redirect('gudang/material_out');
        } else {
            $this->session->set_flashdata('messege', '<script language="javascript">alert("Jumlah Yang Dimasukan Melebihi Stok!!!")</script>');
            $this->material_out();
        }
    }
    public function material_out_update($kd)
    {

        $barang = $this->input->post('barang', true);
        $waktu = date("Y-m-d H:i:s");
        $jumlah = $this->input->post('jml', true);

        $data = [
            'waktu' => $waktu,
            'jumlah' => $jumlah
        ];
        $where = array('kd_keluar' => $kd);

        $this->gudang_model->update($where, $data, 'barang_keluar');
        redirect('gudang/material_out');
    }
    public function material_out_del($kd_keluar)
    {
        $this->gudang_model->delete(['kd_keluar' => $kd_keluar], 'barang_keluar');
        redirect('gudang/material_out');
    }
    // =================================  =========== =================================================

    function material_kasir($kd)
    {
        $data['status'] = $this->alert->notifikasi();
        $kd = $kd - 1;
        $data['alert'] = $this->alert->notif();
        $kd2 = $this->session->userdata('pegawai');
        $data['user'] = $this->gudang_model->user($kd2);
        $data['material'] = $this->gudang_model->stok_gudang();
        $data['out'] = $this->db->query("SELECT * FROM material WHERE material.kd_material=$kd")->row_array();
        $this->load->view('default/header');
        $this->load->view('default/sidebar', $data);
        $this->load->view('default/topbar', $data);
        $this->load->view('gudang/matrial_kasir', $data);
        $this->load->view('default/footer');
    }
    function material_kasir_act()
    {
        $material = $this->input->post('material', true);
        $waktu = date("Y-m-d H:i:s");
        $jumlah = $this->input->post('jumlah', true);

        $data = [
            'kd_material' => $material,
            'waktu' => $waktu,
            'jumlah' => $jumlah,
            'detail' => 'Gudang',
            'status' => 1
        ];
        $this->gudang_model->insert($data, 'material_keluar');
        redirect('gudang/material_out');
    }
    function supplier_del($id)
    {
        $this->gudang_model->delete(['kd_supp' => $id], 'supplier');
        redirect('gudang/supplier');
    }
    function reorder()
    {
        $data['judul'] = 'Reorder';
        $data['barang'] = $this->gudang_model->barang_rop();
        $data['rop'] = $this->gudang_model->reorder();
        $this->load->view('temp/header', $data);
        $this->load->view('temp/topbar');
        $this->load->view('temp/sidebar');
        $this->load->view('gudang/reorder', $data);
        $this->load->view('temp/footer');
    }
    function reorderact()
    {
        $kd_barang = $this->input->post('barang');
        $lt = $this->input->post('lt');
        $ss = 20;
        $barang = $this->gudang_model->edit(['kd_barang' => $kd_barang], 'barang')->row_array();
        $stok = $barang['stok'];
        $rop = $lt + (($stok * $ss) / 100);
        $data = [
            'kd_barang' => $kd_barang,
            'lt' => $lt,
            'ss' => $ss,
            'rop' => $rop
        ];
        $this->gudang_model->insert($data, 'rop');
        $this->gudang_model->update(['kd_barang' => $kd_barang], ['rop' => $rop], 'barang');
        redirect('gudang/reorder');
    }
    function pemesanan()
    {
        $data['judul'] = 'Pemesanan';
        $data['rop'] = $this->gudang_model->pemesanan();
        $this->load->view('temp/header', $data);
        $this->load->view('temp/topbar');
        $this->load->view('temp/sidebar');
        $this->load->view('gudang/pemesanan', $data);
        $this->load->view('temp/footer');
    }
    function pemesanan_edt($id)
    {
        $data['order'] = $this->gudang_model->pemesanan_edt($id);
        $data['judul'] = 'Sesuaikan Pengajuan';
        $this->load->view('temp/header', $data);
        $this->load->view('temp/topbar');
        $this->load->view('temp/sidebar');
        $this->load->view('gudang/pengajuan', $data);
        $this->load->view('temp/footer');
    }
    function pengajuan_update($id)
    {
        $tgl = date("Y-m-d");
        $jumlah = $this->input->post('jumlah');
        $ket = $this->input->post('ket');
        $data = [
            'tgl_diajukan' => $tgl,
            'jumlah' => $jumlah,
            'ket' => $ket,
            'status' => 'waiting'
        ];
        $this->gudang_model->update(['kd_pengajuan' => $id], $data, 'pengajuan');
        redirect('gudang/pemesanan');
    }
}
