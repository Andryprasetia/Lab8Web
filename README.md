# Pemograman Web
~~~
Nama  : Andry Prasetia Perdana
NIM   : 311910284
Kelas : TI19C1
~~~
# Langkah Pertama
buka xampp dan buat data base "Latihan1", kemudian masukan source berikut
![Screenshot (127)](https://user-images.githubusercontent.com/81818989/120888586-3d53f700-c623-11eb-82b3-02ebec9d78a3.png)

# Langkah Kedua
tambahkan data di cmd
~~~
INSERT INTO data_barang (kategori, nama, gambar, harga_beli, harga_jual, stok) VALUES ('Elektronik', 'HP Samsung Android', 'hp_samsung.jpg', 2000000, 2400000, 5), ('Elektronik', 'HP Xiaomi Android', 'hp_xiaomi.jpg', 1000000, 1400000, 5), ('Elektronik', 'HP OPPO Android', 'hp_oppo.jpg', 1800000, 2300000, 5);
~~~
![Screenshot (129)](https://user-images.githubusercontent.com/81818989/120888729-3083d300-c624-11eb-8d87-6ab61c31b5e0.png)
![Screenshot (130)](https://user-images.githubusercontent.com/81818989/120888730-31b50000-c624-11eb-837d-02a8cb27973e.png)
Setelah berhasil maka data tersebut akan masuk ke database latihan 1 tadi
![Screenshot (131)](https://user-images.githubusercontent.com/81818989/120888739-3974a480-c624-11eb-9fce-d445f9c9d291.png)
# Langkah Ketiga
Buat folder lab8_php_database pada root directory web server (d:\xampp\htdocs)
![Screenshot (132)](https://user-images.githubusercontent.com/81818989/120888754-4beede00-c624-11eb-95c2-3c8ac5d498ed.png)
Kemudian untuk mengakses direktory tersebut pada web server dengan mengakses URL: http://localhost/lab8_php_database/
![Screenshot (133)](https://user-images.githubusercontent.com/81818989/120888790-79d42280-c624-11eb-8676-70a95ea6d8cf.png)
# Langkah Keempat
Buat file baru dengan nama koneksi.php
~~~
<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "latihan1";

$conn = mysqli_connect($host, $user, $pass, $db);
if ($conn == false){
    echo "Koneksi ke server gagal.";
    die();
} #else echo "Koneksi berhasil";
?>
~~~
![Screenshot (134)](https://user-images.githubusercontent.com/81818989/120888808-94a69700-c624-11eb-82d8-b27f3940499a.png)
# Langkah Kelima
Buat file baru dengan nama index.php
~~~
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
~~~
![Screenshot (135)](https://user-images.githubusercontent.com/81818989/120888831-b7d14680-c624-11eb-851b-15ae50bfe287.png)
# Langkah Keenam
Buat file baru dengan nama tambah.php
~~~
<?php 
error_reporting(E_ALL); 
include_once 'koneksi.php'; 
if (isset($_POST['submit'])) 
{ 
$nama = $_POST['nama']; 
$kategori = $_POST['kategori']; 
$harga_jual = $_POST['harga_jual']; 
$harga_beli = $_POST['harga_beli']; 
$stok = $_POST['stok']; 
$file_gambar = $_FILES['file_gambar']; 
$gambar = null; 
if ($file_gambar['error'] == 0) 
{ 
$filename = str_replace(' ', '_',$file_gambar['name']); 
$destination = dirname(__FILE__) .'/gambar/' . $filename; 
if(move_uploaded_file($file_gambar['tmp_name'], $destination)) 
{ 
$gambar = 'gambar/' . $filename;; 
} 
} 
$sql = 'INSERT INTO data_barang (nama, kategori,harga_jual, harga_beli, stok, gambar) '; 
$sql .= "VALUE ('{$nama}', '{$kategori}','{$harga_jual}', '{$harga_beli}', '{$stok}', '{$gambar}')"; 
$result = mysqli_query($conn, $sql); 
header('location: index.php'); 
} 
?> 
<!DOCTYPE html> 
<html lang="en"> 
<head> 
<meta charset="UTF-8"> 
<link href="style.css" rel="stylesheet" type="text/css" /> 
<title>Tambah Barang</title> 
</head> 
<body> 
<div class="container"> 
<h1>Tambah Barang</h1> 
<div class="main"> 
<form method="post" action="tambah.php" enctype="multipart/form-data"> 
<div class="input"> 
<label>Nama Barang</label> 
<input type="text" name="nama" /> 
</div> 
<div class="input"> 
<label>Kategori</label> 
<select name="kategori"> 
<option value="Komputer">Komputer</option> 
<option value="Elektronik">Elektronik</option> 
<option value="Hand Phone">Hand Phone</option> 
</select> 
</div> 
<div class="input"> 
<label>Harga Jual</label> 
<input type="text" name="harga_jual" /> 
</div> 
<div class="input"> 
<label>Harga Beli</label> 
<input type="text" name="harga_beli" /> 
</div> 
<div class="input"> 
<label>Stok</label> 
<input type="text" name="stok" /> 
</div> 
<div class="input"> 
<label>File Gambar</label> 
<input type="file" name="file_gambar" /> 
</div> 
<div class="submit"> 
<input type="submit" name="submit" value="Simpan" /> 
</div> 
</form> 
</div> 
</div> 
</body> 
</html> 
~~~
![Screenshot (136)](https://user-images.githubusercontent.com/81818989/120889061-b05e6d00-c625-11eb-8a5b-b5203e8a7eb6.png)
# Langkah ketujuh
Buat file baru dengan nama ubah.php
~~~
<?php 
error_reporting(E_ALL); 
include_once 'koneksi.php'; 
if (isset($_POST['submit'])) 
{ 
$id = $_POST['id']; 
$nama = $_POST['nama']; 
$kategori = $_POST['kategori']; 
$harga_jual = $_POST['harga_jual']; 
$harga_beli = $_POST['harga_beli']; 
$stok = $_POST['stok']; 
$file_gambar = $_FILES['file_gambar']; 
$gambar = null; 
if ($file_gambar['error'] == 0) 
{ 
$filename = str_replace(' ', '_', $file_gambar['name']); 
$destination = dirname(__FILE__) . '/gambar/' . $filename; 
if (move_uploaded_file($file_gambar['tmp_name'], $destination)) 
{ 
$gambar = 'gambar/' . $filename;; 
} 
} 
$sql = 'UPDATE data_barang SET '; 
$sql .= "nama = '{$nama}', kategori = '{$kategori}', "; 
$sql .= "harga_jual = '{$harga_jual}', harga_beli = '{$harga_beli}', stok = '{$stok}' "; 
if (!empty($gambar)) 
$sql .= ", gambar = '{$gambar}' "; 
$sql .= "WHERE id_barang = '{$id}'"; 
$result = mysqli_query($conn, $sql); 
header('location: index.php'); 
} 
$id = $_GET['id']; 
$sql = "SELECT * FROM data_barang WHERE id_barang = '{$id}'"; 
$result = mysqli_query($conn, $sql); 
if (!$result) die('Error: Data tidak tersedia'); 
$data = mysqli_fetch_array($result); 
function is_select($var, $val) { 
if ($var == $val) return 'selected="selected"'; 
return false; 
} 
?> 
<!DOCTYPE html> 
<html lang="en"> 
<head> 
<meta charset="UTF-8"> 
<link href="style.css" rel="stylesheet" type="text/css" /> 
<title>Ubah Barang</title> 
</head> 
<body> 
<div class="container"> 
<h1>Ubah Barang</h1> 
<div class="main"> 
<form method="post" action="ubah.php" enctype="multipart/form-data"> 
<div class="input"> 
<label>Nama Barang</label> 
<input type="text" name="nama" value="<?php echo $data['nama'];?>" /> 
</div> 
<div class="input"> 
<label>Kategori</label> 
<select name="kategori"> 
<option <?php echo is_select 
('Komputer', $data['kategori']);?> value="Komputer">Komputer</option> 
<option <?php echo is_select 
('Komputer', $data['kategori']);?> value="Elektronik">Elektronik</option> 
<option <?php echo is_select 
('Komputer', $data['kategori']);?> value="Hand Phone">Hand Phone</option> 
</select> 
</div> 
<div class="input"> 
<label>Harga Jual</label> 
<input type="text" name="harga_jual" value="<?php echo $data['harga_jual'];?>" /> 
</div> 
<div class="input"> 
<label>Harga Beli</label> 
<input type="text" name="harga_beli" value="<?php echo $data['harga_beli'];?>" /> 
</div> 
<div class="input"> 
<label>Stok</label> 
<input type="text" name="stok" value="<?php echo $data['stok'];?>" /> 
</div> 
<div class="input"> 
<label>File Gambar</label> 
<input type="file" name="file_gambar" /> 
</div> 
<div class="submit"> 
<input type="hidden" name="id" value="<?php echo $data['id_barang'];?>" /> 
<input type="submit" name="submit" value="Simpan" /> 
</div> 
</form> 
</div> 
</div> 
</body> 
</html> 
~~~
![Screenshot (137)](https://user-images.githubusercontent.com/81818989/120889095-d08e2c00-c625-11eb-8381-f0818fb52298.png)

