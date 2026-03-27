<?php
session_start();
require_once 'db_connect.php';

$conn = getDBConnection();
$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["register"])) {
    $username = mysqli_real_escape_string($conn, trim($_POST["username"]));
    $password = trim($_POST["password"]);
    $name = mysqli_real_escape_string($conn, trim($_POST["name"]));

    if (empty($username) || empty($password) || empty($name)) {
        $error = "All fields are required.";
    } elseif (strlen($username) < 3 || strlen($username) > 50) {
        $error = "Username must be between 3 and 50 characters.";
    } elseif (strlen($password) < 6) {
        $error = "Password must be at least 6 characters.";
    } elseif (strlen($name) < 2 || strlen($name) > 100) {
        $error = "Name must be between 2 and 100 characters.";
    } else {
        $sql = "SELECT id FROM users WHERE username='$username'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $error = "Username already exists.";
        } else {
            $sql = "INSERT INTO users (username, password, role, name) VALUES ('$username', '$password', 'farmer', '$name')";
            if (mysqli_query($conn, $sql)) {
                $success = "Registration successful! Please login.";
            } else {
                $error = "Error: " . mysqli_error($conn);
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cultive8 - Register</title>
</head>
<body>
    <header>
        <div style="max-width: 1300px; margin: 0 auto; padding: 20px; display: flex; justify-content: flex-end; align-items: center; background: linear-gradient(135deg, #2e7d32, #4CAF50); box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2); position: sticky; top: 0; z-index: 100;">
            <a href="index.php" style="padding: 12px 25px; background: #fff; color: #2e7d32; text-decoration: none; border-radius: 25px; font-weight: bold; transition: all 0.3s ease; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);">Back to Home</a>
        </div>
    </header>
    <main style="padding: 60px 0; background: linear-gradient(to bottom, rgba(241, 248, 233, 0.9), rgba(255, 255, 255, 0.9)), url('images/bg_register.jpg') center/cover no-repeat; text-align: center; min-height: calc(100vh - 200px);">
        <div style="max-width: 1300px; margin: 0 auto; padding: 0 20px;">
            <h1 style="color: #2e7d32; margin-bottom: 30px; font-size: 3em; font-family: 'Georgia', serif; text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">Cultive8 - Register</h1>
            <?php if (!empty($error)) { echo "<p style='color: #d32f2f; font-size: 1.2em; margin-bottom: 20px; font-family: \"Arial\", sans-serif;'>$error</p>"; } ?>
            <?php if (!empty($success)) { echo "<p style='color: #2e7d32; font-size: 1.2em; margin-bottom: 20px; font-family: \"Arial\", sans-serif;'>$success</p>"; } ?>
            <form method="POST" style="max-width: 500px; margin: 0 auto; background: #fff; padding: 25px; border-radius: 15px; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);">
                <div style="margin-bottom: 20px;">
                    <input type="text" name="username" placeholder="Username" required style="width: 100%; padding: 12px; border: 2px solid #4CAF50; border-radius: 10px; font-size: 1.1em; font-family: 'Arial', sans-serif; transition: border-color 0.3s;">
                </div>
                <div style="margin-bottom: 20px;">
                    <input type="password" name="password" placeholder="Password" required style="width: 100%; padding: 12px; border: 2px solid #4CAF50; border-radius: 10px; font-size: 1.1em; font-family: 'Arial', sans-serif; transition: border-color 0.3s;">
                </div>
                <div style="margin-bottom: 20px;">
                    <input type="text" name="name" placeholder="Full Name" required style="width: 100%; padding: 12px; border: 2px solid #4CAF50; border-radius: 10px; font-size: 1.1em; font-family: 'Arial', sans-serif; transition: border-color 0.3s;">
                </div>
                <button type="submit" name="register" style="padding: 12px 30px; background: #4CAF50; color: white; border: none; border-radius: 25px; font-size: 1.2em; cursor: pointer; transition: all 0.3s ease; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2); font-family: 'Arial', sans-serif;">Register</button>
            </form>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 25px; margin-top: 30px;">
                <a href="login.php" style="background: #4CAF50; color: white; padding: 30px; border-radius: 15px; text-decoration: none; font-size: 1.3em; display: flex; align-items: center; justify-content: center; height: 180px; transition: all 0.4s ease; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2); font-family: 'Arial', sans-serif;">Login</a>
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
        @media (max-width: 768px) { main div:last-child { grid-template-columns: 1fr; } h1 { font-size: 2em; } }
    </style>

    <script>
        console.log("Register page loaded");
        document.querySelectorAll('button, a').forEach(element => {
            element.addEventListener('click', (e) => {
                e.target.style.background = '#388e3c';
                setTimeout(() => e.target.style.background = '#4CAF50', 200);
            });
        });
    </script>
</body>
</html>