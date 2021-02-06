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

             <div class="accordion" id="accordionExample">
                 <div class="card">
                     <div class="card-header" id="headingOne">
                         <h2 class="mb-0">
                             <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                 <h5 class="text-dark text-center">Pengajuan Barang</h5>
                             </button>
                         </h2>
                     </div>

                     <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
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
                                         <th scope="col" width="10px">Opsi</th>
                                     </tr>
                                 </thead>
                                 <tbody>
                                     <?php
                                        $no = 1;
                                        foreach ($aju as $b) { ?>
                                         <tr>
                                             <th width="10px"><?= $no++ ?></th>
                                             <td><?= $b->kode ?></td>
                                             <td><?= $b->nama_barang ?></td>
                                             <td><?= $b->harga ?></td>
                                             <td><?= $b->supplier ?></td>
                                             <td><?= $b->stok . ' ' . $b->satuan ?></td>
                                             <td class="text-center"><a href="<?= base_url('pegawai/rop/') . $b->kd_masuk ?>" class="badge badge-info"> <i class="fas fa-external-link-square-alt"></i></a></td>

                                         </tr>
                                     <?php } ?>
                                 </tbody>
                             </table>
                         </div>
                     </div>
                 </div>
             </div>

             <div class="card">
                 <div class="card-header">
                     <h5 class="text-center">Status Pengajuan</h5>
                 </div>
                 <div class="card-body">
                     <table id="example1" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                         <thead>
                             <tr>
                                 <th scope="col">No</th>
                                 <th scope="col">Tanggal Diajuakn</th>
                                 <th scope="col">ID Barang</th>
                                 <th scope="col">Nama</th>
                                 <th scope="col">Harga Satuan</th>
                                 <th scope="col">Jumlah</th>
                                 <th scope="col">Supplier</th>
                                 <th scope="col">Status</th>
                             </tr>
                         </thead>
                         <tbody>
                             <?php
                                $no = 1;
                                foreach ($status as $b) { ?>
                                 <tr>
                                     <th width="10px"><?= $no++ ?></th>
                                     <td><?= date("d M Y", strtotime($b->tgl_diajukan)) ?></td>
                                     <td><?= $b->kode ?></td>
                                     <td><?= $b->nama_barang ?></td>
                                     <td><?= $b->harga ?></td>
                                     <td><?= $b->jumlah . ' ' . $b->satuan ?></td>
                                     <td><?= $b->nama_supp ?></td>
                                     <td><?= $b->status ?></td>
                                 </tr>
                             <?php } ?>
                         </tbody>
                     </table>
                 </div>
             </div>
         </section>
         <!-- /.content -->
     </div>