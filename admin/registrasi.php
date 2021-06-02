        <div class="row">
          <div class="col s12 m9">
            <h3 class="blue-text">Masyarakat</h3>
          </div>  
          <div class="col s12 m3">
            <div class="section"></div>
            <a class="waves-effect waves-light btn modal-trigger blue" href="#modal1">Registrasi</a>
          </div>
        </div>

        <table id="example" class="display responsive-table striped highlight" style="width:100%">
          <thead>
              <tr>
					<th>#</th>
					<th>NISN</th>
					<th>Nama</th>
					<th>Username</th>
					<th>Telp</th>
                	<th>Aksi</th>
              </tr>
          </thead>
          <tbody>
            
	<?php 
		$no=1;
		$query = mysqli_query($koneksi,"SELECT * FROM siswa ORDER BY nisn ASC");
		while ($r=mysqli_fetch_assoc($query)) { ?>
		<tr>
			<td><?= $no++; ?></td>
			<td><?= $r['nisn']; ?></td>
			<td><?= $r['nama']; ?></td>
			<td><?= $r['username']; ?></td>
			<td><?= $r['telp']; ?></td>
			<td>
				<a class="btn blue modal-trigger" href="#regis_edit?nisn=<?php echo $r['nisn'] ?>">Edit</a> 
				<a onclick="return confirm('Anda Yakin Ingin Menghapus')" class="btn red" href="index.php?p=regis_hapus&nisn=<?php echo $r['nisn'] ?>">Hapus</a>
			</td>

<!-- edit data registrasi -->
        <div id="regis_edit?nisn=<?php echo $r['nisn'] ?>" class="modal">
          <div class="modal-content">
            <h4>Edit</h4>
			<form method="POST">
				<div class="col s12 input-field">
					<label for="nisn">NISN</label>
					<input id="nisn" type="number" name="nisn" value="<?= $r['nisn']; ?>">
				</div>
				<div class="col s12 input-field">
					<label for="nama">Nama</label>
					<input id="nama" type="text" name="nama" value="<?= $r['nama']; ?>">
				</div>
				<div class="col s12 input-field">
					<label for="username">Username</label>		
					<input id="username" type="text" name="username" value="<?= $r['username']; ?>"><br><br>
				</div>
				<div class="col s12 input-field">
					<label for="telp">Telp</label>
					<input id="telp" type="number" name="telp" value="<?= $r['telp']; ?>"><br><br>
				</div>
				<div class="col s12 input-field">
					<input type="submit" name="Update" value="Simpan" class="btn left">
				</div>
			</form>

			<?php 
				if(isset($_POST['Update'])){
					$update=mysqli_query($koneksi,"UPDATE siswa SET nisn='".$_POST['nisn']."',nama='".$_POST['nama']."',username='".$_POST['username']."',telp='".$_POST['telp']."' WHERE nisn='".$r['nisn']."' ");
					if($update){
						echo "<script>alert('Data Tersimpan')</script>";
						echo "<script>location='location:index.php?p=registrasi';</script>";
					}
				}
			 ?>
          </div>
          <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Close</a>
          </div>
        </div>
<!-- ------------------------------------------------------------------------------------------------------------------------------------ -->

		</tr>
            <?php  }
             ?>

          </tbody>
        </table>        

        <!-- REGISTRASI SISWA -->
        <div id="modal1" class="modal">
          <div class="modal-content">
            <b><h4>REGISTRASI SISWA</h4></b>
			<form method="POST">
				<div class="col s12 input-field">
					<label for="nisn">NISN</label>
					<input id="nisn" type="number" name="nisn">
				</div>
				<div class="col s12 input-field">
					<label for="nama">Nama</label>
					<input id="nama" type="text" name="nama">
				</div>
				<div class="col s12 input-field">
					<label for="username">Username</label>		
					<input id="username" type="text" name="username"><br><br>
				</div>
				<div class="col s12 input-field">
					<label for="password">Password</label>
					<input id="password" type="password" name="password"><br><br>
				</div>
				<div class="col s12 input-field">
					<label for="telp">Telp</label>
					<input id="telp" type="number" name="telp"><br><br>
				</div>
				<div class="col s12 input-field">
					<i>	<input type="submit" name="simpan" value="Simpan" class="btn modal-trigger blue lighten-1 left"></i>	
				</div>
			</form>

			<?php 
				if(isset($_POST['simpan'])){
					$password = md5($_POST['password']);

					$query=mysqli_query($koneksi,"INSERT INTO siswa VALUES ('".$_POST['nisn']."','".$_POST['nama']."','".$_POST['username']."','".$password."','".$_POST['telp']."')");
					if($query){
						echo "<script>alert('Data Tesimpan')</script>";
						echo "<script>location='location:index.php?p=registrasi';</script>";
					}
				}
			 ?>
          </div>
          <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Close</a>
          </div>
        </div>