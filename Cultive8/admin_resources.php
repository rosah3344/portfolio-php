<?php
session_start();
require_once 'db_connect.php';

if (!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "admin") {
    header("Location: login.php");
    exit();
}

$conn = getDBConnection();
$user_id = $_SESSION["user_id"];
$user_query = mysqli_query($conn, "SELECT name FROM users WHERE id = $user_id");
$user = mysqli_fetch_assoc($user_query);
$user_name = $user["name"];

// Fetch all resources with usernames
$resources_query = mysqli_query($conn, "SELECT r.*, u.name AS user_name FROM resources r JOIN users u ON r.user_id = u.id ORDER BY u.name, r.created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cultive8 - Admin Resources</title>
    <!-- External Libraries -->
    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Georgia&family=Roboto:wght@300;400;700&display=swap');
    </style>
</head>
<body>
    <!-- Aurora Borealis Background -->
    <div class="aurora" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: -3; background: linear-gradient(45deg, #2e7d32, #4CAF50, #1b5e20); opacity: 0.3; animation: aurora 20s infinite;">
        <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(90deg, rgba(76, 175, 80, 0.3), rgba(46, 125, 50, 0.5), rgba(76, 175, 80, 0.3)); animation: wave 15s infinite;"></div>
    </div>
    <!-- Stardust Particle Background -->
    <div id="particles-js" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: -2;"></div>
    <!-- Background Video -->
    <video autoplay muted loop id="bg-video" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; z-index: -3; opacity: 0.5;">
        <source src="videos/farm-video.mp4" type="video/mp4">
        <img src="images/bg_farm.jpg" style="width: 100%; height: 100%; object-fit: cover;">
    </video>

    <!-- Theme Toggle -->
    <button id="theme-toggle" style="position: fixed; top: 20px; right: 20px; padding: 10px 20px; background: #4CAF50; color: #fff; border: none; border-radius: 25px; cursor: pointer; transition: all 0.3s ease; z-index: 100; box-shadow: 0 0 15px rgba(76, 175, 80, 0.5); animation: pulse 2s infinite;">Toggle Dark Mode</button>

    <!-- Main Container -->
    <div class="dashboard-container" style="display: flex; min-height: 100vh; background: linear-gradient(135deg, rgba(241, 248, 233, 0.9), rgba(255, 255, 255, 0.9)); font-family: 'Roboto', sans-serif; transition: background 0.5s ease;">

        <!-- Sidebar -->
        <aside style="width: 250px; background: linear-gradient(135deg, #2e7d32, #4CAF50); color: #fff; padding: 20px; position: fixed; height: 100%; box-shadow: 5px 0 15px rgba(0, 0, 0, 0.2); z-index: 50; transition: background 0.5s ease;">
            <h3 style="font-family: 'Georgia', serif; font-size: 1.8em; margin-bottom: 30px; text-align: center; text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);">Cultive8</h3>
            <nav>
                <a href="home.php" style="display: flex; align-items: center; gap: 10px; color: #fff; text-decoration: none; padding: 15px; margin: 10px 0; border-radius: 10px; transition: all 0.3s ease;"><i class="fas fa-home"></i> Dashboard</a>
                <a href="friends.php" style="display: flex; align-items: center; gap: 10px; color: #fff; text-decoration: none; padding: 15px; margin: 10px 0; border-radius: 10px; transition: all 0.3s ease;"><i class="fas fa-users"></i> Friends</a>
                <a href="market.php" style="display: flex; align-items: center; gap: 10px; color: #fff; text-decoration: none; padding: 15px; margin: 10px 0; border-radius: 10px; transition: all 0.3s ease;"><i class="fas fa-chart-line"></i> Market</a>
                <a href="resources.php" style="display: flex; align-items: center; gap: 10px; color: #fff; text-decoration: none; padding: 15px; margin: 10px 0; border-radius: 10px; transition: all 0.3s ease;"><i class="fas fa-book"></i> Resources</a>
                <a href="admin_resources.php" style="display: flex; align-items: center; gap: 10px; color: #fff; text-decoration: none; padding: 15px; margin: 10px 0; border-radius: 10px; transition: all 0.3s ease;"><i class="fas fa-eye"></i> Admin View</a>
                <a href="logout.php" style="display: flex; align-items: center; gap: 10px; color: #fff; text-decoration: none; padding: 15px; margin: 10px 0; border-radius: 10px; transition: all 0.3s ease;"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main style="margin-left: 250px; width: calc(100% - 250px); padding: 20px;">
            <!-- Header -->
            <header style="display: flex; justify-content: space-between; align-items: center; padding: 15px 30px; background: rgba(255, 255, 255, 0.9); border-radius: 10px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1), 0 0 15px rgba(76, 175, 80, 0.5); margin-bottom: 20px; backdrop-filter: blur(5px); animation: neonGlow 2s infinite alternate; transition: background 0.5s ease;">
                <div style="display: flex; align-items: center; gap: 15px;">
                    <img src="images/logo.png" alt="Cultive8 Logo" style="height: 40px;">
                    <h1 style="font-family: 'Georgia', serif; color: #2e7d32; font-size: 1.8em; margin: 0; text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);">Admin - All Resources</h1>
                </div>
                <div class="user-profile" style="position: relative;">
                    <span style="cursor: pointer; padding: 10px; border-radius: 50%; background: #4CAF50; color: #fff; transition: transform 0.3s ease; box-shadow: 0 0 10px rgba(76, 175, 80, 0.5);"><?php echo substr($user_name, 0, 1); ?></span>
                    <div class="profile-dropdown" style="display: none; position: absolute; right: 0; top: 100%; background: #fff; border-radius: 10px; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2); padding: 10px; width: 200px; z-index: 100;">
                        <a href="#" style="display: block; color: #333; text-decoration: none; padding: 5px 0;">Profile</a>
                        <a href="logout.php" style="display: block; color: #333; text-decoration: none; padding: 5px 0;">Logout</a>
                    </div>
                </div>
            </header>

            <!-- Resources Table -->
            <section style="background: rgba(255, 255, 255, 0.9); padding: 20px; border-radius: 15px; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);">
                <h2 style="color: #2e7d32; font-size: 1.8em; margin-bottom: 15px; font-family: 'Georgia', serif; text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);">All Users' Resources</h2>
                <div style="margin-bottom: 20px;">
                    <input type="text" id="searchInput" placeholder="Search by username or resource..." style="padding: 10px; width: 100%; max-width: 300px; border: 1px solid #ccc; border-radius: 5px;" onkeyup="filterTable()">
                </div>
                <table id="resourcesTable" style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="background: #4CAF50; color: #fff;">
                            <th style="padding: 10px; border-bottom: 2px solid #388e3c; cursor: pointer;" onclick="sortTable(0)">Username <i class="fas fa-sort"></i></th>
                            <th style="padding: 10px; border-bottom: 2px solid #388e3c; cursor: pointer;" onclick="sortTable(1)">Resource Name <i class="fas fa-sort"></i></th>
                            <th style="padding: 10px; border-bottom: 2px solid #388e3c; cursor: pointer;" onclick="sortTable(2)">Description <i class="fas fa-sort"></i></th>
                            <th style="padding: 10px; border-bottom: 2px solid #388e3c; cursor: pointer;" onclick="sortTable(3)">Category <i class="fas fa-sort"></i></th>
                            <th style="padding: 10px; border-bottom: 2px solid #388e3c; cursor: pointer;" onclick="sortTable(4)">Created At <i class="fas fa-sort"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($resource = mysqli_fetch_assoc($resources_query)) { ?>
                            <tr>
                                <td style="padding: 10px; border-bottom: 1px solid #ddd;"><?php echo htmlspecialchars($resource['user_name']); ?></td>
                                <td style="padding: 10px; border-bottom: 1px solid #ddd;"><?php echo htmlspecialchars($resource['resource_name']); ?></td>
                                <td style="padding: 10px; border-bottom: 1px solid #ddd;"><?php echo htmlspecialchars($resource['description']); ?></td>
                                <td style="padding: 10px; border-bottom: 1px solid #ddd;"><?php echo htmlspecialchars($resource['category']); ?></td>
                                <td style="padding: 10px; border-bottom: 1px solid #ddd;"><?php echo htmlspecialchars($resource['created_at']); ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </section>
        </main>
    </div>

    <!-- Footer -->
    <footer style="background: linear-gradient(135deg, #5d4037, #3e2723); color: #fff; padding: 20px; text-align: center; box-shadow: 0 -5px 15px rgba(0, 0, 0, 0.2), 0 0 15px rgba(93, 64, 55, 0.5); animation: neonGlow 2s infinite alternate;">
        <p>© 2025 Cultive8 | <a href="#" style="color: #4CAF50; text-decoration: none;">Contact: info@cultive8.com</a> | <a href="#" style="color: #4CAF50; text-decoration: none;">Support</a></p>
        <div style="margin-top: 10px;">
            <a href="#" style="color: #fff; margin: 0 10px;"><i class="fab fa-facebook-f"></i></a>
            <a href="#" style="color: #fff; margin: 0 10px;"><i class="fab fa-twitter"></i></a>
            <a href="#" style="color: #fff; margin: 0 10px;"><i class="fab fa-linkedin-in"></i></a>
        </div>
    </footer>

    <!-- Styles -->
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { overflow-x: hidden; scroll-behavior: smooth; }
        body.dark-mode { background: linear-gradient(135deg, #1a2a1d, #2e3a2f); color: #e0e0e0; }
        body.dark-mode .dashboard-container { background: linear-gradient(135deg, rgba(26, 42, 29, 0.9), rgba(46, 58, 47, 0.9)); }
        body.dark-mode h2 { color: #a5d6a7; }
        body.dark-mode footer { background: linear-gradient(135deg, #2c1b18, #2c1b18); }
        body.dark-mode table thead tr { background: #388e3c; }
        body.dark-mode table tbody tr { background: rgba(46, 58, 47, 0.9); }

        /* Animations */
        @keyframes fadeInUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes pulse { 0% { transform: scale(1); } 50% { transform: scale(1.05); } 100% { transform: scale(1); } }
        @keyframes aurora { 0% { background-position: 0% 50%; } 50% { background-position: 100% 50%; } 100% { background-position: 0% 50%; } }
        @keyframes wave { 0% { transform: translateX(-100%); } 100% { transform: translateX(100%); } }
        @keyframes neonGlow { 0% { box-shadow: 0 0 10px rgba(76, 175, 80, 0.5); } 100% { box-shadow: 0 0 20px rgba(76, 175, 80, 0.8); } }

        /* Aurora Background */
        .aurora { background-size: 200% 200%; }

        /* Sidebar */
        aside a:hover { background: rgba(255, 255, 255, 0.2); transform: translateX(5px); box-shadow: 0 0 10px rgba(76, 175, 80, 0.5); }
        aside a i { transition: transform 0.3s ease; }
        aside a:hover i { transform: scale(1.2); }

        /* Header */
        .user-profile:hover span { transform: scale(1.1); }
        .user-profile:hover .profile-dropdown { display: block; }

        /* Table */
        table tr:hover { background: rgba(76, 175, 80, 0.1); }
        th { position: relative; }
        th:hover { background: #388e3c; }
        th i { margin-left: 5px; }

        /* Responsive Design */
        @media (max-width: 768px) {
            aside { width: 200px; }
            main { margin-left: 200px; width: calc(100% - 200px); }
            table { font-size: 0.9em; }
            #searchInput { width: 100%; }
        }
    </style>

    <!-- Scripts -->
    <script>
        console.log("Admin Resources Page loaded");

        // Theme Toggle
        const themeToggle = document.getElementById('theme-toggle');
        themeToggle.addEventListener('click', () => {
            document.body.classList.toggle('dark-mode');
            themeToggle.textContent = document.body.classList.contains('dark-mode') ? 'Toggle Light Mode' : 'Toggle Dark Mode';
        });

        // Particle.js Configuration (Stardust Effect)
        particlesJS('particles-js', {
            particles: {
                number: { value: 150, density: { enable: true, value_area: 800 } },
                color: { value: '#ffffff' },
                shape: { type: 'circle' },
                opacity: { value: 0.7, random: true, anim: { enable: true, speed: 1, opacity_min: 0.3 } },
                size: { value: 2, random: true },
                line_linked: { enable: false },
                move: { enable: true, speed: 0.5, direction: 'none', random: true }
            },
            interactivity: { detect_on: 'canvas', events: { onhover: { enable: true, mode: 'repulse' } } },
            retina_detect: true
        });

        // Filter Table
        function filterTable() {
            const input = document.getElementById('searchInput').value.toLowerCase();
            const rows = document.querySelectorAll('#resourcesTable tbody tr');
            rows.forEach(row => {
                const username = row.cells[0].textContent.toLowerCase();
                const resourceName = row.cells[1].textContent.toLowerCase();
                const description = row.cells[2].textContent.toLowerCase();
                const category = row.cells[3].textContent.toLowerCase();
                if (username.includes(input) || resourceName.includes(input) || description.includes(input) || category.includes(input)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        // Sort Table
        function sortTable(columnIndex) {
            const table = document.getElementById('resourcesTable');
            const tbody = table.querySelector('tbody');
            const rows = Array.from(tbody.querySelectorAll('tr'));
            const isAscending = table.getAttribute('data-sort-direction') !== 'asc';
            table.setAttribute('data-sort-direction', isAscending ? 'asc' : 'desc');

            rows.sort((a, b) => {
                const aValue = a.cells[columnIndex].textContent.toLowerCase();
                const bValue = b.cells[columnIndex].textContent.toLowerCase();
                return isAscending ? aValue.localeCompare(bValue) : bValue.localeCompare(aValue);
            });

            while (tbody.firstChild) {
                tbody.removeChild(tbody.firstChild);
            }
            rows.forEach(row => tbody.appendChild(row));
        }
    </script>
</body>
</html>