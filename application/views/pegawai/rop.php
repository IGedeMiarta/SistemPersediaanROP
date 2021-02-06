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
             </div><!-- /.container-fluid -->
         </section>

         <!-- data query -->
         <?php
            $kd_barang = $pengajuan['kd_barang'];
            $keluar =  $this->db->query("SELECT *,MAX(jumlah)as max, AVG(jumlah) as avg FROM `barang_keluar` WHERE kd_barang=$kd_barang")->row_array();
            // LT = waktu yang dibutuhkan pemesanan 
            $lt = 15;
            // SS = (max * lt)-(avg*avg(lt))
            $ss = ($keluar['max'] * 15) - ($keluar['avg'] * 15);

            // D = stok/waktu_kerja;
            $d = $pengajuan['stok'] / 8;

            // ROP = (LT*D)+SS
            $rop = ($lt * $d) + $ss;
            ?>
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
                                         <td>Pengeluaran Barang Tertinggi</td>
                                         <td width="10px"><?= $keluar['max'] ?></td>
                                     </tr>
                                     <tr>
                                         <td>
                                             <div class="badge badge-warning">
                                                 <div class="text-warning">0</div>
                                             </div>
                                         </td>
                                         <td>Leadtime Terlama</td>
                                         <td><?= $lt ?></td>
                                     </tr>
                                     <tr>
                                         <td>
                                             <div class="badge badge-success">
                                                 <div class="text-success">0</div>
                                             </div>
                                         </td>
                                         <td>Rata-Rata Pengeluaran Harian</td>
                                         <td><?= round($keluar['avg']) ?></td>
                                     </tr>
                                     <tr>
                                         <td>
                                             <div class="badge badge-success">
                                                 <div class="text-success">0</div>
                                             </div>
                                         </td>
                                         <td>Rata-Rata Lead Time</td>
                                         <td><?= $lt ?></td>
                                     </tr>
                                     <tr>
                                         <td>
                                             <div class="badge badge-success">
                                                 <div class="text-success">0</div>
                                             </div>
                                         </td>
                                         <td>Safety Stok (SS)</td>
                                         <td><?= $ss ?></td>
                                     </tr>
                                     <tr>
                                         <td>
                                             <div class="badge badge-success">
                                                 <div class="text-success">0</div>
                                             </div>
                                         </td>
                                         <td>Penggunaan Perhari</td>
                                         <td><?= round($d) ?></td>
                                     </tr>
                                     <tr>
                                         <td>
                                             <div class="badge badge-success">
                                                 <div class="text-success">0</div>
                                             </div>
                                         </td>
                                         <td>Lead Time</td>
                                         <td><?= $lt ?></td>
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
                                 <div class="col-lg-3 col-6">
                                     <!-- small box -->
                                     <div class="small-box border border-secondary bg-light">
                                         <div class="inner">
                                             <h4 class="text-bold">Safety Stok</h4>

                                             <h5 class="text-bold text-info"><?= $ss ?> Pcs</h5>
                                         </div>
                                         <div class="icon mb-3">
                                             <i class="fas fa-shield-alt"></i>
                                         </div>
                                     </div>
                                 </div>
                                 <!-- ./col -->
                                 <!-- ./col -->
                                 <div class="col-lg-3 col-6">
                                     <!-- small box -->
                                     <div class="small-box border border-secondary bg-light">
                                         <div class="inner">
                                             <h4 class="text-bold">Penggunaan</h4>

                                             <h5 class="text-bold text-info"><?= round($d) ?> Pcs</h5>
                                         </div>
                                         <div class="icon mb-3">
                                             <i class="fas fa-calendar-check"></i>
                                         </div>
                                     </div>
                                 </div>
                                 <!-- ./col -->
                                 <!-- ./col -->
                                 <div class="col-lg-3 col-6">
                                     <!-- small box -->
                                     <div class="small-box border border-secondary bg-light">
                                         <div class="inner">
                                             <h4 class="text-bold">Lead Time</h4>

                                             <h5 class="text-bold text-info"><?= $lt ?> Days</h5>
                                         </div>
                                         <div class="icon mb-3">
                                             <i class="fas fa-clock"></i>
                                         </div>

                                     </div>
                                 </div>

                                 <div class="col-lg-3 col-6">
                                     <div class="small-box border border-secondary bg-light">
                                         <div class="inner">

                                             <h4 class="text-bold">ROP<sup style="font-size: 20px"></sup></h4>
                                             <h5 class="text-bold text-info"><?= round($rop) ?> Pcs</h5>

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