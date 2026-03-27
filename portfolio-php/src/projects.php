<?php
$page_css = '<link rel="stylesheet" href="../css/projects.css">';
include('../includes/header.php');
?>

<section id="projects" class="projects-section">
  <div class="container">

    <div class="section-header text-center">
      <span class="section-label">What I've Built</span>
      <h2 class="section-title">My <span class="accent">Projects</span></h2>
    </div>

    <div class="projects-grid">

      <!-- Project 1 -->
      <div class="project-card">
        <div class="project-card__accent project-card__accent--purple"></div>
        <div class="project-card__body">
          <div class="project-num">01</div>
          <h5 class="project-title">Cultive8</h5>
          <p class="project-sub">Farmers Platform</p>
          <p class="project-desc">
            Full-stack application using Flutter &amp; Firebase with real-time updates,
            authentication, and data-driven features for farmers.
          </p>
          <div class="project-tags">
            <span>Flutter</span><span>Firebase</span><span>Real-time</span>
          </div>
        </div>
        <div class="project-card__overlay">
          <div class="project-card__icon-wrap"><i class="fa-solid fa-seedling fa-2x"></i></div>
        </div>
      </div>

      <!-- Project 2 -->
      <div class="project-card">
        <div class="project-card__accent project-card__accent--cyan"></div>
        <div class="project-card__body">
          <div class="project-num">02</div>
          <h5 class="project-title">Hall Booking</h5>
          <p class="project-sub">System</p>
          <p class="project-desc">
            Developed using Frappe Framework and Python with approval workflows,
            conflict detection, and automated scheduling.
          </p>
          <div class="project-tags">
            <span>Python</span><span>Frappe</span><span>Workflows</span>
          </div>
        </div>
        <div class="project-card__overlay">
          <div class="project-card__icon-wrap"><i class="fa-solid fa-calendar-check fa-2x"></i></div>
        </div>
      </div>

      <!-- Project 3 -->
      <div class="project-card">
        <div class="project-card__accent project-card__accent--amber"></div>
        <div class="project-card__body">
          <div class="project-num">03</div>
          <h5 class="project-title">Studio Manager</h5>
          <p class="project-sub">Booking App</p>
          <p class="project-desc">
            Freelance solution to manage bookings, customers, and scheduling
            efficiently for a photography studio.
          </p>
          <div class="project-tags">
            <span>PHP</span><span>MySQL</span><span>Scheduling</span>
          </div>
        </div>
        <div class="project-card__overlay">
          <div class="project-card__icon-wrap"><i class="fa-solid fa-camera fa-2x"></i></div>
        </div>
      </div>

      <!-- Project 4 -->
      <div class="project-card">
        <div class="project-card__accent project-card__accent--green"></div>
        <div class="project-card__body">
          <div class="project-num">04</div>
          <h5 class="project-title">Billing &amp; Sales</h5>
          <p class="project-sub">System</p>
          <p class="project-desc">
            Retail billing and inventory system for managing transactions,
            stock levels, and sales reporting.
          </p>
          <div class="project-tags">
            <span>React JS</span><span>PostgreSQL</span><span>Flask</span><span>Inventory</span>
          </div>
        </div>
        <div class="project-card__overlay">
          <div class="project-card__icon-wrap"><i class="fa-solid fa-chart-line fa-2x"></i></div>
        </div>
      </div>

    </div>
  </div>
</section>

<?php include('../includes/footer.php'); ?>