     <!-- Content Wrapper. Contains page content -->
     <div class="content-wrapper">
         <!-- Content Header (Page header) -->
         <section class="content-header">
             <div class="container-fluid">
                 <div class="row mb-2">
                     <div class="col-sm-6">
                         <h1>Bahan Masuk</h1>
                     </div>
                     <div class="col-sm-6">
                         <ol class="breadcrumb float-sm-right">
                             <li class="breadcrumb-item"><a href="<?= base_url('owner') ?>">Home</a></li>
                             <li class="breadcrumb-item active">Bahan Masuk</li>
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
                     <h5 class="text-dark">Tambah Barang Masuk</h5>
                 </div>
                 <div class="card-body">
                     <form method="POST" action="<?= base_url('gudang/material_in_act') ?>">

                         <div class="form-group row">
                             <label for="example-text-input" class="col-sm-2 col-form-label">Nama Barang</label>
                             <div class="col-sm-10">
                                 <select class="form-control" name="barang">
                                     <option selected>-- Pilih</option>
                                     <?php foreach ($barang as $mtrl) { ?>
                                         <option value="<?= $mtrl->kd_barang; ?>"><?= $mtrl->nama_barang   ?></option>
                                     <?php } ?>
                                 </select>
                             </div>
                         </div>

                         <div class="form-group row">
                             <label for="example-text-input" class="col-sm-2 col-form-label">Nama Supplier</label>
                             <div class="col-sm-10">
                                 <select class="form-control" name="supplier">
                                     <option selected>-- Pilih</option>
                                     <?php foreach ($supplier as $s) { ?>
                                         <option value="<?= $s->kd_supp; ?>"><?= $s->nama_supp; ?></option>
                                     <?php } ?>
                                 </select>
                             </div>
                         </div>
                         <div class="form-group row">
                             <label for="example-text-input" class="col-sm-2 col-form-label">Jumlah Masuk</label>
                             <div class="col-sm-5">
                                 <input type="number" class="form-control" name="jml" value="jumlah masuk">
                             </div>
                             <div class="col-sm-5">
                                 <?php
                                    $style = 'class="form-control input-sm"';
                                    echo form_dropdown('detail', $detail, '', $style);
                                    ?>
                             </div>
                         </div>
                         <div class="row">
                             <div class="col-sm-2">
                             </div>
                             <div class="col-sm-10">
                                 <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                             </div>
                         </div>

                     </form>
                 </div>

             </div>
             <div class="card">
                 <div class="card-header badge badge-warning">
                     <h5 class="text-dark">Data Material Masuk</h5>
                 </div>
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
                                 <!-- <th scope="col">Detail</th> -->
                                 <th scope="col">Option</th>
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
                                     <!-- <td>
                                    <a href="" class="badge badge-info"><i class="wy-text-info"></i>Detail</a>
                                </td> -->
                                     <td>
                                         <a href="<?= base_url('gudang/material_in_edt/' . $mtrl->kd_masuk) ?>" class="badge badge-warning"><i class="dripicons-document-edit"></i> Edit</a>
                                         <a href="<?= base_url('gudang/material_in_del/' . $mtrl->kd_masuk) ?>" onclick="return confirm('Yakin Hapus?')" class="badge badge-danger"><i class="dripicons-trash"></i> Hapus</a>
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