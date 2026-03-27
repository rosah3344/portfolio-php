<?php
$page_css = '<link rel="stylesheet" href="../css/about.css">';
include('../includes/header.php');
?>

<section id="about" class="about-section">
  <div class="container">

    <div class="section-header text-center">
      <span class="section-label">Who I Am</span>
      <h2 class="section-title">About <span class="accent">Me</span></h2>
    </div>

    <div class="about-grid">

      <!-- Avatar / Visual side -->
      <div class="about-visual">
        <div class="avatar-frame">
          <div class="avatar-initials">AR</div>
          <div class="avatar-ring"></div>
          <div class="avatar-ring avatar-ring--2"></div>
        </div>

        <div class="about-stat about-stat--1">
          <span class="stat-num">∞</span>
          <span class="stat-label">Problem Solver</span>
        </div>
        <div class="about-stat about-stat--2">
          <span class="stat-num">6+</span>
          <span class="stat-label">Projects</span>
        </div>
      </div>

      <!-- Text side -->
      <div class="about-content">
        <p class="about-lead">
          Full Stack Developer with hands-on experience building
          <strong>scalable web &amp; mobile applications</strong> using HTML, CSS, JavaScript,
          .NET, Angular, Python, React JS, PHP, Flutter, and Firebase.
        </p>
        <p class="about-body">
          Skilled in designing clean user interfaces and developing
          efficient backend systems. Passionate about solving real-world
          problems through technology and delivering high-quality,
          user-friendly solutions.
        </p>

        <div class="highlight-grid">
          <div class="highlight-card">
            <div class="highlight-icon"><i class="fa-solid fa-layer-group"></i></div>
            <div>
              <div class="highlight-title">Full Stack</div>
              <div class="highlight-text">Frontend to backend, end-to-end</div>
            </div>
          </div>
          <div class="highlight-card">
            <div class="highlight-icon"><i class="fa-solid fa-mobile-screen-button"></i></div>
            <div>
              <div class="highlight-title">Mobile Dev</div>
              <div class="highlight-text">Flutter cross-platform apps</div>
            </div>
          </div>
          <div class="highlight-card">
            <div class="highlight-icon"><i class="fa-solid fa-cloud"></i></div>
            <div>
              <div class="highlight-title">Cloud &amp; DB</div>
              <div class="highlight-text">Firebase, PostgreSQL, MySQL</div>
            </div>
          </div>
          <div class="highlight-card">
            <div class="highlight-icon"><i class="fa-solid fa-code-branch"></i></div>
            <div>
              <div class="highlight-title">Clean Code</div>
              <div class="highlight-text">Git, Docker, best practices</div>
            </div>
          </div>
        </div>

        <a href="contact.php" class="btn-primary-grad mt-4">
          <i class="fa-solid fa-envelope"></i> Get In Touch
        </a>
      </div>

    </div>
  </div>
</section>

<?php include('../includes/footer.php'); ?>