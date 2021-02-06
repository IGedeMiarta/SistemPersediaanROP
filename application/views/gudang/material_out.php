     <!-- Content Wrapper. Contains page content -->
     <div class="content-wrapper">
         <!-- Content Header (Page header) -->
         <section class="content-header">
             <div class="container-fluid">
                 <div class="row mb-2">
                     <div class="col-sm-6">
                         <h1>Barang Keluar</h1>
                     </div>
                     <div class="col-sm-6">
                         <ol class="breadcrumb float-sm-right">
                             <li class="breadcrumb-item"><a href="<?= base_url('gudang') ?>">Home</a></li>
                             <li class="breadcrumb-item active">Barang Keluar</li>
                         </ol>
                     </div>
                 </div>
             </div><!-- /.container-fluid -->
         </section>

         <!-- Main content -->
         <section class="content">
             <?php echo $this->session->flashdata('messege'); ?>
             <!-- Default box -->
             <div class="card">
                 <div class="card-header badge badge-dark">
                     <h5 class="text-dark">Tambah Barang Keluar</h5>
                 </div>
                 <div class="card-body">
                     <form method="POST" action="<?= base_url('gudang/material_out_act') ?>">
                         <div class="form-group row">
                             <label for="example-text-input" class="col-sm-2 col-form-label">Nama Material</label>
                             <div class="col-sm-10">
                                 <select class="form-control" name="barang" id="barang" onchange="autofill()">
                                     <option selected>-- Pilih</option>
                                     <?php foreach ($barang as $mtrl) { ?>
                                         <option value="<?= $mtrl->kd_barang; ?>"><?= $mtrl->nama_barang   ?></option>
                                     <?php } ?>
                                 </select>
                             </div>
                         </div>
                         <div class="form-group row">
                             <label for="example-text-input" class="col-sm-2 col-form-label">Tersedia</label>
                             <div class="col-sm-10">
                                 <div class="input-group">
                                     <input type="number" class="form-control" id="stok" name="stok" placeholder="Jumlah Tersedia" readonly>
                                     <div class="input-group-append">
                                         <input type="text" class="form-control" id="detail" name="detail" placeholder="satuan" readonly>
                                     </div>
                                 </div>
                             </div>
                         </div>

                         <div class="form-group row">
                             <label for="example-text-input" class="col-sm-2 col-form-label">Jumlah</label>
                             <div class="col-sm-10">
                                 <input type="number" name="jumlah" class="form-control" maxlength="1" id="">
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
                     <h5>Data Barang Keluar</h5>
                 </div>
                 <div class="card-body">
                     <!-- <a href="<?= base_url('gudang/material_out_add') ?>" class="btn btn-success mb-3"><i class="dripicons-plus"></i> Tambah</a> -->
                     <table id="example1" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                         <thead>
                             <tr>
                                 <th scope="col">No</th>
                                 <th scope="col">Nama Barang </th>
                                 <th scope="col">Tanggal Keluar</th>
                                 <th class="text-center" scope="col">
                                     Jumlah Keluar
                                 </th>
                                 <th scope="col">Opsi</th>
                             </tr>
                         </thead>

                         <tbody>
                             <?php
                                $no = 1;
                                foreach ($masuk as $mtrl) { ?>
                                 <tr>
                                     <th width="10px" scope="row"><?= $no++ ?></th>

                                     <td><?= $mtrl->nama_barang ?></td>
                                     <td><?= date("d M Y", strtotime($mtrl->waktu)) ?></td>
                                     <td class="text-center"><?= $mtrl->jumlah . ' ' . $mtrl->detail ?></td>
                                     <td width=150px>
                                         <a href="<?= base_url('gudang/material_out_edt/') . $mtrl->kd_keluar ?>" class="badge badge-warning"><i class="fas fa-edit"></i> Edit</a>
                                         <a href="<?= base_url('gudang/material_out_del/') . $mtrl->kd_keluar ?>" onclick="return confirm('Yakin Ingin Hapus?')" class="badge badge-danger"><i class="fas fa-trash"></i> Hapus</a>
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