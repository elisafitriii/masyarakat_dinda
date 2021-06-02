        <div class="row">
          <div class="col s12 m9">
            <h3 class="blue-text">Respon</h3>
          </div>
        </div>

        <table id="example" class="display responsive-table striped highlight" style="width:100%">
          <thead>
              <tr>
				<th>#</th>
				<th>NISN</th>
				<th>Nama</th>
				<th>Petugas</th>
				<th>Tanggal Masuk</th>
				<th>Tanggal Ditanggapi</th>
				<th>Status</th>
				<th>Aksi</th>
              </tr>
          </thead>
          <tbody>
            
	<?php 
		$no=1;
		$query = mysqli_query($koneksi,"SELECT * FROM pengaduan INNER JOIN siswa ON pengaduan.nisn=siswa.nisn INNER JOIN tanggapan ON pengaduan.id_pengaduan=tanggapan.id_pengaduan INNER JOIN petugas ON tanggapan.id_petugas=petugas.id_petugas WHERE tanggapan.id_petugas='".$_SESSION['data']['id_petugas']."' ORDER BY tanggapan.id_pengaduan DESC");
		while ($r=mysqli_fetch_assoc($query)) { ?>
		<tr>
			<td><?php echo $no++; ?></td>
			<td><?php echo $r['nisn']; ?></td>
			<td><?php echo $r['nama']; ?></td>
			<td><?php echo $r['nama_petugas']; ?></td>
			<td><?php echo $r['tgl_pengaduan']; ?></td>
			<td><?php echo $r['tgl_tanggapan']; ?></td>
			<td><?php echo $r['status']; ?></td>
			<td>
				<a class="btn blue modal-trigger" href="#more?id_tanggapan=<?php echo $r['id_tanggapan'] ?>">Lihat</a>
			 <a class="btn red" onclick="return confirm('Anda Yakin Ingin Menghapus ')" href="index.php?p=tanggapan_hapus&id_tanggapan=<?php echo $r['id_tanggapan'] ?>">Hapus</a></td>
		

<!-- detail -->
        <div id="more?id_tanggapan=<?php echo $r['id_tanggapan'] ?>" class="modal">
          <div class="modal-content">
            <h4 class="blue-text">Detail</h4>
            <div class="col s12">
				<p> <b>NISN :</b>  <?php echo $r['nisn']; ?></p>
            	<p><b>Dari :</b> <?php echo $r['nama']; ?></p>
            	<p><b>Petugas :</b> <?php echo $r['nama_petugas']; ?></p>
				<p><b>tanggal masuk :</b> <?php echo $r['tgl_pengaduan']; ?></p>
				<p><b>tanggal ditanggapi :</b> <?php echo $r['tgl_tanggapan']; ?></p>
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
<!-- ------------------------------------------------------------------------------------------------------------------------------------ -->

		</tr>
            <?php  }
             ?>

          </tbody>
        </table>        