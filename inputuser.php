<?php
include 'koneksi.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add New User</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background: linear-gradient(to bottom right, #2c3e50, #3498db);
            font-family: 'Arial', sans-serif;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
        }

        .container {
            background: rgba(0, 0, 0, 0.8);
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 20px #ff6b00;
            text-align: center;
            max-width: 400px;
            width: 100%;
            position: relative;
            overflow: hidden;
        }

        h2 {
            color: #ff6b00;
            font-size: 2em;
            margin-bottom: 20px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: none;
            border-radius: 5px;
            background: rgba(255, 255, 255, 0.1);
            color: white;
            font-size: 16px;
            transition: background 0.3s;
        }

        input::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }

        input:focus {
            background: rgba(255, 255, 255, 0.2);
            outline: none;
        }

        .button-container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background: #ff6b00;
            color: white;
            font-size: 18px;
            cursor: pointer;
            transition: background 0.3s ease, transform 0.2s ease;
        }

        button:hover {
            background: #ff8533;
            transform: scale(1.05);
        }

        .chakra-circles {
            position: fixed;
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
    <div class="chakra-circles"></div>
    <div class="container">
        <form action="" method="POST">
            <h2>Add New User</h2>
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <div class="button-container">
                <button type="submit">Add User</button>
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