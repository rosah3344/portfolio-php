<?php
session_start();
require_once 'db_connect.php';

$conn = getDBConnection();
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && (isset($_POST["farmer_login"]) || isset($_POST["admin_login"]))) {
    $username = mysqli_real_escape_string($conn, trim($_POST["username"]));
    $password = trim($_POST["password"]);
    $is_admin = isset($_POST["admin_login"]) ? true : false;

    if (empty($username) || empty($password)) {
        $error = "All fields are required.";
    } elseif (strlen($username) < 3 || strlen($username) > 50) {
        $error = "Username must be between 3 and 50 characters.";
    } else {
        $sql = "SELECT * FROM users WHERE username='$username'";
        $result = mysqli_query($conn, $sql);
        if ($row = mysqli_fetch_assoc($result)) {
            if ($password === $row["password"]) {
                $_SESSION["user_id"] = $row["id"];
                $_SESSION["role"] = $row["role"];
                if ($is_admin && $row["role"] === "admin") {
                    header("Location: admin_home.php");
                    exit();
                } elseif (!$is_admin && $row["role"] === "farmer") {
                    header("Location: home.php");
                    exit();
                } else {
                    $error = "Invalid role for this login type.";
                }
            } else {
                $error = "Invalid username or password.";
            }
        } else {
            $error = "Invalid username or password.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cultive8 - Login</title>
</head>
<body>
    <header>
        <div style="max-width: 1300px; margin: 0 auto; padding: 20px; display: flex; justify-content: space-between; align-items: center; background: linear-gradient(135deg, #2e7d32, #4CAF50); box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2); position: sticky; top: 0; z-index: 100;">
            <img src="images/logo.png" alt="Cultive8 Logo" style="max-width: 220px; height: auto; filter: drop-shadow(0 2px 5px rgba(0, 0, 0, 0.3));">
            <a href="index.php" style="padding: 12px 25px; background: #fff; color: #2e7d32; text-decoration: none; border-radius: 25px; font-weight: bold; transition: all 0.3s ease; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);">Back to Home</a>
        </div>
    </header>
    <main style="padding: 60px 0; background: linear-gradient(to bottom, rgba(241, 248, 233, 0.9), rgba(255, 255, 255, 0.9)), url('images/bg_login.jpg') center/cover no-repeat; text-align: center; min-height: calc(100vh - 200px);">
        <div style="max-width: 1300px; margin: 0 auto; padding: 0 20px;">
            <h1 style="color: #2e7d32; margin-bottom: 30px; font-size: 3em; font-family: 'Georgia', serif; text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">Cultive8 - Login</h1>
            <?php if (!empty($error)) { echo "<p style='color: #d32f2f; font-size: 1.2em; margin-bottom: 20px; font-family: \"Arial\", sans-serif;'>$error</p>"; } ?>
            <form method="POST" style="max-width: 500px; margin: 0 auto; background: #fff; padding: 25px; border-radius: 15px; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);">
                <div style="margin-bottom: 20px;">
                    <input type="text" name="username" placeholder="Username" required style="width: 100%; padding: 12px; border: 2px solid #4CAF50; border-radius: 10px; font-size: 1.1em; font-family: 'Arial', sans-serif; transition: border-color 0.3s;">
                </div>
                <div style="margin-bottom: 20px;">
                    <input type="password" name="password" placeholder="Password" required style="width: 100%; padding: 12px; border: 2px solid #4CAF50; border-radius: 10px; font-size: 1.1em; font-family: 'Arial', sans-serif; transition: border-color 0.3s;">
                </div>
                <div style="display: flex; justify-content: space-between; gap: 15px;">
                    <button type="submit" name="farmer_login" style="padding: 12px 30px; background: #4CAF50; color: white; border: none; border-radius: 25px; font-size: 1.2em; cursor: pointer; transition: all 0.3s ease; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2); font-family: 'Arial', sans-serif; flex: 1;">Farmer Login</button>
                    <button type="submit" name="admin_login" style="padding: 12px 30px; background: #4CAF50; color: white; border: none; border-radius: 25px; font-size: 1.2em; cursor: pointer; transition: all 0.3s ease; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2); font-family: 'Arial', sans-serif; flex: 1;">Admin Login</button>
                </div>
            </form>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 25px; margin-top: 30px;">
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
        a:hover, button:hover { background: #388e3c; transform: translateY(-5px); box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3); }
        header a:hover { background: #e8f5e9; color: #2e7d32; transform: scale(1.1); }
        a:hover { transform: translateY(-8px) scale(1.05); }
        input:focus { border-color: #388e3c; outline: none; }
        main { animation: fadeIn 1s ease-in-out; }
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        @media (max-width: 768px) { main div form div:last-child { flex-direction: column; gap: 10px; } main div:last-child { grid-template-columns: 1fr; } h1 { font-size: 2em; } }
    </style>

    <script>
        console.log("Login page loaded");
        document.querySelectorAll('button, a').forEach(element => {
            element.addEventListener('click', (e) => {
                e.target.style.background = '#388e3c';
                setTimeout(() => e.target.style.background = '#4CAF50', 200);
            });
        });
    </script>
</body>
</html>