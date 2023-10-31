<?php include 'header.php'; ?>
<title>Master Pemeriksaan Paket</title>
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      PEMERIKSAAN
      <small>Data Paket</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>
  
<section class="content">

<!-- notifikasi -->      
            <?php 
                if(isset($_GET['alert'])){
                  if($_GET['alert']=='gagal'){
                    ?>
                    <div class="alert alert-danger alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                      <h4><i class="icon fa fa-warning"></i>Gagal ! DATA PEMERIKSAAN GANDA</h4>
                      Data Pemeriksaan Sudah Ada Di Master Pemeriksaan !!!
                    </div>								
                    <?php 
                  }elseif($_GET['alert']=="berhasil"){
                    ?>
                    <div class="alert alert-info alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                      <h4><i class="icon fa fa-check"></i> Success</h4>
                      Data Pemeriksaan Berhasil Disimpan
                    </div>
                    <?php
                  }elseif($_GET['alert']=="hapus"){
                    ?>
                    <div class="alert alert-danger alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                      <h4><i class="icon fa fa-check"></i> Success</h4>
                      Data Pemeriksaan Berhasil Dihapus
                    </div>
                    <?php
                  }elseif($_GET['alert']=="update"){
                    ?>
                    <div class="alert alert-warning alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                      <h4><i class="icon fa fa-check"></i> Success</h4>
                      Data Pemeriksaan Berhasil Diupdate
                    </div>
                    <?php
                  }
                }
                ?> 
                
<div class="row">
<section class="col-lg-12">
<div class="box box-success">
    
<nav class="navbar navbar-dark">
<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link" style="color: green;" href="ms_pemeriksaan.php"><b>PEMERIKSAAN NON PAKET</b></a>
  </li>
  <li class="nav-item">
    <a class="nav-link active" style="color: black;" href="ms_pemeriksaan_paket.php"><b>PEMERIKSAAN PAKET</b></a>
  </li>
  
<button type="button" class="btn btn-success btn-sm pull-right" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus"></i>&nbsp Tambah Data Pemeriksaan</button>
</ul>
</nav>

          <div class="box-body">
