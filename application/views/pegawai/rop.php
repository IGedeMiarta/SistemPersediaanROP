     <!-- Content Wrapper. Contains page content -->
     <div class="content-wrapper">
         <!-- Content Header (Page header) -->
         <section class="content-header">
             <div class="container-fluid">
                 <div class="row mb-2">
                     <div class="col-sm-6">
                         <h1>Reorder Point</h1>
                     </div>
                     <div class="col-sm-6">
                         <ol class="breadcrumb float-sm-right">
                             <li class="breadcrumb-item"><a href="<?= base_url('pegawai') ?>">Home</a></li>
                             <li class="breadcrumb-item active">reorder point</li>
                         </ol>
                     </div>
                 </div>
             </div>
         </section>


         <!-- ==============PERHITUNGAN ROP ================== -->
         <?php
            $kd_barang = $pengajuan['kd_barang'];
            $masuk = $this->db->query("SELECT * FROM `barang_masuk` WHERE kd_barang=$kd_barang ORDER BY kd_masuk DESC LIMIT 1")->row_array();
            $awal = $masuk['jumlah']; //jumlah awal
            $w = 8; //jam kerja
            $lt = 14; // LT = waktu yang dibutuhkan pemesanan 


            $leadtime = $lt * $awal;

            // SS = 15% * leadtime
            $ss = 15 * $leadtime / 100;

            // ROP = (LT*D)+SS
            $rop = $leadtime + $ss;
            ?>

         <!-- ================ END PERHITUNGAN ================= -->




         <!-- Main content -->
         <section class="content">

             <!-- Default box -->
             <div class="card">
                 <div class="container">
                     <div class="card-header">
                         <h5 class="text-center mb-3 mt-3"><b>PENGAJUAN BARANG BERDASDARKAN METODE ROP (REORDER POINT)</b></h5>
                     </div>
                     <div class="card-body">
                         <H5 class="strong text-secondary"><?= $pengajuan['kode'] ?></H5>
                         <h5><a href="#" data-toggle="modal" data-target="#exampleModal"><?= $pengajuan['nama_barang'] ?></a></h5>
                         <div class="row">
                             <div class="col-md-8">
                                 <table class="table table-borderless text-left">
                                     <tr>
                                         <td width="10px">
                                             <div class="badge badge-danger">
                                                 <div class="text-danger">0</div>
                                             </div>
                                         </td>
                                         <td>Stok Awal</td>
                                         <td width="10px"><?= $awal ?></td>
                                     </tr>
                                     <tr>
                                         <td>
                                             <div class="badge badge-warning">
                                                 <div class="text-warning">0</div>
                                             </div>
                                         </td>
                                         <td>Leadtime</td>
                                         <td><?= round($lt) ?></td>
                                     </tr>

                                     <tr>
                                         <td>
                                             <div class="badge badge-success">
                                                 <div class="text-success">0</div>
                                             </div>
                                         </td>
                                         <td>Safety Stok (SS)</td>
                                         <td><?= round($ss)  ?> </td>
                                     </tr>

                                 </table>
                             </div>
                             <div class="col-md-4">
                                 <div class="float-right">
                                     <div class="small-box border border-warning">
                                         <div class="inner text-center">
                                             <h4><i class="fas fa-info-circle"></i> <b class="text-warning">Time to restok</b></h4>
                                             <form action="<?= base_url('pegawai/pengajuan_tambah') ?>" method="POST">
                                                 <input type="hidden" name="barang" value="<?= $pengajuan['kd_barang'] ?>">
                                                 <input type="hidden" name="harga" value="<?= $pengajuan['harga'] ?>">
                                                 <input type="hidden" name="jml" value="<?= round($rop) ?>">
                                                 <input type="hidden" name="supplier" value="<?= $pengajuan['kd_sup'] ?>">
                                                 <input type="hidden" name="ss" value="<?= round($ss)  ?>">
                                                 <input type="hidden" name="lt" value="<?= round($leadtime)  ?>">
                                                 <input type="date" name="tgl" class="form-control">
                                                 <button type="submit" class="btn btn-warning btn-sm mt-3">Send to GM</button>
                                             </form>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                     <div class="container">
                         <div class="card-body">
                             <div class="row mt-3">
                                 <div class="col-lg-4 col-6">
                                     <!-- small box -->
                                     <div class="small-box border border-warning bg-light">
                                         <div class="inner">
                                             <h4 class="text-bold">Lead Time</h4>

                                             <h5 class="text-bold text-info"><?= $leadtime ?></h5>
                                         </div>
                                         <div class="icon mb-3">
                                             <i class="fas fa-clock"></i>
                                         </div>

                                     </div>
                                 </div>
                                 <div class="col-lg-4 col-6">
                                     <!-- small box -->
                                     <div class="small-box border border-success bg-light">
                                         <div class="inner">
                                             <h4 class="text-bold">Safety Stok</h4>

                                             <h5 class="text-bold text-info"><?= round($ss) ?></h5>
                                         </div>
                                         <div class="icon mb-3">
                                             <i class="fas fa-shield-alt"></i>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="col-lg-4 col-6">
                                     <div class="small-box border border-primary bg-light">
                                         <div class="inner">

                                             <h4 class="text-bold">ROP<sup style="font-size: 20px"></sup></h4>
                                             <h5 class="text-bold text-info"><?= round($rop) ?></h5>

                                         </div>
                                         <div class="icon mb-3">
                                             <i class="fas fa-align-justify"></i>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
                 <!-- /.card -->
         </section>
         <!-- /.content -->

     </div>
     <!-- /.content-wrapper -->

     <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog">
             <div class="modal-content">

                 <div class="modal-body">
                     <table class="table table-borderless text-left">
                         <tr>

                             <td>Nomor Transaksi</td>
                             <td><?= $pengajuan['kode'] ?></td>
                         </tr>
                         <tr>
                             <td>Tanggal Masuk</td>
                             <td><?= date("d-m-Y", strtotime($pengajuan['waktu'])) ?></td>
                         </tr>
                         <tr>

                             <td>Nama Barang</td>
                             <td><?= $pengajuan['nama_barang'] ?></td>
                         </tr>
                         <tr>

                             <td>Harga Satuan</td>
                             <td><?= $pengajuan['harga'] ?></td>
                         </tr>
                         <tr>

                             <td>Jumlah Stok</td>
                             <td><?= $pengajuan['stok'] . ' ' . $pengajuan['satuan'] ?></td>
                         </tr>
                         <tr>

                             <td>Supplier</td>
                             <td><?= $pengajuan['supplier'] ?></td>
                         </tr>

                     </table>
                     <button type="button" class="btn btn-success float-right" data-dismiss="modal">Close</button>
                 </div>

             </div>
         </div>
     </div>