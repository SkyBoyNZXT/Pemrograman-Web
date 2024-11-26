<?php
include 'koneksi.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    if (empty($username) || empty($password) || empty($confirm_password)) {
        $error = "Semua kolom harus diisi!";
    } elseif ($password !== $confirm_password) {
        $error = "Kata sandi dan konfirmasi kata sandi tidak cocok!";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "SELECT * FROM users WHERE username = '$username'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $error = "Nama pengguna sudah terdaftar. Silakan gunakan nama lain.";
        } else {
            $sql = "INSERT INTO users (username, password) VALUES ('$username', '$hashed_password')";
            if ($conn->query($sql) === TRUE) {
                header("Location: formlogin.php");
                exit();
            } else {
                $error = "Terjadi kesalahan: " . $conn->error;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pendaftaran Akademi Ninja</title>
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
            color: var(--naruto-text);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

        .signup-container {
            width: 90%;
            max-width: 400px;
            background: rgba(0,0,0,0.8);
            border-radius: 25px;
            padding: 40px;
            box-shadow: 0 30px 60px rgba(0,0,0,0.6);
            border: 3px solid var(--naruto-primary);
            text-align: center;
        }

        h2 {
            color: var(--naruto-primary);
            font-size: 2em;
            margin-bottom: 30px;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .input-group {
            margin-bottom: 20px;
        }

        input {
            width: 100%;
            padding: 12px;
            margin: 8px 0;
            border: none;
            border-radius: 5px;
            background: rgba(255, 255, 255, 0.1);
            color: white;
            font-size: 16px;
            box-sizing: border-box;
            transition: all 0.3s ease;
        }

        input:focus {
            background: rgba(255, 255, 255, 0.2);
            outline: none;
            box-shadow: 0 0 10px var(--naruto-primary);
        }

        button {
            background: var(--naruto-primary);
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        button:hover {
            background: #FF4500;
            transform: scale(1.05);
        }

        p {
            color: white;
            margin-top: 20px;
        }

        a {
            color: var(--naruto-primary);
            text-decoration: none;
            transition: all 0.3s ease;
        }

        a:hover {
            color: #FF4500;
        }

        .error {
            color: #FF3333;
            background: rgba(255, 0, 0, 0.1);
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .background-particles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: -1;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }
    </style>
</head>
<body>
    <div class="background-particles" id="particles"></div>
    <div class="signup-container">
        <h2>Daftar Akademi Ninja</h2>
        <?php if (isset($error)) { echo "<div class='error'>$error</div>"; } ?>
        <form action="formsignup.php" method="POST">
            <div class="input-group">
                <input type="text" name="username" placeholder="Pilih nama ninja Anda" required>
            </div>
            <div class="input-group">
                <input type="password" name="password" placeholder="Buat kata sandi jutsu Anda" required>
            </div>
            <div class="input-group">
                <input type="password" name="confirm_password" placeholder="Konfirmasi kata sandi jutsu Anda" required>
            </div>
            <button type="submit">Bergabung dengan Akademi</button>
        </form>
        <p>Sudah menjadi ninja? <a href="formlogin.php">Kembali ke desa</a></p>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.getElementById('particles');
            const colors = ['#ff6b00', '#ff4500', '#ff7f50'];

            for (let i = 0; i < 150; i++) {
                const particle = document.createElement('div');
                particle.style.position = 'absolute';
                particle.style.width = `${Math.random() * 4 + 1}px`;
                particle.style.height = particle.style.width;
                particle.style.background = colors[Math.floor(Math.random() * colors.length)];
                particle.style.borderRadius = '50%';
                particle.style.top = `${Math.random() * 100}%`;
                particle.style.left = `${Math.random() * 100}%`;
                particle.style.opacity = Math.random();
                particle.style.animation = `float ${3 + Math.random() * 4}s ease-in-out infinite`;
                container.appendChild(particle);
            }
        });
    </script>
</body>
</html>
