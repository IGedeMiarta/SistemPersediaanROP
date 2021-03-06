     <!-- Content Wrapper. Contains page content -->
     <div class="content-wrapper">
         <!-- Content Header (Page header) -->
         <section class="content-header">
             <div class="container-fluid">
                 <div class="row mb-2">
                     <div class="col-sm-6">
                         <h1>Dashboard</h1>
                     </div>
                     <div class="col-sm-6">
                         <ol class="breadcrumb float-sm-right">
                             <li class="breadcrumb-item"><a href="<?php if ($this->session->userdata('side') == 'admin') {
                                                                        echo base_url('owner');
                                                                    } else {
                                                                        echo base_url('gudang');
                                                                    }
                                                                    ?>">Home</a></li>
                             <li class="breadcrumb-item active">Dashboard</li>
                         </ol>
                     </div>
                 </div>
             </div><!-- /.container-fluid -->
         </section>

         <!-- Main content -->
         <section class="content">
             <div class="content">
                 <div class="container-fluid">
                     <!-- start -->
                     <div class="jumbotron text-center">
                         <div class="col-sm-8 mx-auto">
                             <h1>Selamat datang!</h1>
                             <p><?= $teks ?></b>.</p>
                             <p>
                                 Anda telah login sebagai <b><?php echo $role ?></b>
                             </p>

                         </div>
                     </div>
                     <!-- Small boxes (Stat box) -->
                     <div class="row">
                         <div class="col-lg-3 col-6">
                             <!-- small box -->
                             <div class="small-box bg-info">
                                 <div class="inner">
                                     <h3><?= $supplier['jml'] ?></h3>

                                     <p>Supplier</p>
                                 </div>
                                 <div class="icon">
                                     <i class="ion ion-bag"></i>
                                 </div>

                             </div>
                         </div>
                         <!-- ./col -->
                         <!-- ./col -->
                         <div class="col-lg-3 col-6">
                             <!-- small box -->
                             <div class="small-box bg-success">
                                 <div class="inner">
                                     <h3><?= $barang['jml'] ?></h3>

                                     <p>Barang</p>
                                 </div>
                                 <div class="icon">
                                     <i class="ion ion-pie-graph"></i>
                                 </div>
                             </div>
                         </div>
                         <!-- ./col -->
                         <!-- ./col -->
                         <div class="col-lg-3 col-6">
                             <!-- small box -->
                             <div class="small-box bg-warning">
                                 <div class="inner">
                                     <h3><?= $pegawai['jml'] ?></h3>

                                     <p>Pegawai</p>
                                 </div>
                                 <div class="icon">
                                     <i class="ion ion-person-add"></i>
                                 </div>

                             </div>
                         </div>

                         <div class="col-lg-3 col-6">
                             <div class="small-box bg-danger">
                                 <div class="inner">

                                     <h3><?= $pengajuan['jml'] ?><sup style="font-size: 20px"></sup></h3>
                                     <p>Pengajuan</p>

                                 </div>
                                 <div class="icon">
                                     <i class="ion ion-stats-bars"></i>
                                 </div>
                             </div>

                         </div>
                     </div>
                     <!-- /.row -->
                     <!-- Main row -->





                     <!-- end -->
                 </div><!-- /.container-fluid -->
             </div>
         </section>
         <!-- /.content -->
     </div>
     <!-- /.content-wrapper -->