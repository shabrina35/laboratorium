<?php include 'header.php'; ?>

<div class="content-wrapper">
<title>INPUT DATA STOK</title>

  <section class="content">
    <div class="row">
      <section class="col-lg-12">
        <div class="box box-success">
          <div class="box-header bg-gray">
            <h3 class="box-title">Tambah Bahan Pemeriksaan</h3>
          </div>
          <div class="box-body">
            <form method="get" action="">
              <div class="row">
                <div class="col-md-4">

                  <div class="form-group">
                    <label>NAMA BAHAN PEMERIKSAAN</label>
                    <input autocomplete="off" type="text" name="bahan" class="form-control" placeholder="Input Nama Bahan Pemeriksaan..">
                  </div>

                </div>

                <div class="col-md-4">

                  <div class="form-group">
                    <label>SPESIFIKASI BAHAN PEMERIKSAAN</label>
                    <input autocomplete="off" type="text" name="bahan" class="form-control" placeholder="Input Spesifikasi Bahan Pemeriksaan..">
                  </div>

                </div>

                <div class="col-md-4">

                  <div class="form-group">
                    <label>AKSI</label>
                    <input type="submit" value="Tambah Bahan" class="btn btn-sm btn-success btn-block">
                  </div>

                </div>
              </div>
            </form>
          </div>
        </div>

        <div class="box box-success">
          <div class="box-header">
            <h5 class="box-title">Input Data Stok</h5>
          </div>            
          <div class="box-body">

              <div class="table-responsive">
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th width="1%">NO</th>
                      <th class="text-center">NAMA BAHAN</th>
                      <th class="text-center">SPESIFIKASI BAHAN</th>
                      <th class="text-center">QTY MASUK</th>
                      <th class="text-center">QTY KELUAR</th>
                      <th class="text-center">OPSI</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    include '../koneksi.php';
                    $no=1;
                    $data = mysqli_query($koneksi,"SELECT * FROM ms_stok");
                    while($d = mysqli_fetch_array($data)){
                    ?>
                      
                      <tr>
                        <td class="text-center"><?php echo $no++; ?></td>
                        <td><?php echo $d['nama_bahan']; ?></td>
                        <td class="text-center"><?php echo $d['spesifikasi_bahan']; ?></td>
                        <td><input autocomplete="off" type="text" name="masuk" class="form-control"></td>
                        <td><input autocomplete="off" type="text" name="keluar" class="form-control"></td>
                        <td></td>
                      </tr>
                      <?php  } ?>
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