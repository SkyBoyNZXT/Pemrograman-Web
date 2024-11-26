<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: formlogin.php");
    exit();
}

include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $clan = $_POST['clan'];
    $chakra_element = $_POST['chakra_element'];
    $ninja_rank = $_POST['ninja_rank'];
    $special_technique = $_POST['special_technique'];

    $sql = "INSERT INTO naruto_characters (name, clan, chakra_element, ninja_rank, special_technique) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $name, $clan, $chakra_element, $ninja_rank, $special_technique);

    if ($stmt->execute()) {
        header("Location: tampil.php");
        exit();
    } else {
        echo "Gagal menambah karakter: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Karakter Naruto</title>
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
            background: rgba(0, 0, 0, 0.8);
            padding: 40px;
            border-radius: 25px;
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.6);
            border: 3px solid var(--naruto-primary);
            max-width: 500px;
            width: 100%;
        }

        h2 {
            color: var(--naruto-primary);
            text-align: center;
            font-size: 2em;
            margin-bottom: 30px;
            text-transform: uppercase;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        label {
            font-size: 16px;
            color: var(--naruto-primary);
        }

        input {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background: rgba(255, 255, 255, 0.1);
            color: white;
            font-size: 16px;
            transition: background 0.3s;
        }

        input:focus {
            background: rgba(255, 255, 255, 0.2);
            outline: none;
        }

        .button-group {
            display: flex;
            gap: 15px;
            margin-top: 20px;
            justify-content: center;
        }

        button, .cancel-btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: transform 0.2s, background-color 0.3s;
            text-decoration: none;
            text-align: center;
        }

        button {
            background: var(--naruto-primary);
            color: white;
        }

        .cancel-btn {
            background: #666;
            color: white;
        }

        button:hover, .cancel-btn:hover {
            transform: scale(1.05);
            background-color: #FF4500;
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
    </style>
</head>
<body>
    <div class="chakra-circles"></div>
    <div class="container">
        <h2>Tambah Karakter Naruto</h2>
        <form method="POST" action="">
            <label for="name">Nama Karakter:</label>
            <input type="text" id="name" name="name" required>

            <label for="clan">Clan:</label>
            <input type="text" id="clan" name="clan" required>

            <label for="chakra_element">Elemen Chakra:</label>
            <input type="text" id="chakra_element" name="chakra_element" required>

            <label for="ninja_rank">Pangkat Ninja:</label>
            <input type="text" id="ninja_rank" name="ninja_rank" required>

            <label for="special_technique">Teknik Khusus:</label>
            <input type="text" id="special_technique" name="special_technique" required>

            <div class="button-group">
                <button type="submit">Tambah</button>
                <a href="tampil.php" class="cancel-btn">Batal</a>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.querySelector('.chakra-circles');
            
            for(let i = 0; i < 50; i++) {
                const circle = document.createElement('div');
                circle.style.position = 'absolute';
                circle.style.width = Math.random() * 20 + 'px';
                circle.style.height = circle.style.width;
                circle.style.backgroundColor = `rgba(255, 107, 0, ${Math.random() * 0.5})`;
                circle.style.borderRadius = '50%';
                circle.style.top = Math.random() * 100 + '%';
                circle.style.left = Math.random() * 100 + '%';
                circle.style.animation = 'float 3s ease-in-out infinite';
                container.appendChild(circle);
            }
        });
    </script>
</body>
</html>
