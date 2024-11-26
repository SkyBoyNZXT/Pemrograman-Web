<!DOCTYPE html>
<head>
	<title>tampil data</title>
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<style>::after
table {
    padding: 20px;
}
tr, th, td {
    padding: 10px;
    margin: 20px;
}
</style>
</head>
<body>
 <br>
    <form method="POST" action="tambah.php">
    <hr>
    <button type="input" class="btn btn-outline-primary">Tambah</button>
    <hr>
    </form>
	<table class="table table-striped">
		<tr>
			<th>Id User</th>
            <th>Nama lengkap</th>
			<th>Username</th>
			<th>Password</th>
			<th>Email</th>
            <th>Aksi</th>
		</tr>
		<?php 
		include 'koneksi.php';
		$no = 1;
		$data = mysqli_query($koneksi,"select * from user");
		while($d = mysqli_fetch_array($data)){
			?>
			<tr>
				<td><?php echo $d['idUser']; ?></td>
                <td><?php echo $d['nama']; ?></td>
				<td><?php echo $d['username']; ?></td>
				<td><?php echo $d['password']; ?></td>
				<td><?php echo $d['email']; ?></td>
                
				<td>
					<a role ="button" class="btn btn-info" href="ubah.php?id=<?php echo $d['idUser']; ?>">UBAH</a> </button>
					<a role ="button" class="btn btn-danger" href="hapus.php?id=<?php echo $d['idUser']; ?>">HAPUS</a>
				</td>
			</tr>
			<?php 
		}
		?>
	</table>
</body>
</html>