<?php 
include("koneksi.php"); 
// query untuk menampilkan data 
$sql = 'SELECT * FROM data_barang'; 
$result = mysqli_query($conn, $sql); 
?> 
<!DOCTYPE html> 
<html lang="en"> 
<head>
<meta charset="UTF-8"> 
<link href="style.css" rel="stylesheet" type="text/css"/> 
<title>Data Barang</title> 
</head> 
<body> 
<div class="container"> 
<h1>Data Barang</h1> 
<div class="main"> 
<li><a href='tambah.php'>Tambah barang</a></li>
<table> 
<tr> 
<th>Gambar</th> 
<th>Nama Barang</th> 
<th>Katagori</th> 
<th>Harga Jual</th> 
<th>Harga Beli</th> 
<th>Stok</th> 
<th>Aksi</th> 
</tr> 
<?php if($result): ?> 
<?php while($row = mysqli_fetch_array($result)): ?> 
<tr> 
<td><img src="gambar/<?= $row['gambar'];?>" alt="<?= $row['nama'];?>"></td> 
<td><?= $row['nama'];?></td> 
<td><?= $row['kategori'];?></td> 
<td><?= $row['harga_beli'];?></td> 
<td><?= $row['harga_jual'];?></td> 
<td><?= $row['stok'];?></td> 
<td><?= $row['id_barang'];?></td> 
<td><li><a href='ubah.php'>Ubah</a></li><a href='hapus.php'>Hapus</a></td>
</tr> 
<?php endwhile; else: ?> 
<tr> 
<td colspan="7">Belum ada data</td> 
</tr> 
<?php endif; 
?> 
</table> 
</div> 
</div> 
</body> 
</html>