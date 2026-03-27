<?php
session_start();
require_once 'db_connect.php';

if (!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "admin") {
    header("Location: login.php");
    exit();
}
$conn = getDBConnection();
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = mysqli_real_escape_string($conn, $_POST["id"]);
    $expert_name = mysqli_real_escape_string($conn, trim($_POST["expert_name"]));
    $expert_phone = mysqli_real_escape_string($conn, trim($_POST["expert_phone"]));
    $meeting_date = trim($_POST["meeting_date"]);
    if (empty($expert_name) || empty($expert_phone) || empty($meeting_date)) {
        $error = "All fields are required.";
    } elseif (strlen($expert_name) > 100) {
        $error = "Expert name must be less than 100 characters.";
    } elseif (!preg_match("/^\+?[1-9]\d{1,14}$/", $expert_phone)) {
        $error = "Invalid phone number format.";
    } else {
        $sql = "UPDATE expert_schedules SET expert_name='$expert_name', expert_phone='$expert_phone', meeting_date='$meeting_date' WHERE id=$id";
        if (!mysqli_query($conn, $sql)) {
            $error = "Error updating schedule: " . mysqli_error($conn);
        }
    }
}

$schedules = mysqli_query($conn, "SELECT * FROM expert_schedules");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cultive8 - Edit Schedule</title>
</head>
<body>
    <header>
        <div style="max-width: 1300px; margin: 0 auto; padding: 20px; display: flex; justify-content: flex-end; align-items: center; background: linear-gradient(135deg, #2e7d32, #4CAF50); box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2); position: sticky; top: 0; z-index: 100;">
            <a href="admin_home.php" style="padding: 12px 25px; background: #fff; color: #2e7d32; text-decoration: none; border-radius: 25px; font-weight: bold; transition: all 0.3s ease; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);">Back to Dashboard</a>
        </div>
    </header>
    <main style="padding: 60px 0; background: linear-gradient(to bottom, rgba(241, 248, 233, 0.9), rgba(255, 255, 255, 0.9)), url('images/bg_farm.jpg') center/cover no-repeat; text-align: center; min-height: calc(100vh - 200px);">
        <div style="max-width: 1300px; margin: 0 auto; padding: 0 20px;">
            <h1 style="color: #2e7d32; margin-bottom: 30px; font-size: 3em; font-family: 'Georgia', serif; text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">Edit Expert Schedule</h1>
            <?php if (!empty($error)) { echo "<p style='color: #d32f2f; font-size: 1.2em; margin-bottom: 20px; font-family: \"Arial\", sans-serif;'>$error</p>"; } ?>
            <?php while ($schedule = mysqli_fetch_assoc($schedules)) { ?>
                <form method="POST" style="max-width: 500px; margin: 30px auto; background: #fff; padding: 25px; border-radius: 15px; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);">
                    <input type="hidden" name="id" value="<?php echo $schedule['id']; ?>">
                    <input type="text" name="expert_name" value="<?php echo $schedule['expert_name']; ?>" required style="width: 100%; padding: 12px; margin-bottom: 20px; border: 2px solid #4CAF50; border-radius: 10px; font-size: 1.1em; font-family: 'Arial', sans-serif; transition: border-color 0.3s;">
                    <input type="text" name="expert_phone" value="<?php echo $schedule['expert_phone']; ?>" required style="width: 100%; padding: 12px; margin-bottom: 20px; border: 2px solid #4CAF50; border-radius: 10px; font-size: 1.1em; font-family: 'Arial', sans-serif; transition: border-color 0.3s;">
                    <input type="datetime-local" name="meeting_date" value="<?php echo date('Y-m-d\TH:i', strtotime($schedule['meeting_date'])); ?>" required style="width: 100%; padding: 12px; margin-bottom: 20px; border: 2px solid #4CAF50; border-radius: 10px; font-size: 1.1em; font-family: 'Arial', sans-serif; transition: border-color 0.3s;">
                    <button type="submit" style="padding: 12px 30px; background: #4CAF50; color: white; border: none; border-radius: 25px; font-size: 1.2em; cursor: pointer; transition: all 0.3s ease; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2); font-family: 'Arial', sans-serif;">Update</button>
                </form>
            <?php } ?>
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
        input:focus { border-color: #388e3c; outline: none; }
        main { animation: fadeIn 1s ease-in-out; }
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        @media (max-width: 768px) { h1 { font-size: 2em; } form { max-width: 90%; } }
    </style>

    <script>
        console.log("Edit Schedule page loaded");
        document.querySelectorAll('button').forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.target.style.background = '#388e3c';
                setTimeout(() => e.target.style.background = '#4CAF50', 200);
            });
        });
    </script>
</body>
</html>