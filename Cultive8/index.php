<?php
session_start();
require_once 'db_connect.php';

if (isset($_SESSION["user_id"])) {
    header("Location: home.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cultive8 - Welcome</title>
</head>
<body>
    <header>
        <div style="max-width: 1300px; margin: 0 auto; padding: 20px; display: flex; justify-content: center; align-items: center; background: linear-gradient(135deg, #2e7d32, #4CAF50); box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2); position: sticky; top: 0; z-index: 100;">
            <img src="images/logo.png" alt="Cultive8 Logo" style="max-width: 220px; height: auto; filter: drop-shadow(0 2px 5px rgba(0, 0, 0, 0.3));">
        </div>
    </header>
    <main style="padding: 60px 0; background: linear-gradient(to bottom, rgba(241, 248, 233, 0.9), rgba(255, 255, 255, 0.9)), url('images/bg_index.jpg') center/cover no-repeat; text-align: center; min-height: calc(100vh - 200px);">
        <div style="max-width: 1300px; margin: 0 auto; padding: 0 20px;">
            <h1 style="color: #2e7d32; margin-bottom: 30px; font-size: 3em; font-family: 'Georgia', serif; text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">Welcome to Cultive8</h1>
            <p style="font-size: 1.3em; color: #5d4037; margin-bottom: 40px; font-family: 'Arial', sans-serif;">A farming assistance platform for farmers and admins.</p>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 25px; margin-top: 20px;">
                <a href="login.php" style="background: #4CAF50; color: white; padding: 30px; border-radius: 15px; text-decoration: none; font-size: 1.3em; display: flex; align-items: center; justify-content: center; height: 180px; transition: all 0.4s ease; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2); font-family: 'Arial', sans-serif;">Login</a>
                <a href="register.php" style="background: #4CAF50; color: white; padding: 30px; border-radius: 15px; text-decoration: none; font-size: 1.3em; display: flex; align-items: center; justify-content: center; height: 180px; transition: all 0.4s ease; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2); font-family: 'Arial', sans-serif;">Register</a>
            </div>
        </div>
    </main>
    <footer style="background: linear-gradient(135deg, #5d4037, #3e2723); color: white; text-align: center; padding: 30px 0; font-family: 'Arial', sans-serif;">
        <p>© 2025 Cultive8. All rights reserved.</p>
    </footer>

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Arial', sans-serif; color: #333; line-height: 1.6; overflow-x: hidden; }
        a:hover { background: #388e3c; transform: translateY(-8px) scale(1.05); box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3); }
        header a:hover { background: #e8f5e9; color: #2e7d32; transform: scale(1.1); }
        main { animation: fadeIn 1s ease-in-out; }
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        @media (max-width: 768px) { main div { grid-template-columns: 1fr; } h1 { font-size: 2em; } p { font-size: 1.1em; } }
    </style>

    <script>
        console.log("Landing page loaded");
        document.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', (e) => {
                e.target.style.background = '#388e3c';
                setTimeout(() => e.target.style.background = '#4CAF50', 200);
            });
        });
    </script>
</body>
</html>