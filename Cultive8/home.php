<?php
session_start();
require_once 'db_connect.php';

if (!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "farmer") {
    header("Location: login.php");
    exit();
}

// Fetch user name and role
$conn = getDBConnection();
$user_id = $_SESSION["user_id"];
$user_query = mysqli_query($conn, "SELECT name, role FROM users WHERE id = $user_id");
$user = mysqli_fetch_assoc($user_query);
$user_name = $user["name"];
$user_role = $user["role"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cultive8 - Farmer Dashboard</title>
    <!-- External Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
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
    <!-- Floating Orbs -->
    <canvas id="orbs-canvas" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: -1; pointer-events: none;"></canvas>

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
                <?php if ($user_role === "admin") { ?>
                    <a href="admin_resources.php" style="display: flex; align-items: center; gap: 10px; color: #fff; text-decoration: none; padding: 15px; margin: 10px 0; border-radius: 10px; transition: all 0.3s ease;"><i class="fas fa-eye"></i> Admin View</a>
                <?php } ?>
                <a href="logout.php" style="display: flex; align-items: center; gap: 10px; color: #fff; text-decoration: none; padding: 15px; margin: 10px 0; border-radius: 10px; transition: all 0.3s ease;"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main style="margin-left: 250px; width: calc(100% - 250px); padding: 20px;">
            <!-- Header -->
            <header style="display: flex; justify-content: space-between; align-items: center; padding: 15px 30px; background: rgba(255, 255, 255, 0.9); border-radius: 10px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1), 0 0 15px rgba(76, 175, 80, 0.5); margin-bottom: 20px; backdrop-filter: blur(5px); animation: neonGlow 2s infinite alternate; transition: background 0.5s ease;">
                <div style="display: flex; align-items: center; gap: 15px;">
                    <img src="images/logo.png" alt="Cultive8 Logo" style="height: 40px;">
                    <h1 style="font-family: 'Georgia', serif; color: #2e7d32; font-size: 1.8em; margin: 0; text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);">Farmer Dashboard</h1>
                </div>
                <div class="user-profile" style="position: relative;">
                    <span style="cursor: pointer; padding: 10px; border-radius: 50%; background: #4CAF50; color: #fff; transition: transform 0.3s ease; box-shadow: 0 0 10px rgba(76, 175, 80, 0.5);"><?php echo substr($user_name, 0, 1); ?></span>
                    <div class="profile-dropdown" style="display: none; position: absolute; right: 0; top: 100%; background: #fff; border-radius: 10px; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2); padding: 10px; width: 200px; z-index: 100;">
                        <a href="#" style="display: block; color: #333; text-decoration: none; padding: 5px 0;">Profile</a>
                        <a href="logout.php" style="display: block; color: #333; text-decoration: none; padding: 5px 0;">Logout</a>
                    </div>
                </div>
            </header>

            <!-- Hero Section -->
            <section class="hero" style="position: relative; height: 500px; overflow: hidden; border-radius: 15px; margin-bottom: 30px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1); perspective: 1000px;">
                <div class="carousel" style="display: flex; height: 100%; transition: transform 0.8s ease; transform-style: preserve-3d;">
                    <div class="slide" style="min-width: 100%; background: url('images/slide1.jpg') center/cover no-repeat; display: flex; align-items: center; justify-content: center; color: #fff; text-shadow: 0 2px 6px rgba(0, 0, 0, 0.5); transition: transform 0.5s ease, filter 0.5s ease;">
                        <div style="transform: translateZ(50px); animation: fadeInUp 1s ease-out;"><h1 style="font-size: 3.5em; font-family: 'Georgia', serif;">Welcome, <span style="color: #4CAF50;"><?php echo htmlspecialchars($user_name); ?></span>!</h1></div>
                    </div>
                    <div class="slide" style="min-width: 100%; background: url('images/slide2.jpg') center/cover no-repeat; display: flex; align-items: center; justify-content: center; color: #fff; text-shadow: 0 2px 6px rgba(0, 0, 0, 0.5); transition: transform 0.5s ease, filter 0.5s ease;">
                        <div style="transform: translateZ(50px); animation: fadeInUp 1s ease-out;"><h1 style="font-size: 3.5em; font-family: 'Georgia', serif;">Cultivate Your Future</h1></div>
                    </div>
                </div>
                <button class="carousel-btn prev" style="position: absolute; left: 20px; top: 50%; transform: translateY(-50%); background: rgba(0, 0, 0, 0.5); color: #fff; border: none; padding: 10px; border-radius: 50%; cursor: pointer; font-size: 1.5em; z-index: 10; box-shadow: 0 0 10px rgba(76, 175, 80, 0.5); animation: pulse 2s infinite;">❮</button>
                <button class="carousel-btn next" style="position: absolute; right: 20px; top: 50%; transform: translateY(-50%); background: rgba(0, 0, 0, 0.5); color: #fff; border: none; padding: 10px; border-radius: 50%; cursor: pointer; font-size: 1.5em; z-index: 10; box-shadow: 0 0 10px rgba(76, 175, 80, 0.5); animation: pulse 2s infinite;">❯</button>
                <div class="carousel-dots" style="position: absolute; bottom: 20px; left: 50%; transform: translateX(-50%); display: flex; gap: 10px; z-index: 10;"></div>
                <p id="typewriter" style="position: absolute; bottom: 60px; left: 50%; transform: translateX(-50%); font-size: 1.3em; color: #fff; font-family: 'Roboto', sans-serif; min-height: 1.5em; text-align: center; text-shadow: 0 2px 4px rgba(0, 0, 0, 0.5); animation: fadeInUp 1s ease-out 1s forwards;"></p>
            </section>

            <!-- Widgets Container -->
            <div class="widgets" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px; margin-bottom: 30px;">
                <!-- Weather Widget -->
                <div class="widget" data-tooltip="Current weather conditions for your farm area" style="background: rgba(255, 255, 255, 0.9); padding: 20px; border-radius: 15px; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1), 0 0 15px rgba(76, 175, 80, 0.5); position: relative; animation: levitate 3s infinite ease-in-out;">
                    <h2 style="color: #2e7d32; font-size: 1.5em; margin-bottom: 10px;"><i class="fas fa-cloud-sun"></i> Weather</h2>
                    <p id="weather-data">Location: Farmville | 24°C | Sunny</p>
                    <p>Humidity: 65% | Wind: 10 km/h</p>
                </div>

                <!-- Farm Stats Widget -->
                <div class="widget" data-tooltip="Track your farm's performance metrics" style="background: rgba(255, 255, 255, 0.9); padding: 20px; border-radius: 15px; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1), 0 0 15px rgba(76, 175, 80, 0.5); position: relative; animation: levitate 3s infinite ease-in-out 0.5s;">
                    <h2 style="color: #2e7d32; font-size: 1.5em; margin-bottom: 10px;"><i class="fas fa-seedling"></i> Farm Stats</h2>
                    <canvas id="farmChart"></canvas>
                </div>

                <!-- Market Trends Widget -->
                <div class="widget" data-tooltip="Latest market prices for crops" style="background: rgba(255, 255, 255, 0.9); padding: 20px; border-radius: 15px; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1), 0 0 15px rgba(76, 175, 80, 0.5); position: relative; animation: levitate 3s infinite ease-in-out 1s;">
                    <h2 style="color: #2e7d32; font-size: 1.5em; margin-bottom: 10px;"><i class="fas fa-chart-line"></i> Market Trends</h2>
                    <p>Wheat: $5.50/bushel (↑ 2%)</p>
                    <p>Corn: $4.20/bushel (↓ 1%)</p>
                </div>

                <!-- Community Spotlight Widget -->
                <div class="widget" data-tooltip="Featured farmers in your community" style="background: rgba(255, 255, 255, 0.9); padding: 20px; border-radius: 15px; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1), 0 0 15px rgba(76, 175, 80, 0.5); position: relative; animation: levitate 3s infinite ease-in-out 1.5s;">
                    <h2 style="color: #2e7d32; font-size: 1.5em; margin-bottom: 10px;"><i class="fas fa-star"></i> Community Spotlight</h2>
                    <p><strong>John Doe</strong> - 20% yield increase!</p>
                </div>

                <!-- Task List Widget -->
                <div class="widget" data-tooltip="Your daily farming tasks" style="background: rgba(255, 255, 255, 0.9); padding: 20px; border-radius: 15px; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1), 0 0 15px rgba(76, 175, 80, 0.5); position: relative; animation: levitate 3s infinite ease-in-out 2s;">
                    <h2 style="color: #2e7d32; font-size: 1.5em; margin-bottom: 10px;"><i class="fas fa-tasks"></i> Daily Tasks</h2>
                    <ul style="list-style: none; padding: 0;">
                        <li style="padding: 5px 0;">Water crops - 8:00 AM</li>
                        <li style="padding: 5px 0;">Check soil pH - 10:00 AM</li>
                        <li style="padding: 5px 0;">Harvest wheat - 2:00 PM</li>
                    </ul>
                </div>

                <!-- Leaderboard Widget -->
                <div class="widget" data-tooltip="Top farmers this month" style="background: rgba(255, 255, 255, 0.9); padding: 20px; border-radius: 15px; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1), 0 0 15px rgba(76, 175, 80, 0.5); position: relative; animation: levitate 3s infinite ease-in-out 2.5s;">
                    <h2 style="color: #2e7d32; font-size: 1.5em; margin-bottom: 10px;"><i class="fas fa-trophy"></i> Leaderboard</h2>
                    <p>1. Sarah - 600 bushels</p>
                    <p>2. Mike - 550 bushels</p>
                    <p>3. <?php echo htmlspecialchars($user_name); ?> - 500 bushels</p>
                </div>

                <!-- Photo Gallery Widget -->
                <div class="widget" data-tooltip="Your farm's progress photos" style="background: rgba(255, 255, 255, 0.9); padding: 20px; border-radius: 15px; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1), 0 0 15px rgba(76, 175, 80, 0.5); position: relative; animation: levitate 3s infinite ease-in-out 3s;">
                    <h2 style="color: #2e7d32; font-size: 1.5em; margin-bottom: 10px;"><i class="fas fa-camera"></i> Photo Gallery</h2>
                    <div style="display: flex; gap: 10px;">
                        <img src="images/farm1.jpg" alt="Farm Photo 1" style="width: 60px; height: 60px; object-fit: cover; border-radius: 10px; cursor: pointer;" onclick="openLightbox(this.src)">
                        <img src="images/farm2.jpg" alt="Farm Photo 2" style="width: 60px; height: 60px; object-fit: cover; border-radius: 10px; cursor: pointer;" onclick="openLightbox(this.src)">
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div style="margin-bottom: 30px;">
                <h2 style="color: #2e7d32; font-size: 1.8em; margin-bottom: 15px; font-family: 'Georgia', serif; text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);">Quick Actions</h2>
                <div style="display: flex; gap: 20px; flex-wrap: wrap;">
                    <a href="#" style="flex: 1; background: #4CAF50; color: #fff; padding: 15px; border-radius: 15px; text-align: center; text-decoration: none; transition: all 0.3s ease; box-shadow: 0 0 15px rgba(76, 175, 80, 0.5); animation: neonGlow 2s infinite alternate; position: relative; overflow: hidden;">Schedule Meeting</a>
                    <a href="shared_resources.php" style="flex: 1; background: #4CAF50; color: #fff; padding: 15px; border-radius: 15px; text-align: center; text-decoration: none; transition: all 0.3s ease; box-shadow: 0 0 15px rgba(76, 175, 80, 0.5); animation: neonGlow 2s infinite alternate; position: relative; overflow: hidden;">Share Resources</a>
                </div>
            </div>
        </main>
    </div>

    <!-- Lightbox for Photo Gallery -->
    <div id="lightbox" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.8); z-index: 1000; display: flex; align-items: center; justify-content: center;">
        <img id="lightbox-img" style="max-width: 90%; max-height: 90%; border-radius: 10px; box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);">
        <button onclick="closeLightbox()" style="position: absolute; top: 20px; right: 20px; background: #4CAF50; color: #fff; border: none; padding: 10px; border-radius: 50%; cursor: pointer; font-size: 1.2em;">✖</button>
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

    <!-- Audio -->
    <audio id="bg-audio" loop>
        <source src="sounds/nature-sounds.mp3" type="audio/mpeg">
    </audio>
    <button id="audio-toggle" style="position: fixed; bottom: 20px; right: 20px; padding: 10px 20px; background: #4CAF50; color: #fff; border: none; border-radius: 25px; cursor: pointer; transition: all 0.3s ease; box-shadow: 0 0 15px rgba(76, 175, 80, 0.5); animation: pulse 2s infinite;">Mute Sound</button>

    <!-- Styles -->
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { overflow-x: hidden; scroll-behavior: smooth; }
        body.dark-mode { background: linear-gradient(135deg, #1a2a1d, #2e3a2f); color: #e0e0e0; }
        body.dark-mode .dashboard-container { background: linear-gradient(135deg, rgba(26, 42, 29, 0.9), rgba(46, 58, 47, 0.9)); }
        body.dark-mode .widget, body.dark-mode a { background: rgba(46, 58, 47, 0.9); color: #e0e0e0; }
        body.dark-mode h2 { color: #a5d6a7; }
        body.dark-mode .hero .slide { filter: brightness(0.8); }
        body.dark-mode footer { background: linear-gradient(135deg, #2c1b18, #2c1b18); }

        /* Animations */
        @keyframes fadeInUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
        @keyframes pulse { 0% { transform: scale(1); } 50% { transform: scale(1.05); } 100% { transform: scale(1); } }
        @keyframes levitate { 0% { transform: translateY(0); } 50% { transform: translateY(-10px); } 100% { transform: translateY(0); } }
        @keyframes aurora { 0% { background-position: 0% 50%; } 50% { background-position: 100% 50%; } 100% { background-position: 0% 50%; } }
        @keyframes wave { 0% { transform: translateX(-100%); } 100% { transform: translateX(100%); } }
        @keyframes neonGlow { 0% { box-shadow: 0 0 10px rgba(76, 175, 80, 0.5); } 100% { box-shadow: 0 0 20px rgba(76, 175, 80, 0.8); } }
        @keyframes ripple { 0% { width: 0; height: 0; opacity: 0.5; } 100% { width: 200px; height: 200px; opacity: 0; } }
        @keyframes gradientShift { 0% { background-position: 0% 50%; } 50% { background-position: 100% 50%; } 100% { background-position: 0% 50%; } }

        /* Aurora Background */
        .aurora { background-size: 200% 200%; }

        /* Sidebar */
        aside a:hover { background: rgba(255, 255, 255, 0.2); transform: translateX(5px); box-shadow: 0 0 10px rgba(76, 175, 80, 0.5); }
        aside a i { transition: transform 0.3s ease; }
        aside a:hover i { transform: scale(1.2); }

        /* Header */
        .user-profile:hover span { transform: scale(1.1); }
        .user-profile:hover .profile-dropdown { display: block; }

        /* Hero Carousel */
        .carousel { width: 100%; height: 100%; }
        .slide { flex-shrink: 0; }
        .slide:hover { transform: scale(1.05) translateZ(100px); filter: brightness(1.1); }
        .carousel-btn:hover { background: rgba(0, 0, 0, 0.7); }
        .carousel-dots button { width: 10px; height: 10px; border-radius: 50%; background: #fff; border: none; cursor: pointer; opacity: 0.5; transition: opacity 0.3s ease; }
        .carousel-dots button.active { opacity: 1; }
        #typewriter { animation: fadeInUp 1s ease-out 1s forwards; }

        /* Widgets */
        .widget { opacity: 0; transition: opacity 0.5s ease, transform 0.5s ease; position: relative; }
        .widget.visible { opacity: 1; transform: translateY(0); }
        .widget:hover { transform: translateY(-10px); box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2), 0 0 20px rgba(76, 175, 80, 0.8); }
        .widget:hover::before, a:hover::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: radial-gradient(circle, rgba(76, 175, 80, 0.5), transparent);
            border-radius: 50%;
            animation: ripple 0.5s forwards;
            transform: translate(-50%, -50%);
        }
        [data-tooltip] { position: relative; }
        [data-tooltip]:hover::after {
            content: attr(data-tooltip);
            position: absolute;
            bottom: 100%;
            left: 50%;
            transform: translateX(-50%);
            background: #333;
            color: #fff;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 0.9em;
            white-space: nowrap;
            z-index: 10;
            animation: fadeInUp 0.3s ease-out;
        }

        /* Quick Actions */
        a:hover { background: #388e3c; transform: translateY(-3px); }

        /* Dashboard Container */
        .dashboard-container { background-size: 200% 200%; animation: gradientShift 20s infinite; }

        /* Responsive Design */
        @media (max-width: 768px) {
            aside { width: 200px; }
            main { margin-left: 200px; width: calc(100% - 200px); }
            .hero { height: 300px; }
            .hero h1 { font-size: 2em; }
            #typewriter { font-size: 1em; }
            .carousel-btn { padding: 5px; }
            .widgets { grid-template-columns: 1fr; }
        }
    </style>

    <!-- Scripts -->
    <script>
        console.log("Farmer Dashboard loaded");

        // Theme Toggle
        const themeToggle = document.getElementById('theme-toggle');
        themeToggle.addEventListener('click', () => {
            document.body.classList.toggle('dark-mode');
            themeToggle.textContent = document.body.classList.contains('dark-mode') ? 'Toggle Light Mode' : 'Toggle Dark Mode';
        });

        // Scroll Animation for Widgets
        function handleScroll() {
            const widgets = document.querySelectorAll('.widget');
            widgets.forEach(widget => {
                const rect = widget.getBoundingClientRect();
                if (rect.top < window.innerHeight * 0.75) {
                    widget.classList.add('visible');
                }
            });

            // Color Shift for Sidebar and Header
            const sections = document.querySelectorAll('section, .widgets');
            sections.forEach(section => {
                const rect = section.getBoundingClientRect();
                if (rect.top < window.innerHeight * 0.5 && rect.bottom > 0) {
                    const color = section === document.querySelector('.hero') ? 'linear-gradient(135deg, #2e7d32, #4CAF50)' : 'linear-gradient(135deg, #4CAF50, #66bb6a)';
                    document.querySelector('aside').style.background = color;
                    document.querySelector('header').style.background = `rgba(255, 255, 255, 0.9)`;
                }
            });
        }
        window.addEventListener('scroll', handleScroll);
        handleScroll();

        // Carousel
        let currentSlide = 0;
        const slides = document.querySelectorAll('.slide');
        const dotsContainer = document.querySelector('.carousel-dots');
        slides.forEach((_, i) => {
            const dot = document.createElement('button');
            dot.addEventListener('click', () => {
                currentSlide = i;
                updateCarousel();
            });
            dotsContainer.appendChild(dot);
        });
        function updateCarousel() {
            document.querySelector('.carousel').style.transform = `translateX(-${currentSlide * 100}%)`;
            document.querySelectorAll('.carousel-dots button').forEach((dot, i) => {
                dot.classList.toggle('active', i === currentSlide);
            });
        }
        document.querySelector('.prev').addEventListener('click', () => {
            currentSlide = (currentSlide > 0) ? currentSlide - 1 : slides.length - 1;
            updateCarousel();
        });
        document.querySelector('.next').addEventListener('click', () => {
            currentSlide = (currentSlide < slides.length - 1) ? currentSlide + 1 : 0;
            updateCarousel();
        });
        setInterval(() => {
            currentSlide = (currentSlide < slides.length - 1) ? currentSlide + 1 : 0;
            updateCarousel();
        }, 5000);

        // Weather API (Mock for now)
        function updateWeather() {
            document.getElementById('weather-data').textContent = 'Location: Farmville | 24°C | Sunny';
        }
        updateWeather();
        setInterval(updateWeather, 60000);

        // Chart.js for Farm Stats
        const ctx = document.getElementById('farmChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Wheat', 'Corn', 'Soybean'],
                datasets: [{
                    label: 'Yield (bushels)',
                    data: [500, 300, 400],
                    backgroundColor: '#4CAF50',
                    borderColor: '#2e7d32',
                    borderWidth: 1
                }]
            },
            options: {
                scales: { y: { beginAtZero: true } },
                plugins: { legend: { labels: { color: '#2e7d32' } } }
            }
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

        // Floating Orbs
        const orbsCanvas = document.getElementById('orbs-canvas');
        const orbsCtx = orbsCanvas.getContext('2d');
        orbsCanvas.width = window.innerWidth;
        orbsCanvas.height = window.innerHeight;
        const orbs = [];
        for (let i = 0; i < 5; i++) {
            orbs.push({
                x: Math.random() * orbsCanvas.width,
                y: Math.random() * orbsCanvas.height,
                radius: 10,
                color: `rgba(76, 175, 80, ${Math.random() * 0.5 + 0.5})`,
                speedX: (Math.random() - 0.5) * 2,
                speedY: (Math.random() - 0.5) * 2
            });
        }
        let mouseX = 0, mouseY = 0;
        document.addEventListener('mousemove', (e) => {
            mouseX = e.clientX;
            mouseY = e.clientY;
        });
        function animateOrbs() {
            orbsCtx.clearRect(0, 0, orbsCanvas.width, orbsCanvas.height);
            orbs.forEach(orb => {
                orbsCtx.beginPath();
                orbsCtx.arc(orb.x, orb.y, orb.radius, 0, Math.PI * 2);
                orbsCtx.fillStyle = orb.color;
                orbsCtx.fill();
                orbsCtx.shadowBlur = 20;
                orbsCtx.shadowColor = '#4CAF50';

                // Move towards mouse
                const dx = mouseX - orb.x;
                const dy = mouseY - orb.y;
                const distance = Math.sqrt(dx * dx + dy * dy);
                if (distance > 50) {
                    orb.x += dx * 0.02;
                    orb.y += dy * 0.02;
                }
                orb.x += orb.speedX;
                orb.y += orb.speedY;
                if (orb.x < 0 || orb.x > orbsCanvas.width) orb.speedX *= -1;
                if (orb.y < 0 || orb.y > orbsCanvas.height) orb.speedY *= -1;
            });
            requestAnimationFrame(animateOrbs);
        }
        animateOrbs();
        window.addEventListener('resize', () => {
            orbsCanvas.width = window.innerWidth;
            orbsCanvas.height = window.innerHeight;
        });

        // Lightbox for Photo Gallery
        function openLightbox(src) {
            const lightbox = document.getElementById('lightbox');
            const lightboxImg = document.getElementById('lightbox-img');
            lightboxImg.src = src;
            lightbox.style.display = 'flex';
        }
        function closeLightbox() {
            document.getElementById('lightbox').style.display = 'none';
        }

        // Background Audio
        const audio = document.getElementById('bg-audio');
        const audioToggle = document.getElementById('audio-toggle');
        audio.play().catch(() => console.log("Audio play failed - user interaction required."));
        audioToggle.addEventListener('click', () => {
            if (audio.paused) {
                audio.play();
                audioToggle.textContent = 'Mute Sound';
            } else {
                audio.pause();
                audioToggle.textContent = 'Play Sound';
            }
        });
    </script>
</body>
</html>