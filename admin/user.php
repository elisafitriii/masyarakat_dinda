        <div class="row">
          <div class="col s12 m9">
            <h3 class="blue-text">Petugas/Admin</h3>
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
				<th>Nama</th>
				<th>Username</th>
				<th>Telephone</th>
				<th>level</th>
				<th>Aksi</th>
              </tr>
          </thead>
          <tbody>
            
	<?php 
		$no=1;
		$tampil = mysqli_query($koneksi,"SELECT * FROM petugas ORDER BY nama_petugas ASC");
		while ($r=mysqli_fetch_assoc($tampil)) { ?>
		<tr>
			<td><?=$no++; ?></td>
			<td><?= $r['nama_petugas']; ?></td>
			<td><?= $r['username']; ?></td>
			<td><?= $r['telp']; ?></td>
			<td><?= $r['level']; ?></td>
			<td><a class="btn blue modal-trigger" href="#user_edit<?= $r['id_petugas'] ?>">Edit</a> <a class="red btn" onclick="return confirm('Anda Yakin Ingin Menghapus Y/N')" href="index.php?p=user_hapus&id_petugas=<?php echo $r['id_petugas'] ?>">Hapus</a></td>

<!-- edit data -->
        <div id="user_edit<?php echo $r['id_petugas'] ?>" class="modal">
          <div class="modal-content">
            <h4>Edit</h4>
			<form method="POST">
				<div class="col s12 input-field">
					<label for="nama">Nama</label>
					<input hidden type="text" name="id_petugas" value="<?php echo $r['id_petugas']; ?>">
					<input id="nama" type="text" name="nama" value="<?php echo $r['nama_petugas']; ?>">
				</div>
				<div class="col s12 input-field">
					<label for="username">Username</label>		
					<input id="username" type="text" name="username" value="<?php echo $r['username']; ?>"><br><br>
				</div>
				<div class="col s12 input-field">
					<label for="telp">Telp</label>
					<input id="telp" type="number" name="telp" value="<?php echo $r['telp']; ?>"><br><br>
				</div>
				<div class="col s12 input-field">
					<p>
						<label>
						  <input value="admin" class="with-gap" name="level" type="radio" <?php if($r['level']=="admin"){echo "checked";} ?> />
						  <span>Admin</span>
						</label>
						<label>
						  <input value="petugas" class="with-gap" name="level" type="radio" <?php if($r['level']=="petugas"){echo "checked";} ?> />
						  <span>Petugas</span>
						</label>
					</p>
				</div>
				<div class="col s12 input-field">
					<input type="submit" name="Update" value="Simpan" class="btn modal-trigger blue lighten-1 left">
				</div>
			</form>

			<?php 
				if(isset($_POST['Update'])){
					// echo $_POST['nama'].$_POST['username'].$_POST['telp'].$_POST['level'];
					$update=mysqli_query($koneksi,"UPDATE petugas SET nama_petugas='".$_POST['nama']."',username='".$_POST['username']."',telp='".$_POST['telp']."',level='".$_POST['level']."' WHERE id_petugas='".$_POST['id_petugas']."' ");
					if($update){
						echo "<script>alert('Data di Update')</script>";
						echo "<script>location='index.php?p=user'</script>";
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

  <!-- tambah petugas -->
        <div id="modal1" class="modal">
          <div class="modal-content">
            <h4>REGISTRASI PETUGAS</h4>
			<form method="POST">
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
					<input type="submit" name="input" value="Simpan" class="btn modal-trigger blue lighten-1 left">
				</div>
			</form>

			<?php 
				if(isset($_POST['input'])){
					$password = md5($_POST['password']);

					$query=mysqli_query($koneksi,"INSERT INTO petugas VALUES (NULL,'".$_POST['nama']."','".$_POST['username']."','".$password."','".$_POST['telp']."','petugas')");
					if($query){
						echo "<script>alert('Data Ditambahkan')</script>";
						echo "<script>location='index.php?p=user'</script>";
					}
				}
			 ?>
          </div>
          <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Close</a>
          </div>
        </div>