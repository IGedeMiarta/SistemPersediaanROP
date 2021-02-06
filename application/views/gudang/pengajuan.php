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
                     <form method="POST" action="<?= base_url('gudang/pengajuan_update/') . $order['kd_pengajuan'] ?>">
                         <div class="form-group row">
                             <label for="example-text-input" class="col-sm-2 col-form-label">Nama Barang</label>
                             <div class="col-sm-10">
                                 <input type="text" class="form-control" name="barang" value="<?= $order['nama_barang'] ?>" readonly>
                             </div>
                         </div>
                         <div class="form-group row">
                             <label for="example-text-input" class="col-sm-2 col-form-label">Jumlah</label>
                             <div class="col-sm-10">
                                 <input type="text" class="form-control" name="jumlah" value="<?= $order['jumlah'] ?>">
                             </div>
                         </div>
                         <div class="form-group row">
                             <label for="example-text-input" class="col-sm-2 col-form-label">Keterangan</label>
                             <div class="col-sm-10">
                                 <textarea name="ket" id="" cols="30" rows="3" class="form-control" required><?= $order['ket'] ?></textarea>
                             </div>
                         </div>
                         <div class="row">
                             <div class="col-sm-2">
                             </div>
                             <div class="col-sm-10">
                                 <button type="submit" onclick="return confirm('Yakin Simpan?, Setelah Simpan data akan dikirim ke manager dan tidak dapat di edit kambali!')" class="btn btn-primary mt-3">Simpan</button>
                             </div>
                         </div>

                     </form>
                 </div>

             </div>

             <!-- /.card -->

         </section>
         <!-- /.content -->
     </div>
     <!-- /.content-wrapper -->