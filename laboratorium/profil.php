<?php include 'header.php'; ?>

<div class="content-wrapper">

  <section class="content-header">
  </section>

            <div class="form-group">
            <?php 
                if(isset($_GET['alert'])){
                  if($_GET['alert']=='gagal'){
                    ?>
                    <div class="alert alert-danger alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                      <h4><i class="icon fa fa-warning"></i> Peringatan !</h4>
                      Format foto salah, harap upload foto format JPG/GIF/PNG/JPEG !!!
                    </div>	
                    
                    <?php                    
                  }elseif($_GET['alert']=="belum"){
                    ?>
                    <div class="alert alert-success alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                      <h4><i class="icon fa fa-check"></i> Peringatan !</h4>
                      Belum ada perubahan yang tersimpan
                    </div>
                    
                    <?php
                  }elseif($_GET['alert']=="user"){
                    ?>
                    <div class="alert alert-success alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                      <h4><i class="icon fa fa-check"></i> Success !</h4>
                      data USER NAME berhasil di UPDATE !!
                    </div>
                    
                    <?php
                  }elseif($_GET['alert']=="password"){
                    ?>
                    <div class="alert alert-success alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                      <h4><i class="icon fa fa-check"></i> Success !</h4>
                      PASSWORD berhasil di UPDATE !!
                    </div>
                    
                    <?php
                  }elseif($_GET['alert']=="foto"){
                    ?>
                    <div class="alert alert-success alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                      <h4><i class="icon fa fa-check"></i> Success !</h4>
                      Foto Profil berhasil di UPDATE !!
                    </div>                     
                   
                    <?php                    
                  }elseif($_GET['alert']=="sukses"){
                    ?>
                    <div class="alert alert-success alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                      <h4><i class="icon fa fa-check"></i> Success</h4>
                      Profil Berhasil Di Update
                    </div>
                    <?php
                  }
                }
                ?>
            </div>
      
<!-- Modal edit -->
            <form action="profil_update.php" method="post" enctype="multipart/form-data">
              <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="box box-success">  
                    <div class="box-header bg-gray">
                          <h3 class="box-title"><i class="fa fa-user"></i>&nbsp Profil</h3>
                    </div>
                    </div>
                    <div class="modal-body">
                        
                    <input type="hidden" name="id" value="<?php echo $_SESSION['id']; ?>" required="required">
                    <input type="hidden" name="level" value="<?php echo $_SESSION['level']; ?>" required="required">

                    
                <div class="form-group">
                        <label>NAMA</label>
                        <input type="text" name="nama" required="required" value="<?php echo $_SESSION['nama']; ?>" class="form-control">
                      </div>
                      
                <div class="form-group">
                        <label>USER NAME</label>
                        <input type="text" name="username" value="" class="form-control" placeholder="<?php echo $_SESSION['username']; ?>">
                      </div>
                      
                <div class="form-group">
                        <label>PASSWORD</label>
                        <input type="text" name="password" value="" class="form-control" placeholder="<?php echo $_SESSION['password']; ?>">
                      </div>                      

                <div class="form-group has-feedback">
                    <label><b>FOTO PROFIL</b></label>
                    <input type="file" name="foto" class="form-control bg-yellow">
                    <span class="glyphicon glyphicon-camera form-control-feedback"></span>                    
                    </div>

                    <input type="hidden" name="rekening" value="<?php echo $_SESSION['rekening']; ?>" class="form-control" readonly>


                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                    </div>
                  </div>
                </div>
              </div>
            </form>


<!-- kolom 1 -->
  <section class="content bg-gray">
    <div class="row">
      <section class="col-lg-12">
        <div class="box box-success">
            <div class="box-header bg-green">
            <h3 class="box-title"><i class="fa fa-user"></i>&nbsp Data Pengguna</h3></div>
            <div class="box-body">
            <center>
                        <!--menganbil foto profil -->
                        <?php 
                        $id_user = $_SESSION['id'];
                        $profil = mysqli_query($koneksi,"select * from user where user_id='$id_user'");
                        $profil = mysqli_fetch_assoc($profil);
                        if($profil['user_foto'] == ""){ 
                        ?>
                        <img src="../gambar/sistem/user.png" width="105">
                        <?php }else{ ?>
                        <img src="../gambar/user/<?php echo $profil['user_foto'] ?>" width="105">
                        <?php } ?>
                        
                        <br>
                        <b><?php echo $_SESSION['nama']; ?></b>
                        <br>
                        JL A. Yani, No.177, Bangunsari
                        <br>
                        Caruban, Madiun, Jawa Timur 63153
                        <br>
                        (0351) 386228 CARUBAN
            </center>            
          </div>
        </div>  
       </section>
    </div>
  </section> 
  
<!-- kolom 2 -->  
 <section class="content">
    <div class="row">
      <section class="col-lg-12">
        <div class="box box-success">
          <div class="box-body">
              <center><h4 class="box-title"><b> INFORMASI LOGIN </b></h4></center>
              <div class="box box-success">
            <div class="table-responsive">
              <table class="table table-bordered">
                <thead>
                  <tr class=bg-olive>
                    <th><center>NAMA</th>
                    <th><center>USER NAME</th>
                    <th><center>PASSWORD</th>
                    <th><center>ACTION</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  include '../koneksi.php';
                  $no=1;
                  $akun=$_SESSION['nama'];
                  $data = mysqli_query($koneksi,"SELECT * FROM user WHERE user_nama='$akun'");
                  while($d = mysqli_fetch_array($data)){
                    ?>
                    <tr>
                      <td><center><?php echo $d['user_nama']; ?></td>
                      <td><center><?php echo $d['user_username']; ?></td>
                      <td><center><?php echo $d['user_password']; ?></td>
                      <td><center><button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-pencil"></i></button>
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
  

<!-- kolom 3 -->  
</div>
<?php include 'footer.php'; ?>