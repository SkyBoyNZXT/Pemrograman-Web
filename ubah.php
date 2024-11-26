<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: formlogin.php");
    exit();
}

include 'koneksi.php';

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM naruto_characters WHERE id = $id");
$character = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Karakter Ninja</title>
    <style>
        :root {
            --naruto-primary: #FF6B00;
            --naruto-secondary: #1A1A2E;
            --naruto-accent: #16213E;
            --naruto-text: #E5E5E5;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, var(--naruto-secondary), var(--naruto-accent));
            min-height: 100vh;
            color: var(--naruto-text);
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding: 20px;
        }

        .container {
            width: 100%;
            max-width: 600px;
            background: rgba(0, 0, 0, 0.8);
            padding: 30px;
            border-radius: 25px;
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.6);
            border: 3px solid var(--naruto-primary);
        }

        h2 {
            color: var(--naruto-primary);
            text-align: center;
            margin-bottom: 20px;
            font-size: 2em;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: var(--naruto-primary);
            font-weight: bold;
            font-size: 1.1em;
        }

        input {
            width: 100%;
            padding: 12px;
            border: 2px solid rgba(255, 107, 0, 0.3);
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.1);
            color: var(--naruto-text);
            font-size: 1em;
            transition: all 0.3s ease;
        }

        input:focus {
            outline: none;
            border-color: var(--naruto-primary);
            box-shadow: 0 0 10px rgba(255, 107, 0, 0.4);
        }

        .buttons {
            display: flex;
            gap: 15px;
            margin-top: 30px;
        }

        button, .cancel-btn {
            flex: 1;
            padding: 12px;
            border: none;
            border-radius: 8px;
            font-size: 1em;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            text-align: center;
        }

        button {
            background: var(--naruto-primary);
            color: white;
        }

        .cancel-btn {
            background: rgba(255, 255, 255, 0.1);
            color: var(--naruto-text);
            text-decoration: none;
            display: inline-block;
            text-align: center;
            padding: 12px;
            border-radius: 8px;
        }

        button:hover, .cancel-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }

        button:hover {
            background: #FF4500;
        }

        .cancel-btn:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }

            h2 {
                font-size: 1.8em;
            }

            input {
                padding: 10px;
            }

            .buttons {
                flex-direction: column;
            }
        }

        .chakra-circles {
            position: fixed;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: -1;
        }
    </style>
</head>
<body>
    <div class="chakra-circles"></div>
    <div class="container">
        <h2>Ubah Karakter Ninja</h2>
        <form method="POST" action="update.php?id=<?= $id ?>">
            <div class="form-group">
                <label for="name">Nama Karakter:</label>
                <input type="text" id="name" name="name" value="<?= htmlspecialchars($character['name']); ?>" required>
            </div>

            <div class="form-group">
                <label for="clan">Clan:</label>
                <input type="text" id="clan" name="clan" value="<?= htmlspecialchars($character['clan']); ?>" required>
            </div>

            <div class="form-group">
                <label for="chakra_element">Elemen Chakra:</label>
                <input type="text" id="chakra_element" name="chakra_element" value="<?= htmlspecialchars($character['chakra_element']); ?>" required>
            </div>

            <div class="form-group">
                <label for="ninja_rank">Pangkat Ninja:</label>
                <input type="text" id="ninja_rank" name="ninja_rank" value="<?= htmlspecialchars($character['ninja_rank']); ?>" required>
            </div>

            <div class="form-group">
                <label for="special_technique">Teknik Khusus:</label>
                <input type="text" id="special_technique" name="special_technique" value="<?= htmlspecialchars($character['special_technique']); ?>" required>
            </div>

            <div class="buttons">
                <button type="submit">Update Karakter</button>
                <a href="tampil.php" class="cancel-btn">Batal</a>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.querySelector('.chakra-circles');
            
            for (let i = 0; i < 50; i++) {
                const circle = document.createElement('div');
                circle.style.position = 'absolute';
                circle.style.width = Math.random() * 30 + 10 + 'px';
                circle.style.height = circle.style.width;
                circle.style.backgroundColor = `rgba(255, 107, 0, ${Math.random() * 0.5})`;
                circle.style.borderRadius = '50%';
                circle.style.top = Math.random() * 100 + '%';
                circle.style.left = Math.random() * 100 + '%';
                circle.style.animation = `float ${3 + Math.random() * 4}s ease-in-out infinite`;
                container.appendChild(circle);
            }
        });
    </script>
</body>
</html>
