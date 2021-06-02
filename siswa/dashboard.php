<table class="responsive-table" border="2" style="width: 100%;">
	<tr>
		<td><h4 class="blue-text hide-on-med-and-down">Tulis Laporan</h4></td>
		<td><h4 class="blue-text hide-on-med-and-down">Daftar Laporan</h4></td>
	</tr>
	<tr>
		<td style="padding: 20px;">
			<form method="POST" enctype="multipart/form-data">
				<textarea class="materialize-textarea" name="laporan" placeholder="Tulis Laporan"></textarea><br><br>
				<label>Gambar</label>
				<input type="file" name="foto"><br><br>
				<input type="submit" name="kirim" value="Kirim" class="btn blue">
			</form>
		</td>

		<td>
			
			<table border = "3" class=" display responsive-table ">
				<tr>
					<td>No</td>
					<td>NIK</td>
					<td>Nama</td>
					<td>Tanggal Masuk</td>
					<td>Status</td>
					<td>Aksi</td>
				</tr>
				<?php 
					$no=1;
					$pengaduan = mysqli_query($koneksi,"SELECT * FROM pengaduan INNER JOIN siswa ON pengaduan.nisn=siswa.nisn INNER JOIN tanggapan ON pengaduan.id_pengaduan=tanggapan.id_pengaduan WHERE pengaduan.nisn='".$_SESSION['data']['nisn']."' ORDER BY pengaduan.id_pengaduan DESC");
					while ($r=mysqli_fetch_assoc($pengaduan)) { ?>
					<tr>
						<td><?php echo $no++; ?></td>
						<td><?php echo $r['nisn']; ?></td>
						<td><?php echo $r['nama']; ?></td>
						<td><?php echo $r['tgl_pengaduan']; ?></td>
						<td><?php echo $r['status']; ?></td>
						<td>
							<a class="btn blue modal-trigger" href="#tanggapan&id_pengaduan=<?php echo $r['id_pengaduan'] ?>">lihat</a> 
							<a class="btn red" onclick="return confirm('Anda Yakin Ingin Menghapus ')" href="index.php?p=pengaduan_hapus&id_pengaduan=<?php echo $r['id_pengaduan'] ?>">Hapus</a></td>

<!-- ditanggapi -->
        <div id="tanggapan&id_pengaduan=<?php echo $r['id_pengaduan'] ?>" class="modal">
          <div class="modal-content">
            <h4 class="blue-text">Detail</h4>
            <div class="col s12">
				<p> <b>NISN :</b> <?php echo $r['nisn']; ?></p>
            	<p> <b>Dari :</b>  <?php echo $r['nama']; ?></p>
            	<p> <b>Petugas :</b>  <?php echo $r['nama_petugas']; ?></p>
				<p> <b>Tanggal Masuk :</b>  <?php echo $r['tgl_pengaduan']; ?></p>
				<p> <b>Tanggal Ditanggapi :</b>  <?php echo $r['tgl_tanggapan']; ?></p>
				<?php 
					if($r['foto']=="kosong"){ ?>
						<img src="../img/noImage.png" width="100">
				<?php	}else{ ?>
					<img width="100" src="../img/<?php echo $r['foto']; ?>">
				<?php }
				 ?>
				<br><b>Pesan</b>
				<p><?php echo $r['isi_laporan']; ?></p>
				<br><b>Respon</b>
				<p><?php echo $r['tanggapan']; ?></p>
            </div>

          </div>
          <div class="modal-footer col s12">
            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Close</a>
          </div>
        </div>
<!-- ditanggapi -->

					</tr>
				<?php	}
				 ?>
			</table>

		</td>
	</tr>
</table>
<?php 
	
	 if(isset($_POST['kirim'])){
	 	$nisn = $_SESSION['data']['nisn'];
	 	$tgl = date('Y-m-d');


	 	$foto = $_FILES['foto']['name'];
	 	$source = $_FILES['foto']['tmp_name'];
	 	$folder = './../img/';
	 	$listeks = array('jpg','png','jpeg');
	 	$pecah = explode('.', $foto);
	 	$eks = $pecah['1'];
	 	$size = $_FILES['foto']['size'];
	 	$nama = date('dmYis').$foto;

		if($foto !=""){
		 	if(in_array($eks, $listeks)){
		 		if($size<=100000){
					move_uploaded_file($source, $folder.$nama);
					$query = mysqli_query($koneksi,"INSERT INTO pengaduan VALUES (NULL,'$tgl','$nisn','".$_POST['laporan']."','$nama','proses')");

		 			if($query){
			 			echo "<script>alert('Pengaduan Akan Segera di Proses')</script>";
			 			echo "<script>location='index.php';</script>";
		 			}

		 		}
		 		else{
		 			echo "<script>alert('Akuran Gambar Tidak Lebih Dari 100KB')</script>";
		 		}
		 	}
		 	else{
		 		echo "<script>alert('Format File Tidak Di Dukung')</script>";
		 	}
		}
		else{
			$query = mysqli_query($koneksi,"INSERT INTO pengaduan VALUES (NULL,'$tgl','$nisn','".$_POST['laporan']."','noImage.png','proses')");
			if($query){
			 	echo "<script>alert('Pengaduan Akan Segera Ditanggapi')</script>";
	 			echo "<script>location='index.php';</script>";
 			}
		}

	 }

 ?>