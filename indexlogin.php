<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: formlogin.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Ninja Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
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

        .dashboard-container {
            width: 90%;
            max-width: 1200px;
            background: rgba(0,0,0,0.8);
            border-radius: 25px;
            padding: 40px;
            box-shadow: 0 30px 60px rgba(0,0,0,0.6);
            border: 3px solid var(--naruto-primary);
            position: relative;
            overflow: hidden;
        }

        .dashboard-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
        }

        .user-profile {
            display: flex;
            align-items: center;
        }

        .user-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: var(--naruto-primary);
            display: flex;
            justify-content: center;
            align-items: center;
            margin-right: 20px;
            box-shadow: 0 0 30px rgba(255,107,0,0.5);
        }

        .user-avatar i {
            font-size: 40px;
            color: white;
        }

        .user-info h2 {
            color: var(--naruto-primary);
            margin-bottom: 10px;
            font-size: 28px;
        }

        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px;
        }

        .dashboard-card {
            background: rgba(255,255,255,0.1);
            border-radius: 20px;
            padding: 30px;
            text-align: center;
            transition: all 0.4s ease;
            position: relative;
            cursor: pointer;
            border: 2px solid transparent;
        }

        .dashboard-card:hover {
            transform: translateY(-15px);
            border-color: var(--naruto-primary);
            box-shadow: 0 15px 30px rgba(255,107,0,0.3);
        }

        .dashboard-card i {
            font-size: 50px;
            color: var(--naruto-primary);
            margin-bottom: 20px;
            transition: transform 0.3s ease;
        }

        .dashboard-card:hover i {
            transform: rotate(360deg);
        }

        .dashboard-card h3 {
            margin-bottom: 15px;
            color: white;
            font-size: 20px;
        }

        .dashboard-card p {
            opacity: 0.7;
        }

        .logout-btn {
            position: absolute;
            top: 20px;
            right: 20px;
            background: var(--naruto-primary);
            color: white;
            padding: 12px 25px;
            border-radius: 50px;
            text-decoration: none;
            display: flex;
            align-items: center;
            transition: all 0.3s ease;
        }

        .logout-btn i {
            margin-right: 10px;
        }

        .logout-btn:hover {
            background: #FF4500;
            transform: scale(1.05);
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
    
    <div class="dashboard-container">
        <a href="logout.php" class="logout-btn">
            <i class="bi bi-box-arrow-right"></i> Keluar
        </a>

        <div class="dashboard-header">
            <div class="user-profile">
                <div class="user-avatar">
                    <i class="bi bi-person-fill"></i>
                </div>
                <div class="user-info">
                    <h2>hallo, <?= htmlspecialchars($_SESSION['username']); ?>!</h2>
                    <p>Selamat datang di Desa Ninja</p>
                </div>
            </div>
        </div>

        <div class="dashboard-grid">
            <div class="dashboard-card" onclick="window.location.href='tampil.php'">
                <i class="bi bi-list-ul"></i>
                <h3>Daftar Karakter</h3>
                <p>Lihat semua ninja dalam database</p>
            </div>

            <div class="dashboard-card" onclick="window.location.href='tambah.php'">
                <i class="bi bi-plus-circle"></i>
                <h3>Tambah Karakter</h3>
                <p>Tambahkan ninja baru ke dalam tim</p>
            </div>

            <div class="dashboard-card" onclick="window.location.href='cari.php'">
                <i class="bi bi-search"></i>
                <h3>Cari Karakter</h3>
                <p>Temukan ninja spesifik</p>
            </div>
        </div>
    </div>

    <script>
        function createParticles() {
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
        }

        document.addEventListener('DOMContentLoaded', createParticles);
    </script>
</body>
</html