     <!-- Content Wrapper. Contains page content -->
     <div class="content-wrapper">
         <!-- Content Header (Page header) -->
         <section class="content-header">
             <div class="container-fluid">
                 <div class="row mb-2">
                     <div class="col-sm-6">
                         <h1>Lap. Barang Masuk</h1>
                     </div>
                     <div class="col-sm-6">
                         <ol class="breadcrumb float-sm-right">
                             <li class="breadcrumb-item"><a href="<?= base_url('owner') ?>">Home</a></li>
                             <li class="breadcrumb-item active">Lap. Barang Masuk</li>
                         </ol>
                     </div>
                 </div>
             </div><!-- /.container-fluid -->
         </section>

         <!-- Main content -->
         <section class="content">

             <!-- Default box -->
             <div class="card">
                 <div class="card-body">
                     <div class="row pull-right">
                         <div class="col-md-4">
                             <div class="card">
                                 <div class="card-header text-center">
                                     <h6>Filter Berdasarkan Tanggal</h6>
                                 </div>
                                 <div class="card-body">

                                     <form method="get" action="">
                                         <div class="form-group">
                                             <label class="font-weight-bold" for="tanggal_mulai">Tanggal Mulai</label>
                                             <input type="date" class="form-control" name="tanggal_mulai" placeholder="Masukkan tanggal mulai pinjam">
                                         </div>
                                         <div class="form-group">
                                             <label class="font-weight-bold" for="tanggal_sampai">Tanggal Sampai</label>
                                             <input type="date" class="form-control" name="tanggal_sampai" placeholder="Masukkan tanggal pinjam sampai">
                                         </div>
                                         <input type="submit" class="btn btn-primary" value="Filter">
                                     </form>

                                 </div>

                             </div>
                         </div>
                     </div>
                     <?php
                        // membuat tombol cetak jika data sudah di filter
                        if (isset($_GET['tanggal_mulai']) && isset($_GET['tanggal_sampai'])) {
                            $mulai = $_GET['tanggal_mulai'];
                            $sampai = $_GET['tanggal_sampai'];
                        ?>
                         <a class='btn btn-primary' target="_blank" href='<?php echo base_url() . 'report/masuk_cetak?tanggal_mulai=' . $mulai . '&tanggal_sampai=' . $sampai ?>'><i class='fa fa-print'></i> CETAK</a>
                     <?php
                        }
                        ?>
                 </div>
             </div>
             <div class="card">
                 <div class="card-body">
                     <table id="example1" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                         <thead>
                             <tr>
                                 <th scope="col">No</th>
                                 <th scope="col">Nama Barang </th>
                                 <th scope="col">Supplier</th>
                                 <th scope="col">Datang</th>
                                 <th class="text-center" scope="col">
                                     Jumlah Masuk
                                 </th>

                             </tr>
                         </thead>

                         <tbody>
                             <?php
                                $no = 1;
                                foreach ($masuk as $mtrl) { ?>
                                 <tr>
                                     <th width="10px" scope="row"><?= $no++ ?></th>

                                     <td><?= $mtrl->nama_barang ?></td>
                                     <td><?= $mtrl->nama_supp ?></td>
                                     <td><?= date("d M Y", strtotime($mtrl->waktu)) ?></td>
                                     <td class="text-center"><?= $mtrl->jumlah . ' ' . $mtrl->detail ?> </td>

                                 </tr>
                             <?php } ?>
                         </tbody>
                     </table>
                 </div>


             </div>


             <!-- /.card -->

         </section>
         <!-- /.content -->
     </div>
     <!-- /.content-wrapper -->