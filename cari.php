<?php
include 'koneksi.php';

if (isset($_POST['keyword'])) {
    $keyword = $_POST['keyword'];
    $query = "SELECT * FROM naruto_characters WHERE name LIKE '%$keyword%' OR clan LIKE '%$keyword%' OR chakra_element LIKE '%$keyword%'";
    $result = mysqli_query($conn, $query); // Menggunakan $conn di sini

    if (mysqli_num_rows($result) > 0) {
        echo "Karakter ditemukan.";
        // Proses tampilan karakter atau lainnya
    } else {
        echo "Karakter tidak ditemukan.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cari Karakter Naruto</title>
    <style>
        /* CSS styling */
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
            align-items: center;
        }

        .container {
            width: 100%;
            max-width: 900px;
            background: rgba(0, 0, 0, 0.8);
            border-radius: 25px;
            padding: 30px;
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.6);
            border: 3px solid var(--naruto-primary);
            text-align: center;
        }

        h2 {
            color: var(--naruto-primary);
            font-size: 2em;
            margin-bottom: 20px;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .search-form {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .search-input {
            padding: 10px;
            font-size: 1em;
            border-radius: 5px;
            border: 2px solid var(--naruto-primary);
            margin-right: 10px;
            background: rgba(255, 255, 255, 0.1);
            color: var(--naruto-text);
        }

        .search-button {
            padding: 10px 20px;
            background: var(--naruto-primary);
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 1em;
            transition: background 0.3s ease;
            cursor: pointer;
        }

        .search-button:hover {
            background: #FF4500;
        }

        .result-table {
            margin-top: 20px;
            width: 100%;
            border-collapse: collapse;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
        }

        .result-table th, .result-table td {
            padding: 15px;
            text-align: center;
            border: 1px solid var(--naruto-primary);
        }

        .result-table th {
            background-color: var(--naruto-primary);
            color: white;
        }

        .result-table tr:nth-child(even) {
            background-color: #1a1a2e;
        }

        .result-table tr:hover {
            background-color: #16213e;
        }

        .result-message {
            font-size: 1.1em;
            color: var(--naruto-primary);
        }

        .back-button {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: var(--naruto-secondary);
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 1em;
            transition: background 0.3s ease;
        }

        .back-button:hover {
            background-color: var(--naruto-primary);
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Cari Karakter Naruto</h2>

        <form class="search-form" method="GET" action="cari.php">
            <input type="text" name="keyword" class="search-input" placeholder="Cari berdasarkan nama, clan, elemen chakra...">
            <button type="submit" class="search-button">Cari</button>
        </form>

        <?php
        if (isset($_GET['keyword']) && !empty($_GET['keyword'])) {
            $keyword = $_GET['keyword'];
            
            // Query untuk mencari data yang cocok dengan keyword
            $query = "SELECT * FROM naruto_characters WHERE name LIKE '%$keyword%' OR clan LIKE '%$keyword%' OR chakra_element LIKE '%$keyword%'";
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) > 0) {
                echo "<div class='result-message'>Data ditemukan:</div>";
                echo "<table class='result-table'>
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Clan</th>
                                <th>Elemen Chakra</th>
                                <th>Rank</th>
                                <th>Teknik Spesial</th>
                            </tr>
                        </thead>
                        <tbody>";

                while ($row = mysqli_fetch_assoc($result)) {
                    $nama = isset($row['name']) ? htmlspecialchars($row['name']) : "Tidak ada nama";
                    $clan = isset($row['clan']) ? htmlspecialchars($row['clan']) : "Tidak ada clan";
                    $elemen = isset($row['chakra_element']) ? htmlspecialchars($row['chakra_element']) : "Tidak ada elemen";
                    $rank = isset($row['ninja_rank']) ? htmlspecialchars($row['ninja_rank']) : "Tidak ada rank";
                    $teknik = isset($row['special_technique']) ? htmlspecialchars($row['special_technique']) : "Tidak ada teknik";
                    
                    echo "<tr>
                            <td>$nama</td>
                            <td>$clan</td>
                            <td>$elemen</td>
                            <td>$rank</td>
                            <td>$teknik</td>
                          </tr>";
                }

                echo "</tbody></table>";
            } else {
                echo "<div class='result-message'>Data tidak ditemukan.</div>";
            }
        }
        ?>

        <!-- Tombol untuk kembali ke indexlogin.php -->
        <a href="indexlogin.php" class="back-button">Kembali ke Dashboard</a>
    </div>
</body>
</html>
