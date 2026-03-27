<?php
session_start();
require_once 'db_connect.php';

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cultive8 - Contact Us</title>
</head>
<body>
    <header>
        <div style="max-width: 1300px; margin: 0 auto; padding: 20px; display: flex; justify-content: flex-end; align-items: center; background: linear-gradient(135deg, #2e7d32, #4CAF50); box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2); position: sticky; top: 0; z-index: 100;">
            <a href="home.php" style="padding: 12px 25px; background: #fff; color: #2e7d32; text-decoration: none; border-radius: 25px; font-weight: bold; transition: all 0.3s ease; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);">Back to Dashboard</a>
        </div>
    </header>
    <main style="padding: 60px 0; background: linear-gradient(to bottom, rgba(241, 248, 233, 0.9), rgba(255, 255, 255, 0.9)), url('images/bg_farm.jpg') center/cover no-repeat; text-align: center; min-height: calc(100vh - 200px);">
        <div style="max-width: 1300px; margin: 0 auto; padding: 0 20px;">
            <h1 style="color: #2e7d32; margin-bottom: 30px; font-size: 3em; font-family: 'Georgia', serif; text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">Contact Us</h1>
            <p style="font-size: 1.3em; color: #5d4037; margin-bottom: 20px; font-family: 'Arial', sans-serif;">Email: <a href="mailto:support@cultive8.com" style="color: #4CAF50; text-decoration: none;">support@cultive8.com</a></p>
            <p style="font-size: 1.3em; color: #5d4037; margin-bottom: 40px; font-family: 'Arial', sans-serif;">Phone: +1-555-000-1234</p>
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
        main a:hover { background: none; transform: none; text-decoration: underline; }
        main { animation: fadeIn 1s ease-in-out; }
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        @media (max-width: 768px) { h1 { font-size: 2em; } p { font-size: 1.1em; } }
    </style>

    <script>
        console.log("Contact Us page loaded");
    </script>
</body>
</html>