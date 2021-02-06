     <!-- Content Wrapper. Contains page content -->
     <div class="content-wrapper">
         <!-- Content Header (Page header) -->
         <section class="content-header">
             <div class="container-fluid">
                 <div class="row mb-2">
                     <div class="col-sm-6">
                         <h1>Pengajuan Barang</h1>
                     </div>
                     <div class="col-sm-6">
                         <ol class="breadcrumb float-sm-right">
                             <li class="breadcrumb-item"><a href="<?= base_url('pegawai') ?>">Home</a></li>
                             <li class="breadcrumb-item active">Pengajuan Barang</li>
                         </ol>
                     </div>
                 </div>
             </div><!-- /.container-fluid -->
         </section>
         <!-- Main content -->
         <section class="content">

             <!-- Default box -->
             <?php echo $this->session->flashdata('messege'); ?>


             <div class="card">

                 <div class="card-header badge badge-dark">
                     <h5 class="text-dark">Data Barang</h5>
                 </div>

                 <div class="card-body">

                     <table id="example1" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                         <thead>
                             <tr>
                                 <th scope="col">No</th>
                                 <th scope="col">ID Barang</th>
                                 <th scope="col">Nama</th>
                                 <th scope="col">Harga Barang (st)</th>
                                 <th scope="col">Supplier</th>
                                 <th scope="col">Stok</th>
                                 <th scope="col">Opsi</th>
                             </tr>
                         </thead>
                         <tbody>
                             <?php
                                $no = 1;
                                foreach ($aju as $b) { ?>
                                 <tr>
                                     <th width="10px" scope="row"><?= $no++ ?></th>
                                     <td><?= $b->kode ?></td>
                                     <td><?= $b->nama_barang ?></td>
                                     <td><?= $b->jenis ?></td>
                                     <td><?= $b->stok . ' ' . $b->satuan ?></td>
                                     <td class="text-center"><a href="" class="btn btn-info" data-toggle="modal" data-target="#staticBackdrop"> <i class="fas fa-plus"></i></a></td>
                                     <td class="text-center">
                                         <!-- <a href="" data-barang="<?= $b->kd_barang ?>" class="badge badge-warning edit-barang" data-toggle="modal" data-target="#edit_data"><i class="fas fa-edit"></i> Edit</a> -->
                                         <a href="<?= base_url('pegawai/barang_del/' . $b->kd_barang) ?>" class="badge badge-danger" onclick="return confirm('Yakin Hapus?')"><i class="fas fa-trash"></i> Hapus</a>
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

     <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered modal-lg">
             <div class="modal-content">
                 <div class="modal-header">
                     <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                     </button>
                 </div>
                 <div class="modal-body">
                     ...
                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                     <button type="button" class="btn btn-primary">Understood</button>
                 </div>
             </div>
         </div>
     </div>