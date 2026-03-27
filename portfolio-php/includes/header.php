<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Anto Portfolio</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- External Libraries -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

  <!-- GLOBAL CSS -->
  <link rel="stylesheet" href="../css/style.css">

  <!-- PAGE CSS (dynamic) -->
  <?php if(isset($page_css)) echo $page_css; ?>
</head>
<body>

<nav class="navbar navbar-expand-lg fixed-top glass-nav">
  <div class="container nav-container">

    <a class="navbar-brand brand-logo" href="home.php">
      <span class="brand-dot"></span>
      Anto<span class="brand-accent">.dev</span>
    </a>

    <div class="nav-links">
      <a class="nav-link d-inline mx-1 <?php echo (basename($_SERVER['PHP_SELF'])=='home.php') ? 'active' : ''; ?>" href="home.php">Home</a>
      <a class="nav-link d-inline mx-1 <?php echo (basename($_SERVER['PHP_SELF'])=='about.php') ? 'active' : ''; ?>" href="about.php">About</a>
      <a class="nav-link d-inline mx-1 <?php echo (basename($_SERVER['PHP_SELF'])=='skills.php') ? 'active' : ''; ?>" href="skills.php">Skills</a>
      <a class="nav-link d-inline mx-1 <?php echo (basename($_SERVER['PHP_SELF'])=='projects.php') ? 'active' : ''; ?>" href="projects.php">Projects</a>
      <a class="nav-link d-inline mx-1 <?php echo (basename($_SERVER['PHP_SELF'])=='contact.php') ? 'active' : ''; ?>" href="contact.php">Contact</a>
    </div>

    <!-- Theme Toggle -->
    <button class="theme-toggle-btn ms-3" onclick="toggleTheme()" title="Toggle theme">
      <span class="theme-icon" id="themeIcon">🌙</span>
    </button>

  </div>
</nav>