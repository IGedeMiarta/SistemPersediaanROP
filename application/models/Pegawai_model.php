<?php

class Pegawai_model extends CI_Model
{


    function read($table)
    {
        return $this->db->get($table)->result();
    }

    function insert($data, $table)
    {
        $this->db->insert($table, $data);
    }
    function edit($where, $table)
    {
        return $this->db->get_where($table, $where)->row_array();
    }

    function update($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    function delete($where, $table)
    {
        $this->db->delete($table, $where);
    }
    function kode_barang()
    {
        $query = $this->db->query("SELECT MAX(kode) as kd from barang");
        $data = $query->row();
        $kode = $data->kd;
        $nourut = substr($kode, 2, 6);

        $_barang = $nourut + 1;
        $kode_barang = 'B' . sprintf("%06s", $_barang);
        return $kode_barang;
    }
    function kode_masuk()
    {
        $query = $this->db->query("SELECT MAX(kode) as kd from barang_masuk");
        $data = $query->row();
        $kode = $data->kd;
        $nourut = substr($kode, 11, 15);
        $_barang = $nourut + 1;
        $tgl = date("ymd");
        $masuk = 'T-BM-' . $tgl . sprintf("%04s", $_barang);
        return $masuk;
    }
    function kode_keluar()
    {
        $query = $this->db->query("SELECT MAX(kode) as kd from barang_keluar");
        $data = $query->row();
        $kode = $data->kd;
        $nourut = substr($kode, 11, 15);
        $_barang = $nourut + 1;
        $tgl = date("ymd");
        $masuk = 'T-BK-' . $tgl . sprintf("%04s", $_barang);
        return $masuk;
    }

    function _enum($table, $field)
    {
        $row =  $this->db->query("SHOW COLUMNS FROM " . $table . " WHERE field LIKE '$field'")->row()->Type;
        $regex = "/'(.*?)'/";
        preg_match_all($regex, $row, $enum_array);
        $enum_field = $enum_array[1];
        foreach ($enum_field as $key => $value) {
            $enums[$value] = $value;
        }
        return $enums;
    }

    function barang()
    {
        return $this->db->query("SELECT * FROM barang, satuan_barang, jenis_barang WHERE barang.satuan=satuan_barang.id AND barang.jenis=jenis_barang.id")->result();
    }
    function masuk()
    {
        return $this->db->query("SELECT barang_masuk.kd_masuk,barang_masuk.kode,barang.nama_barang,barang_masuk.waktu,satuan_barang.satuan, supplier.nama_supp AS supplier, barang_masuk.jumlah, barang_masuk.pegawai FROM barang_masuk, barang,satuan_barang, supplier WHERE barang_masuk.kd_barang=barang.kd_barang AND barang_masuk.supplier=supplier.kd_supp AND barang.satuan=satuan_barang.id ORDER BY kd_masuk DESC")->result();
    }
    function data_aju()
    {
        return $this->db->query("SELECT barang_masuk.kd_masuk,barang_masuk.kode,barang.nama_barang,barang_masuk.waktu,satuan_barang.satuan, supplier.nama_supp AS supplier, barang_masuk.jumlah,barang.stok, barang_masuk.pegawai FROM barang_masuk, barang,satuan_barang, supplier WHERE barang_masuk.kd_barang=barang.kd_barang AND barang_masuk.supplier=supplier.kd_supp AND barang.satuan=satuan_barang.id GROUP BY barang_masuk.kd_barang ORDER BY barang_masuk.kd_masuk DESC")->result();
    }
    function keluar()
    {
        return $this->db->query("SELECT barang_keluar.kd_keluar, barang_keluar.kode,barang.nama_barang,barang_keluar.waktu,barang_keluar.jumlah,barang_keluar.pegawai,satuan_barang.satuan FROM barang_keluar, barang, satuan_barang WHERE barang_keluar.kd_barang=barang.kd_barang AND barang.satuan=satuan_barang.id ORDER BY kd_keluar DESC")->result();
    }


    function notif()
    {
        return $this->db->query("SELECT COUNT(IF(status=1,1,null))AS status FROM material_keluar")->row_array();
    }

    function user($kd)
    {
        return $this->db->query("SELECT * FROM user JOIN pegawai ON user.id_pegawai=pegawai.id_pegawai WHERE user.id_pegawai=$kd")->row_array();
    }
    function edit_out($kd)
    {
        return $this->db->query("SELECT * FROM barang_keluar JOIN barang ON barang_keluar.kd_barang=barang.kd_barang WHERE kd_keluar=$kd")->row_array();
    }
    function barang_rop()
    {
        return $this->db->query("SELECT * FROM barang WHERE rop = 0")->result();
    }
    function reorder()
    {
        return $this->db->query("SELECT * FROM rop join barang ON rop.kd_barang=barang.kd_barang")->result();
    }
    function pemesanan()
    {
        return $this->db->query("SELECT * FROM pengajuan JOIN barang ON pengajuan.barang=barang.kd_barang")->result();
    }
    function pemesanan_edt($id)
    {
        return $this->db->query("SELECT * FROM pengajuan JOIN barang ON pengajuan.barang=barang.kd_barang WHERE kd_pengajuan=$id")->row_array();
    }
    function pemesanan_owner()
    {
        return $this->db->query("SELECT * FROM pengajuan JOIN barang ON pengajuan.barang=barang.kd_barang WHERE status != 'pending'")->result();
    }

    function stok_gudang()
    {
        $query = $this->db->query("SELECT * FROM barang  ORDER BY kd_barang DESC");
        return $query->result();
    }
    function stok_gudang_edt($kd_masuk)
    {
        $query = $this->db->query("SELECT * FROM barang_masuk JOIN barang,supplier WHERE barang_masuk.kd_barang=barang.kd_barang AND barang_masuk.supplier=supplier.kd_supp AND barang_masuk.kd_masuk=$kd_masuk");
        return $query->row_array();
    }
    function stok_kasir()
    {
        $query = $this->db->query("SELECT * FROM material WHERE detail='Kasir'  ORDER BY kd_material DESC");
        return $query->result();
    }
    function stok($barang)
    {
        return $this->db->query("SELECT * FROM barang WHERE kd_barang=$barang")->result();
    }
}
