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
             <?php if ($this->session->userdata('side') == 'gudang') { ?>
                 <div class="accordion" id="accordionExample">
                     <div class="card">
                         <div class="card-header badge badge-primary" id="headingOne">
                             <h5 class="text-dark">Menentukan Reorder Point</h5>
                             <h2 class="mt-n5 mb-n1">
                                 <button class="btn btn-link btn-block text-right" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                     <a href="#" class="btn btn-secondary mt-2"><i class="far fa-eye"></i></a>
                                 </button>
                             </h2>
                         </div>
                         <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                             <div class="card-body">
                                 <form method="POST" action="<?= base_url('gudang/reorderact') ?>">
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
                                         <label for="example-text-input" class="col-sm-2 col-form-label">Stok</label>
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
                                         <label for="example-text-input" class="col-sm-2 col-form-label">Safety Stok (SS)</label>
                                         <div class="col-sm-10">
                                             <input type="number" class="form-control input-sm" placeholder="Jumlah Safetystok adalah 20% dari total stok" name="ss" id="" readonly>
                                         </div>
                                     </div>
                                     <div class="form-group row">
                                         <label for="example-text-input" class="col-sm-2 col-form-label">Leadtime (LT)</label>
                                         <div class="col-sm-10">
                                             <input type="number" class="form-control input-sm" placeholder="Jumlah Hari yang dibutuhkan antara pemesanandengan barang sampai." name="lt" id="">
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
                                 <th scope="col">Nama Barang</th>
                                 <th scope="col">Leadtime</th>
                                 <th scope="col">Safetystok</th>
                                 <th scope="col">Reorder Point</th>
                             </tr>
                         </thead>
                         <tbody>
                             <?php
                                $no = 1;
                                foreach ($rop as $r) { ?>
                                 <tr>
                                     <th width="10px" scope="row"><?= $no++ ?></th>
                                     <td><?= $r->nama_barang ?></td>
                                     <td><?= $r->lt ?> hari</td>
                                     <td><?= $r->ss ?>%</td>
                                     <td><?= $r->rop ?></td>
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