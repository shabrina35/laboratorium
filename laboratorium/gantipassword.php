<?php include 'header.php'; ?>

<div class="content-wrapper bg-gray">

  <section class="content">
    <div class="row">
      <section class="col-lg-12">

        <?php 
        if(isset($_GET['alert'])){
          if($_GET['alert'] == "sukses"){
            echo "<div class='alert alert-success'>Password anda berhasil diganti!</div>";
          }
        }
        ?>

        <div class="box box-success">
            <div class="box-header bg-green">
            <h3 class="box-title"><i class="fa fa-lock"></i>&nbsp Ganti Password</h3>
            </div>
          <div class="box-body">
            <form action="gantipassword_act.php" method="post">
              <div class="form-group">
                <label>Masukkan Password Baru</label>
                <input type="password" class="form-control" placeholder="Masukkan Password Baru .." name="password" required="required" min="5">
              </div>
              <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Simpan">
                <a href="logout.php" class="btn btn-danger">Logout</a>
                <a href="index.php" class="btn btn-success">Kembali</a>
              </div>
            </form>
          </div>

        </div>
      </section>
    </div>
  </section>

</div>
<?php include 'footer.php'; ?>