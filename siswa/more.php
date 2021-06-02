<?php 
	
	if($_GET['apa']=="pengaduan"){ ?>

<?php 
	$query = mysqli_query($koneksi,"SELECT * FROM pengaduan INNER JOIN siswa ON pengaduan.nisn=siswa.nisn WHERE id_pengaduan='".$_GET['id_pengaduan']."'");
	$r=mysqli_fetch_assoc($query);
 ?>
<b>Di Laporakan Pada : <?= $r['tgl_pengaduan']; ?></b><br>

<?php 
	if($r['foto']=="kosong"){ ?>
		<img src="../img/noImage.png" width="100">
<?php	}else{ ?>
	<img width="100" src="../img/<?= $r['foto']; ?>">
<?php }
 ?>


<p><?= $r['isi_laporan']; ?></p>
<p> <b> Status :</b> <?= $r['status']; ?></p>

<button><a href="index.php?p=dashboard">Back</a></button>

<?php	}elseif ($_GET['apa']=="tanggapan") { ?>

<?php 
	$query = mysqli_query($koneksi,"SELECT * FROM pengaduan INNER JOIN siswa ON pengaduan.nisn=siswa.nisn INNER JOIN tanggapan ON pengaduan.id_pengaduan=tanggapan.id_pengaduan INNER JOIN petugas ON tanggapan.id_petugas=petugas.id_petugas WHERE tanggapan.id_pengaduan='".$_GET['id_pengaduan']."'");
	$r=mysqli_fetch_assoc($query);
 ?>
<h2>Petugas <?= $r['nama_petugas']; ?></h2>
<b>Ditanggapi pada :<?= $r['tgl_tanggapan']; ?></b><br>
<?php 
	if($r['foto']=="kosong"){ ?>
		<img src="../img/noImage.png" width="100">
<?php	}else{ ?>
	<img width="100" src="../img/<?= $r['foto']; ?>">
<?php }
 ?>
<p><?= $r['isi_laporan']; ?></p>
<p><?= $r['tanggapan']; ?></p>
<p> <b>Status :</b>  <?= $r['status']; ?></p>

<button><a href="index.php?p=dashboard">Back</a></button>

<?php } ?>