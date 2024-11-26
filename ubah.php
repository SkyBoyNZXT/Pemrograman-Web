<!DOCTYPE html>
<html>
<head>
    <title>Update</title>
</head>
<body>
 
    <h2>Update Data</h2>
    <br/>
    <a href="tampil.php">KEMBALI</a>
    
    <h3>Data User</h3>
 
    <?php
    include 'koneksi.php';

    // Memeriksa apakah 'id' ada dalam parameter GET
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $data = mysqli_query($koneksi, "SELECT * FROM user WHERE idUser ='$id'");

        // Memeriksa apakah data ditemukan
        if (mysqli_num_rows($data) > 0) {
            while ($d = mysqli_fetch_array($data)) {
                ?>
                <form method="post" action="update.php">
                    <table>
                        <tr>            
                            <td>Nama</td>
                            <td>
                                <input type="text" name="nama" value="<?php echo htmlspecialchars($d['nama']); ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>Username</td>
                            <td><input type="text" name="username" value="<?php echo htmlspecialchars($d['username']); ?>"></td>
                        </tr>
                        <tr>
                            <td>Password</td>
                            <td><input type="text" name="password" value="<?php echo htmlspecialchars($d['password']); ?>"></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td><input type="text" name="email" value="<?php echo htmlspecialchars($d['email']); ?>"></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td><input type="submit" value="SIMPAN"></td>
                        </tr>      
                    </table>
                </form>
                <?php 
            }
        } else {
            echo "Data tidak ditemukan.";
        }
    } else {
        echo "ID tidak diberikan.";
    }
    ?>
 
</body>
</html>