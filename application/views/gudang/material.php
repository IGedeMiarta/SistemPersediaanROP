     <!-- Content Wrapper. Contains page content -->
     <div class="content-wrapper">
         <!-- Content Header (Page header) -->
         <section class="content-header">
             <div class="container-fluid">
                 <div class="row mb-2">
                     <div class="col-sm-6">
                         <h1>Data Barang</h1>
                     </div>
                     <div class="col-sm-6">
                         <ol class="breadcrumb float-sm-right">
                             <li class="breadcrumb-item"><a href="<?= base_url('gudang') ?>">Home</a></li>
                             <li class="breadcrumb-item active">Data Barang</li>
                         </ol>
                     </div>
                 </div>
             </div><!-- /.container-fluid -->
         </section>
         <!-- Main content -->
         <section class="content">

             <!-- Default box -->
             <?php if ($this->session->userdata('side') == 'gudang') { ?>
                 <div class="accordion" id="accordionExample">
                     <div class="card">
                         <div class="card-header badge badge-primary" id="headingOne">
                             <h5 class="text-dark">Tambah Data Material</h5>
                             <h2 class="mt-n5 mb-n1">
                                 <button class="btn btn-link btn-block text-right" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                     <a href="#" class="btn btn-secondary mt-2"><i class="far fa-eye"></i></a>
                                 </button>
                             </h2>
                         </div>
                         <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                             <div class="card-body">
                                 <form method="POST" action="<?= base_url('gudang/material_add_act') ?>">
                                     <div class="form-group row">
                                         <label for="example-text-input" class="col-sm-2 col-form-label">Nama barang</label>
                                         <div class="col-sm-10">
                                             <input type="text" class="form-control" id="name" name="name" placeholder="Nama Material" value="<?= set_value('name'); ?>">
                                             <?= form_error('name', '<small class="text-danger pl-3">', '</small>');  ?>
                                         </div>
                                     </div>
                                     <div class="form-group row">
                                         <label for="example-text-input" class="col-sm-2 col-form-label">Brand</label>
                                         <div class="col-sm-10">
                                             <input type="text" class="form-control input-sm" name="brand" id="">
                                         </div>
                                     </div>
                                     <div class="form-group row">
                                         <label for="example-text-input" class="col-sm-2 col-form-label">Jenis Barang</label>
                                         <div class="col-sm-10">
                                             <?php
                                                $style = 'class="form-control input-sm"';
                                                echo form_dropdown('jenis', $jenis, '', $style);
                                                ?>
                                         </div>
                                     </div>
                                     <div class="row">
                                         <div class="col-sm-2">

                                         </div>
                                         <div class="col-sm-10">
                                             <button type="submit" class="btn btn-primary mt-2">Simpan</button>
                                         </div>
                                     </div>

                                 </form>
                             </div>
                         </div>
                     </div>
                 </div>
             <?php } ?>
             <div class="card">
                 <div class="card-header badge badge-dark">
                     <h5 class="text-dark">Stok</h5>
                 </div>
                 <div class="card-body">
                     <table id="example1" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                         <thead>
                             <tr>
                                 <th scope="col">No</th>
                                 <th scope="col">Nama</th>
                                 <th scope="col">Brand</th>
                                 <th scope="col">Jenis</th>
                                 <th scope="col">RoP</th>
                                 <!-- <th scope="col">Brand</th> -->
                                 <th scope="col">
                                     Stok
                                 </th>
                                 <!-- <th scope="col">Option</th> -->
                             </tr>
                         </thead>
                         <tbody>
                             <?php
                                $no = 1;
                                foreach ($material as $mtrl) { ?>
                                 <tr>
                                     <th width="10px" scope="row"><?= $no++ ?></th>
                                     <td><?= $mtrl->nama_barang ?></td>
                                     <td><?= $mtrl->brand ?></td>
                                     <td><?= $mtrl->jenis ?></td>
                                     <td><?= $mtrl->rop ?></td>
                                     <td class="text-center">
                                         <?php
                                            if ($mtrl->stok > $mtrl->rop) {
                                                echo $mtrl->stok . ' ' . $mtrl->detail;
                                            } else if ($mtrl->stok <= $mtrl->rop) {
                                                echo '<h1 class="badge badge-warning"> ' . ' ' . $mtrl->stok . ' ' . $mtrl->detail . '</h1>';
                                            } else {
                                                echo '<h1 class="badge badge-danger">Kosong</h1>';
                                            }
                                            ?>
                                     </td>

                                     <!-- <td class="text-center" width=10px>
                                    <a href="<?= base_url('gudang/material_edt/' . $mtrl->kd_barang) ?>" class="badge badge-warning"><i class="dripicons-document-edit"></i> Edit</a>
                                </td> -->
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