<!-- Modal tambah-->
            <form action="ms_pemeriksaan_act.php" method="post" enctype="multipart/form-data">
              <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                        <div class="box box-success">
                          <div class="box-header bg-green">
                              <h3 class="box-title"><i class="fa fa-plus"></i> &nbsp Tambah Data Pemeriksaan</h3></div>
                        </div>
                         
                    <div class="modal-body">

                    <div class="form-group col-lg-6">
                    <div class="form-group">
                        <label>KLASIFIKASI</label>
                        <select name="klasifikasi" class="form-control" required="required">
                            <option value="">- Pilih Klasifikasi -</option>
                            <?php 
                            $klasifikasi = mysqli_query($koneksi,"SELECT * FROM ms_klasifikasi");
                            while($k = mysqli_fetch_array($klasifikasi)){
                            ?>
                            <option <?php if(isset($_GET['klasifikasi'])){ if($_GET['klasifikasi'] == $k['klasifikasi_id']){echo "selected='selected'";}} ?>  value="<?php echo $k['klasifikasi_id']; ?>"><?php echo $k['klasifikasi']; ?></option>
                            <?php 
                            }
                            ?>
                        </select>
                    </div>
                    </div>
                    
                    <div class="form-group col-lg-6">
                    <div class="form-group">
                        <label>SUB KLASIFIKASI</label>
                        <select name="sub_klasifikasi" class="form-control bg-gray">
                            <option value="">- Pilih Sub Klasifikasi -</option>
                            <?php 
                            $subklasifikasi = mysqli_query($koneksi,"SELECT * FROM ms_sub_klasifikasi");
                            while($s = mysqli_fetch_array($subklasifikasi)){
                            ?>
                            <option <?php if(isset($_GET['sub_klasifikasi'])){ if($_GET['sub_klasifikasi'] == $s['sub_klasifikasi_id']){echo "selected='selected'";}} ?>  value="<?php echo $s['sub_klasifikasi']; ?>"><?php echo $s['sub_klasifikasi']; ?></option>
                            <?php 
                            }
                            ?>
                        </select>
                    </div>
                    </div>                    
              
                      <div class="form-group col-lg-6">
                        <label>KODE PEMERIKSAAN</label>
                            <input type="text" name="kode" class="form-control" required="required" placeholder="Masukkan Kode">
                      </div>

                      <div class="form-group col-lg-6">
                        <label>PEMERIKSAAN</label>
                            <input type="text" name="pemeriksaan" class="form-control" required="required" placeholder="Masukkan Nama Pemeriksaan">
                      </div>
                      
                      <div class="form-group col-lg-4">
                        <label>STOK</label>
                            <input type="text" name="stok" class="form-control" required="required" placeholder="Masukkan Stok">
                      </div>
                      
                      <div class="form-group col-lg-4">
                        <label>TARIF</label>
                            <input type="text" name="tarif" class="form-control" required="required" placeholder="Masukkan Tarif">
                      </div> 
                      
                      <div class="form-group col-lg-4">
                        <label>STATUS PAKET</label>
                        <select name="status" style="width:100%" class="form-control bg-orange">
                            <option value="tidak">Tidak</option>
                            <option value="paket">Paket</option>
                        </select>
                      </div>                      
                      
                      <div class="form-group col-lg-12">
                        <label>SATUAN</label>
                            <input type="text" name="satuan" class="form-control" placeholder="Masukkan satuan">
                      </div>

                      <div class="form-group col-lg-12">
                        <label>NILAI NORMAL</label>
                            <textarea name="nilainormal" style="width:100%" class="form-control" rows="4" placeholder="Masukkan Nilai Normal..." value=""></textarea>
                      </div>                      
                      
                    </div>
                    <div class="modal-footer">
                        <center>
                        <button type="submit" class="btn btn-success">Simpan</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        </center>
                    </div>
                  </div>
                </div>
              </div>
            </form>

            <form method="get" action="">
            <div class="form-group col-lg-3">
                <select name="filter" class="form-control bg-gray" required="required" onchange="this.form.submit();">
                <option value="semua">Filter Klasifikasi</option>
                <?php 
                $klasifikasi = mysqli_query($koneksi,"SELECT * FROM ms_klasifikasi");
                while($k = mysqli_fetch_array($klasifikasi)){
                ?>
                <option <?php if(isset($_GET['klasifikasi'])){ if($_GET['klasifikasi'] == $k['klasifikasi_id']){echo "selected='selected'";}} ?>  value="<?php echo $k['klasifikasi_id']; ?>"><?php echo $k['klasifikasi']; ?></option>
                <?php 
                }
                ?>
                </select>
            </div>
            </from>
            
            <div class="table-responsive col-lg-12">
                <table class="table table-bordered table-striped" id="table-datatable">
                <thead>
                  <tr class=bg-olive>
                    <th width="1%" class=text-center>NO</th>
                    <th class=text-center>KODE</th>
                    <th class=text-center>PAKET</th>
                    <th class=text-center>PEMERIKSAAN</th>
                    <th class=text-center>STOK</th>
                    <th class=text-center>TARIF</th>  
                    <th class=text-center width="20%">NILAI NORMAL</th>
                    <th class=text-center width="20%">SATUAN</th>
                    <th class=text-center>STATUS PAKET</th>
                    <th class="text-center" width="8%">OPSI</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  include '../koneksi.php';
                  $no=1;
                    if(isset($_GET['filter'])){ 
                    $filter= $_GET['filter'];                  
                    $data = mysqli_query($koneksi,"SELECT * FROM ms_pemeriksaan,ms_klasifikasi where klasifikasi_id=klasifikasi_pemeriksaan and klasifikasi_pemeriksaan='$filter' AND status='paket' order by kode_urutan ASC");
                    }else{
                    $data = mysqli_query($koneksi,"SELECT * FROM ms_pemeriksaan,ms_klasifikasi where klasifikasi_id=klasifikasi_pemeriksaan AND status='paket' order by kode_urutan ASC");
                    }
                    while($d = mysqli_fetch_array($data)){
                        
                        if($d['status']=='paket')
                        $aksi = "<span style='font-size:10;' class='label label-info'>PAKET</span>";
                        
                        else if($d['status']=='tidak')
                        $aksi = "<span style='font-size:10;' class='label label-success'>TIDAK</span>";  
                        
                        if($d['nilai_normal']=='-')
                        $normal = "<span style='font-size:10;' class='label label-warning'>Klasifikasi Paket</span>";
                        
                        else {
                        $normal = $d['nilai_normal'];
                        }
                    ?>
                    <tr>
                      <td class=text-center><?php echo $no++; ?></td>
                      <td><?php echo $d['kode_urutan']; ?></td>
                      <td><?php echo $d['klasifikasi']; ?><br>
                        <span style="color: RED;"><?php echo $d['sub_klasifikasi']; ?></span></td>
                      <td><?php echo $d['pemeriksaan']; ?></td>
                      <td class="text-center"><?php echo $d['stok']; ?></td>
                      <td class="text-center"><?php echo $d['tarif']; ?></td>
                      <td><?php echo $normal; ?></td>  
                      <td><?php echo $d['satuan']; ?></td>
                      <td class="text-center"><?php echo $aksi; ?></td>
                      <td>    
                      <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit_pemeriksaan_<?php echo $d['pemeriksaan_id'] ?>">
                        <i class="fa fa-pencil"></i>
                      </button>
                      <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapus_pemeriksaan_<?php echo $d['pemeriksaan_id'] ?>">
                        <i class="fa fa-trash"></i>
                      </button>


<!-- modal edit -->
                      <form action="ms_pemeriksaan_update.php" method="post" enctype="multipart/form-data">
                      <div class="modal fade" id="edit_pemeriksaan_<?php echo $d['pemeriksaan_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                              
                        <div class="box box-success">
                          <div class="box-header bg-gray">
                              <h3 class="box-title"><i class="fa fa-server"></i> &nbsp Edit Data Pemeriksaan - <?php echo $d['pemeriksaan']; ?></h3></div>
                        </div>
                            
                            <div class="modal-body">
                                <input type="hidden" name="id" value="<?php echo $d['pemeriksaan_id'] ?>">
                                
                    <div class="form-group col-lg-6 col-xs-6">
                    <div class="form-group">
                        <label>KLASIFIKASI</label>
                        <select name="klasifikasi" style="width:100%" class="form-control" required="required">
                            <option value=""><?php echo $d['klasifikasi']; ?></option> 
                            <?php 
                            $klasifikasi = mysqli_query($koneksi,"SELECT * FROM ms_klasifikasi");
                            while($k = mysqli_fetch_array($klasifikasi)){
                            ?>
                            <option <?php if(isset($_GET['klasifikasi'])){ if($_GET['klasifikasi'] == $k['klasifikasi_id']){echo "selected='selected'";}} ?>  value="<?php echo $k['klasifikasi_id']; ?>"><?php echo $k['klasifikasi']; ?></option>
                            <?php 
                            }
                            ?>
                        </select>
                    </div>
                    </div>
                    
                    <div class="form-group col-lg-6 col-xs-6">
                    <div class="form-group">
                        <label>SUB KLASIFIKASI</label>
                        <select name="sub_klasifikasi" style="width:100%" class="form-control bg-gray">
                            <option value="<?php echo $d['sub_klasifikasi']; ?>"><?php echo $d['sub_klasifikasi']; ?></option>
                            <?php 
                            $subklasifikasi = mysqli_query($koneksi,"SELECT * FROM ms_sub_klasifikasi");
                            while($s = mysqli_fetch_array($subklasifikasi)){
                            ?>
                            <option <?php if(isset($_GET['sub_klasifikasi'])){ if($_GET['sub_klasifikasi'] == $s['sub_klasifikasi_id']){echo "selected='selected'";}} ?>  value="<?php echo $s['sub_klasifikasi']; ?>"><?php echo $s['sub_klasifikasi']; ?></option>
                            <?php 
                            }
                            ?>
                        </select>
                    </div>
                    </div>
                    
                      <div class="form-group col-lg-12 col-xs-12">
                        <hr>
                      </div>                     

                      <div class="form-group col-lg-6 col-xs-6">
                        <label>KODE PEMERIKSAAN</label>
                            <input type="text" name="kode" style="width:100%" class="form-control" required="required" value='<?php echo $d['kode_urutan']; ?>'>
                      </div>

                      <div class="form-group col-lg-6 col-xs-6">
                        <label>PEMERIKSAAN</label>
                            <input type="text" name="pemeriksaan" style="width:100%" class="form-control" required="required" value='<?php echo $d['pemeriksaan']; ?>'>
                      </div>
                      
                      <div class="form-group col-lg-12 col-xs-12">
                        <hr>
                      </div>                      

                      <div class="form-group col-lg-4 col-xs-4">
                         <div class="form-group">
                        <label>STOK</label>
                            <input type="text" name="stok" style="width:100%" class="form-control bg-orange" required="required" value='<?php echo $d['stok']; ?>'>
                        </div>
                      </div>
                      
                      <div class="form-group col-lg-4 col-xs-4">
                        <label>TARIF</label>
                            <input type="text" name="tarif" style="width:100%" class="form-control bg-orange" required="required" value='<?php echo $d['tarif']; ?>'>
                      </div>
                      
                      <div class="form-group col-lg-4 col-xs-4">
                        <label>STATUS PAKET</label>
                        <select name="status" style="width:100%" class="form-control bg-orange">
                            <option value="<?php echo $d['status']; ?>"><?php echo $d['status']; ?></option>
                            <option value="tidak">Tidak</option>
                            <option value="paket">Paket</option>
                        </select>
                      </div>                      
                      
                      <div class="form-group col-lg-12 col-xs-12">
                          <label>SATUAN</label>
                        <input type="text" name="satuan" style="width:100%" class="form-control" value='<?php echo $d['satuan']; ?>'>
                      </div>                      
                      
                      <div class="form-group col-lg-12 col-xs-12">
                        <label>NILAI NORMAL</label>
                            <textarea name="nilainormal" style="width:100%" class="form-control" rows="2" placeholder="Masukkan Nama Nilai Normal..."><?php echo $d['nilai_normal']; ?></textarea>
                      </div>
                      
                      <div class="form-group col-lg-12">
                          <label> </label>
                      </div>                       
                      
                    </div>
                    <div class="modal-footer">
                        <center>
                        <button type="submit" class="btn btn-success">Simpan</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        </center>
                    </div>
                            
                          </div>
                        </div>
                      </div>
                    </form> 


<!-- modal hapus -->
                      <div class="modal fade" id="hapus_pemeriksaan_<?php echo $d['pemeriksaan_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                        <div class="box box-success">
                          <div class="box-header bg-green">
                              <h3 class="box-title"><i class="fa fa-trash"></i> &nbsp Peringatan !!!</h3></div>
                        </div>
                            <div class="modal-body">

                              <p>yakin ingin menghapus <b><?php echo $d['pemeriksaan'] ?></b>?</p>

                            </div>
                            <div class="modal-footer">
                              <a href="ms_pemeriksaan_hapus.php?id=<?php echo $d['pemeriksaan_id'] ?>" class="btn btn-danger">Hapus</a>
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            </div>
                          </div>
                        </div>
                      </div>

                    </td>
                    </tr>    
                  <?php 
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>

      </div>
    </section>
  </div>

</section>

</div>

<?php include 'footer.php'; ?>