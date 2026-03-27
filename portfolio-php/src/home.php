<?php
$page_css = '<link rel="stylesheet" href="../css/home.css">';
include('../includes/header.php');
?>

<section id="home" class="hero-section">

  <div class="hero-blob hero-blob-1"></div>
  <div class="hero-blob hero-blob-2"></div>
  <div class="hero-grid-overlay"></div>

  <div class="container hero-container">

    <div class="hero-badge">
      <span class="badge-dot"></span>
      Software Developer
    </div>

    <h1 class="hero-heading">
      Hi, I'm <span class="hero-name">Anto</span><br>
      <span class="hero-role">Full Stack Developer</span>
    </h1>

    <p class="hero-sub">
      I craft <strong>.NET</strong> backends, <strong>Angular</strong> frontends &amp;
      <strong>Flutter</strong> mobile apps — end-to-end, production-ready.
    </p>

    <div class="hero-actions">
      <a href="projects.php" class="btn-primary-grad">
        <i class="fa-solid fa-folder-open"></i> View Projects
      </a>
      <a href="contact.php" class="btn-outline-grad">
        <i class="fa-solid fa-envelope"></i> Contact Me
      </a>
    </div>

    <div class="hero-socials">
      <a href="https://github.com/AntoRoshanA" target="_blank" rel="noopener" class="social-pill">
        <i class="fa-brands fa-github"></i> GitHub
      </a>
      <a href="https://www.linkedin.com/in/anto-roshan-" target="_blank" rel="noopener" class="social-pill">
        <i class="fa-brands fa-linkedin"></i> LinkedIn
      </a>
    </div>

    <div class="tech-chips">
      <span class="chip chip--1">.NET</span>
      <span class="chip chip--2">Angular</span>
      <span class="chip chip--3">Flutter</span>
      <span class="chip chip--4">Python</span>
      <span class="chip chip--5">Firebase</span>
    </div>

  </div>
</section>

<?php include('../includes/footer.php'); ?>