     <!-- Content Wrapper. Contains page content -->
     <div class="content-wrapper">
         <!-- Content Header (Page header) -->
         <section class="content-header">
             <div class="container-fluid">
                 <div class="row mb-2">
                     <div class="col-sm-6">
                         <h1>Re-order</h1>
                     </div>
                     <div class="col-sm-6">
                         <ol class="breadcrumb float-sm-right">
                             <li class="breadcrumb-item"><a href="<?= base_url('gudang') ?>">Home</a></li>
                             <li class="breadcrumb-item active">Re-order</li>
                         </ol>
                     </div>
                 </div>
             </div><!-- /.container-fluid -->
         </section>
         <!-- Main content -->
         <section class="content">

             <!-- Default box -->

             <div class="card">
                 <div class="card-header badge badge-dark">
                     <h5 class="text-dark">Pengajuan Barang</h5>
                 </div>
                 <div class="card-body">
                     <table id="example1" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                         <thead>
                             <tr>
                                 <th scope="col">Tanggal</th>
                                 <th scope="col">Nama Barang</th>
                                 <th scope="col">Jumlah</th>
                                 <th scope="col">Keterangan</th>
                                 <th scope="col">Status</th>
                                 <th scope="col">Opsi</th>
                             </tr>
                         </thead>
                         <tbody>
                             <?php
                                $no = 1;
                                foreach ($rop as $r) { ?>
                                 <tr>
                                     <td><?= date("d-m-Y", strtotime($r->tgl_diajukan)) ?></td>
                                     <td><?= $r->nama_barang ?></td>
                                     <td><?= $r->jumlah ?></td>
                                     <td width="50px"><?= $r->ket ?></td>
                                     <td><?= $r->status ?></td>
                                     <td>
                                         <?php if ($r->status == 'pending') : ?>
                                             <a href="<?= base_url('gudang/pemesanan_edt/') . $r->kd_pengajuan ?>" class="badge badge-success"><i class="fas fa-edit"> Sesuaikan Data</i></a>
                                         <?php else : ?>
                                             -
                                         <?php endif ?>
                                     </td>
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

     <!-- Modal -->