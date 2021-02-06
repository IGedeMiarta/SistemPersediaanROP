<?php

class Laporan extends CI_Model
{

    function tgl_masuk($mulai, $sampai)
    {
        return $this->db->query("SELECT * FROM `barang_masuk` JOIN supplier,barang WHERE barang_masuk.supplier=supplier.kd_supp AND barang_masuk.kd_barang=barang.kd_barang AND date(waktu) >='$mulai' AND date(waktu) <= '$sampai'  ORDER BY kd_masuk DESC")->result();
    }
    function m_masuk()
    {
        return $this->db->query("SELECT * FROM `barang_masuk` JOIN supplier,barang WHERE barang_masuk.supplier=supplier.kd_supp AND barang_masuk.kd_barang=barang.kd_barang ORDER BY kd_masuk DESC")->result();
    }
    function m_keluar()
    {
        return $this->db->query("SELECT * FROM `barang_keluar` JOIN barang ON barang_keluar.kd_barang=barang.kd_barang ORDER BY kd_keluar DESC")->result();
    }
    function tgl_keluar($mulai, $sampai)
    {
        return $this->db->query("SELECT * FROM `barang_keluar` JOIN barang ON barang_keluar.kd_barang=barang.kd_barang WHERE date(waktu) >='$mulai' AND date(waktu) <= '$sampai'  ORDER BY kd_keluar DESC")->result();
    }
    function pemesanan()
    {
        return $this->db->query("SELECT * FROM pengajuan JOIN barang ON pengajuan.barang=barang.kd_barang ORDER BY kd_pengajuan DESC")->result();
    }
    function tgl_pemesanan($mulai, $sampai)
    {
        return $this->db->query("SELECT * FROM pengajuan JOIN barang ON pengajuan.barang=barang.kd_barang WHERE date(tgl_diajukan) >='$mulai' AND date(tgl_diajukan) <= '$sampai'  ORDER BY kd_pengajuan DESC")->result();
    }
}
