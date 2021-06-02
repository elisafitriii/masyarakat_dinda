        <div class="row">
          <div class="col s12 m9">
            <h3 class="blue-text">Pengaduan</h3>
          </div>
        </div>

        <table id="example" class="display responsive-table striped highlight" style="width:100%">
          <thead>
              <tr>
				<th>#</th>
				<th>NISN</th>
				<th>Nama</th>
				<th>Tanggal Masuk</th>
				<th>Status</th>
				<th>Aksi</th>
              </tr>
          </thead>
          <tbody>
            
	<?php 
		$no=1;
		$query = mysqli_query($koneksi,"SELECT * FROM pengaduan INNER JOIN siswa ON pengaduan.nisn=siswa.nisn WHERE pengaduan.status='proses' ORDER BY pengaduan.id_pengaduan DESC");
		while ($r=mysqli_fetch_assoc($query)) { ?>
		<tr>
			<td><?php echo $no++; ?></td>
			<td><?php echo $r['nisn']; ?></td>
			<td><?php echo $r['nama']; ?></td>
			<td><?php echo $r['tgl_pengaduan']; ?></td>
			<td><?php echo $r['status']; ?></td>
			<td><a class="btn modal-trigger blue" href="#more?id_pengaduan=<?php echo $r['id_pengaduan'] ?>">Lihat</a>  
			<a class="btn red" onclick="return confirm('Anda Yakin Ingin Menghapus ')" href="index.php?p=pengaduan_hapus&id_pengaduan=<?php echo $r['id_pengaduan'] ?>">Hapus</a></td>

<!-- detail -->
        <div id="more?id_pengaduan=<?php echo $r['id_pengaduan'] ?>" class="modal">
          <div class="modal-content">
            <h4 class="blue-text">Detail</h4>
            <div class="col s12 m6">
				<p> <b>NISN :</b>  <?php echo $r['nisn']; ?></p>
            	<p> <b>Dari :</b>  <?php echo $r['nama']; ?></p>
				<p> <b>Tanggal Masuk :</b>  <?php echo $r['tgl_pengaduan']; ?></p>
				<?php 
					if($r['foto']=="kosong"){ ?>
						<img src="../img/noImage.png" width="100">
				<?php	}else{ ?>
					<img width="100" src="../img/<?php echo $r['foto']; ?>">
				<?php }
				 ?>
				<br><b>Pesan</b>
				<p><?php echo $r['isi_laporan']; ?></p>
				<p>Status : <?php echo $r['status']; ?></p>
            </div>
            <?php 
            	if($r['status']=="proses"){ ?>
	            <div class="col s12 m6">
					<form method="POST">
						<div class="col s12 input-field">
							<label for="textarea">Tanggapan</label>
							<textarea id="textarea" name="tanggapan" class="materialize-textarea"></textarea>
						</div>
						<div class="col s12 input-field">
							<input type="submit" name="tanggapi" value="Kirim" class="btn modal-trigger blue lighten-1 left">
						</div>
					</form>
	            </div>
            <?php	}
             ?>

			<?php 
				if(isset($_POST['tanggapi'])){
					$tgl = date('Y-m-d');
					$query = mysqli_query($koneksi,"INSERT INTO tanggapan VALUES (NULL,'".$r['id_pengaduan']."','".$tgl."','".$_POST['tanggapan']."','".$_SESSION['data']['id_petugas']."')");
					if($query){
						$update=mysqli_query($koneksi,"UPDATE pengaduan SET status='selesai' WHERE id_pengaduan='".$r['id_pengaduan']."'");
						if($update){
							echo "<script>alert('Tanggapan Terkirim')</script>";
							echo "<script>location='index.php?p=pengaduan';</script>";
						}
					}
				}
			 ?>
          </div>
          <div class="modal-footer col s12">
            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Close</a>
          </div>
        </div>
<!-- ------------------------------------------------------------------------------------------------------------------------------------ -->

		</tr>
            <?php  }
             ?>

          </tbody>
        </table>        