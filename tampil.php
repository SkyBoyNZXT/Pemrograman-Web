<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: formlogin.php");
    exit();
}

include 'koneksi.php';

// Pengaturan Sorting
$sort_columns = ['id', 'name', 'clan', 'chakra_element', 'ninja_rank'];
$sort = isset($_GET['sort']) && in_array($_GET['sort'], $sort_columns) ? $_GET['sort'] : 'id';
$order = isset($_GET['order']) && in_array($_GET['order'], ['ASC', 'DESC']) ? $_GET['order'] : 'ASC';

// Simpan parameter sorting ke session
$_SESSION['current_sort'] = $sort;
$_SESSION['current_order'] = $order;

// Pengaturan Pagination
$limit = 10; // Jumlah data per halaman
$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$offset = ($page - 1) * $limit;

// Hitung total data
$total_query = "SELECT COUNT(*) as total FROM naruto_characters";
$total_result = $conn->query($total_query);
$total_data = $total_result->fetch_assoc()['total'];
$total_pages = ceil($total_data / $limit);

// Query dengan sorting dan pagination
$query = "SELECT * FROM naruto_characters 
          ORDER BY $sort $order 
          LIMIT $limit OFFSET $offset";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Karakter Naruto</title>
    <style>
        :root {
            --naruto-primary: #FF6B00;
            --naruto-secondary: #1A1A2E;
            --naruto-accent: #16213E;
            --naruto-text: #E5E5E5;
        }

        body {
            margin: 0;
            padding: 10px;
            background: linear-gradient(135deg, var(--naruto-secondary), var(--naruto-accent));
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: var(--naruto-text);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: flex-start;
        }

        .container {
            width: 100%;
            max-width: 1200px;
            background: rgba(0, 0, 0, 0.8);
            border-radius: 25px;
            padding: 30px;
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.6);
            border: 3px solid var(--naruto-primary);
            margin-top: 20px;
        }

        h2 {
            color: var(--naruto-primary);
            text-align: center;
            font-size: 2em;
            margin-bottom: 20px;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .button-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
        }

        .add-button, .back-button {
            padding: 12px 20px;
            background: var(--naruto-primary);
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
        }

        .add-button:hover, .back-button:hover {
            background-color: #FF4500;
            transform: scale(1.05);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 5px;
            overflow: hidden;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        th {
            background-color: var(--naruto-primary);
            color: white;
        }

        tr:hover {
            background-color: rgba(255, 255, 255, 0.05);
        }

        .action-links a {
            color: var(--naruto-primary);
            text-decoration: none;
            margin: 0 5px;
            transition: color 0.3s;
        }

        .action-links a:hover {
            color: #FF4500;
        }

        .chakra-circles {
            position: fixed;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: -1;
            top: 0;
            left: 0;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }

        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .pagination a {
            color: var(--naruto-primary);
            padding: 8px 16px;
            text-decoration: none;
            margin: 0 5px;
            border: 1px solid var(--naruto-primary);
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .pagination a:hover {
            background-color: var(--naruto-primary);
            color: white;
        }

        .pagination .active {
            background-color: var(--naruto-primary);
            color: white;
        }

        .sort-link {
            color: white;
            text-decoration: none;
            position: relative;
        }

        .sort-link::after {
            content: '▼';
            margin-left: 5px;
            font-size: 0.7em;
            opacity: 0.5;
        }

        .sort-link.asc::after {
            content: '▲';
        }
    </style>
    <script>
        function confirmDelete(name) {
            return confirm("Apakah Anda yakin ingin menghapus " + name + "?");
        }
    </script>
</head>
<body>
    <div class="chakra-circles"></div>
    <div class="container">
        <h2>Daftar Karakter Naruto</h2>
        
        <div class="button-container">
            <a href="tambah.php" class="add-button">Tambah Karakter</a>
            <a href="indexlogin.php" class="back-button">Kembali ke Dashboard</a>
        </div>
        
        <table>
            <tr>
                <th>
                    <a href="?sort=id&order=<?= $order == 'ASC' ? 'DESC' : 'ASC' ?>&page=<?= $page ?>" 
                       class="sort-link <?= $sort == 'id' ? $order : '' ?>">ID</a>
                </th>
                <th>
                    <a href="?sort=name&order=<?= $order == 'ASC' ? 'DESC' : 'ASC' ?>&page=<?= $page ?>" 
                       class="sort-link <?= $sort == 'name' ? $order : '' ?>">Nama</a>
                </th>
                <th>
                    <a href="?sort=clan&order=<?= $order == 'ASC' ? 'DESC' : 'ASC' ?>&page=<?= $page ?>" 
                       class="sort-link <?= $sort == 'clan' ? $order : '' ?>">Clan</a>
                </th>
                <th>
                    <a href="?sort=chakra_element&order=<?= $order == 'ASC' ? 'DESC' : 'ASC' ?>&page=<?= $page ?>" 
                       class="sort-link <?= $sort == 'chakra_element' ? $order : '' ?>">Elemen Chakra</a>
                </th>
                <th>
                    <a href="?sort=ninja_rank&order=<?= $order == 'ASC' ? 'DESC' : 'ASC' ?>&page=<?= $page ?>" 
                       class="sort-link <?= $sort == 'ninja_rank' ? $order : '' ?>">Pangkat Ninja</a>
                </th>
                <th>Teknik Khusus</th>
                <th>Aksi</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id']; ?></td>
                    <td><?= $row['name']; ?></td>
                    <td><?= $row['clan']; ?></td>
                    <td><?= $row['chakra_element']; ?></td>
                    <td><?= $row['ninja_rank']; ?></td>
                    <td><?= $row['special_technique']; ?></td>
                    <td class="action-links">
                        <a href="ubah.php?id=<?= $row['id']; ?>">Edit</a>
                        <a href="hapus.php?id=<?= $row['id']; ?>" 
                           onclick="return confirmDelete('<?= $row['name']; ?>')">Hapus</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>

        <div class="pagination">
            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <a href="?page=<?= $i ?>&sort=<?= $sort ?>&order=<?= $order ?>" 
                   class="<?= $i == $page ? 'active' : '' ?>"><?= $i ?></a>
            <?php endfor; ?>
        </div>
    </div>
</body>
</html>
