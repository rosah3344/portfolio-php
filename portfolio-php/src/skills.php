<?php
$page_css = '<link rel="stylesheet" href="../css/skills.css">';
include('../includes/header.php');
?>

<section id="skills" class="skills-section">
  <div class="container">

    <div class="section-header text-center">
      <span class="section-label">What I Work With</span>
      <h2 class="section-title">My <span class="accent">Skills</span></h2>
    </div>

    <div class="skills-grid">

      <div class="skill-card">
        <div class="skill-card__icon"><i class="fa-solid fa-desktop"></i></div>
        <div class="skill-card__glow"></div>
        <h5 class="skill-card__title">Frontend</h5>
        <div class="skill-tags">
          <span class="skill-tag">HTML</span>
          <span class="skill-tag">CSS</span>
          <span class="skill-tag">JavaScript</span>
          <span class="skill-tag">React JS</span>
        </div>
      </div>

      <div class="skill-card">
        <div class="skill-card__icon"><i class="fa-solid fa-server"></i></div>
        <div class="skill-card__glow"></div>
        <h5 class="skill-card__title">Backend</h5>
        <div class="skill-tags">
          <span class="skill-tag">C#</span>
          <span class="skill-tag">Python</span>
          <span class="skill-tag">Dart</span>
        </div>
      </div>

      <div class="skill-card">
        <div class="skill-card__icon"><i class="fa-solid fa-database"></i></div>
        <div class="skill-card__glow"></div>
        <h5 class="skill-card__title">Database</h5>
        <div class="skill-tags">
          <span class="skill-tag">MySQL</span>
          <span class="skill-tag">PostgreSQL</span>
          <span class="skill-tag">Firebase</span>
        </div>
      </div>

      <div class="skill-card">
        <div class="skill-card__icon"><i class="fa-solid fa-code"></i></div>
        <div class="skill-card__glow"></div>
        <h5 class="skill-card__title">Frameworks</h5>
        <div class="skill-tags">
          <span class="skill-tag">Frappe</span>
          <span class="skill-tag">.NET</span>
          <span class="skill-tag">Flask</span>
          <span class="skill-tag">Flutter</span>
        </div>
      </div>

      <div class="skill-card">
        <div class="skill-card__icon"><i class="fa-solid fa-screwdriver-wrench"></i></div>
        <div class="skill-card__glow"></div>
        <h5 class="skill-card__title">Tools</h5>
        <div class="skill-tags">
          <span class="skill-tag">Git</span>
          <span class="skill-tag">GitHub</span>
          <span class="skill-tag">Docker</span>
          <span class="skill-tag">Linux</span>
        </div>
      </div>

    </div>
  </div>
</section>

<?php include('../includes/footer.php'); ?>