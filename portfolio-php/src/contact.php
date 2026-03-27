<?php
$page_css = '<link rel="stylesheet" href="../css/contact.css">';
include('../includes/header.php');
include('../includes/db.php');

$success = false;
$error = "";
$name = "";
$email = "";
$message = "";

if (isset($_POST['submit'])) {

    $name    = trim($_POST['name']);
    $email   = trim($_POST['email']);
    $message = trim($_POST['message']);

    if (empty($name) || empty($email) || empty($message)) {
        $error = "All fields are required!";
    } 
    else {

        $name_db    = $conn->real_escape_string($name);
        $email_db   = $conn->real_escape_string($email);
        $message_db = $conn->real_escape_string($message);

        $check = "SELECT * FROM contact 
                  WHERE name='$name_db' AND email='$email_db' AND message='$message_db'";
        $result = $conn->query($check);

        if ($result->num_rows > 0) {
            $error = "Duplicate message not allowed!";
        } 
        else {

            $sql = "INSERT INTO contact(name, email, message) 
                    VALUES('$name_db', '$email_db', '$message_db')";

            if ($conn->query($sql)) {
                $success = true;

                $name = "";
                $email = "";
                $message = "";
            } else {
                $error = "Error sending message!";
            }
        }
    }
}
?>

<section id="contact" class="contact-section">
  <div class="container">

    <div class="section-header text-center">
      <span class="section-label">Let's Talk</span>
      <h2 class="section-title">Get In <span class="accent">Touch</span></h2>
      <p class="section-sub">Have a project in mind? I'd love to hear from you.</p>
    </div>

    <div class="contact-wrapper">

      <!-- Info side -->
      <div class="contact-info">

        <div class="contact-availability">
          <span class="avail-dot"></span>
          Available for freelance &amp; full-time roles
        </div>

        <!-- Professional Panel -->
        <div class="connect-panel">
          <div class="connect-panel__header">
            <i class="fa-solid fa-briefcase"></i>
            <span>Interact Professionally</span>
          </div>

          <div class="connect-panel__links">

            <a href="https://github.com/AntoRoshanA" target="_blank" rel="noopener" class="connect-link connect-link--github">
              <div class="connect-link__icon">
                <i class="fa-brands fa-github"></i>
              </div>
              <div class="connect-link__info">
                <span class="connect-link__name">GitHub</span>
                <span class="connect-link__handle">AntoRoshanA</span>
              </div>
              <i class="fa-solid fa-arrow-up-right-from-square connect-link__arrow"></i>
            </a>

            <a href="https://www.linkedin.com/in/anto-roshan-" target="_blank" rel="noopener" class="connect-link connect-link--linkedin">
              <div class="connect-link__icon">
                <i class="fa-brands fa-linkedin"></i>
              </div>
              <div class="connect-link__info">
                <span class="connect-link__name">LinkedIn</span>
                <span class="connect-link__handle">Anto Roshan</span>
              </div>
              <i class="fa-solid fa-arrow-up-right-from-square connect-link__arrow"></i>
            </a>

            <a href="https://dev.to/@anto_roshan__" target="_blank" rel="noopener" class="connect-link connect-link--devto">
              <div class="connect-link__icon">
                <i class="fa-brands fa-dev"></i>
              </div>
              <div class="connect-link__info">
                <span class="connect-link__name">DEV Community</span>
                <span class="connect-link__handle">Articles &amp; Posts</span>
              </div>
              <i class="fa-solid fa-arrow-up-right-from-square connect-link__arrow"></i>
            </a>

          </div>
        </div>

        <!-- Social Panel -->
        <div class="connect-panel">
          <div class="connect-panel__header">
            <i class="fa-solid fa-users"></i>
            <span>Interact Socially</span>
          </div>

          <div class="connect-panel__links">

            <a href="https://wa.me/+918925667331" target="_blank" rel="noopener" class="connect-link connect-link--whatsapp">
              <div class="connect-link__icon">
                <i class="fa-brands fa-whatsapp"></i>
              </div>
              <div class="connect-link__info">
                <span class="connect-link__name">WhatsApp</span>
                <span class="connect-link__handle">Chat directly</span>
              </div>
              <i class="fa-solid fa-arrow-up-right-from-square connect-link__arrow"></i>
            </a>

            <a href="https://instagram.com/roshan_anto__" target="_blank" rel="noopener" class="connect-link connect-link--instagram">
              <div class="connect-link__icon">
                <i class="fa-brands fa-instagram"></i>
              </div>
              <div class="connect-link__info">
                <span class="connect-link__name">Instagram</span>
                <span class="connect-link__handle">@roshan_anto__</span>
              </div>
              <i class="fa-solid fa-arrow-up-right-from-square connect-link__arrow"></i>
            </a>

            <a href="https://www.facebook.com/share/1CKaj1VjJt/" target="_blank" rel="noopener" class="connect-link connect-link--facebook">
              <div class="connect-link__icon">
                <i class="fa-brands fa-facebook-f"></i>
              </div>
              <div class="connect-link__info">
                <span class="connect-link__name">Facebook</span>
                <span class="connect-link__handle">Connect &amp; Follow</span>
              </div>
              <i class="fa-solid fa-arrow-up-right-from-square connect-link__arrow"></i>
            </a>

          </div>
        </div>

      </div>

      <!-- Form side -->
      <div class="contact-form-wrap">

        <?php if ($success): ?>
          <div class="alert-success">
            <i class="fa-solid fa-circle-check"></i> Message sent successfully!
          </div>

        <?php elseif (!empty($error)): ?>
          <div class="alert-error">
            <i class="fa-solid fa-circle-exclamation"></i> <?php echo $error; ?>
          </div>
        <?php endif; ?>

        <form method="POST" class="contact-form" novalidate>

          <div class="form-group">
            <label class="form-label">Your Name</label>
            <div class="input-wrap">
              <i class="fa-solid fa-user input-icon"></i>
              <input type="text" name="name" class="form-input" placeholder="Roshan" required
                     value="<?php echo htmlspecialchars($name); ?>">
            </div>
          </div>

          <div class="form-group">
            <label class="form-label">Email Address</label>
            <div class="input-wrap">
              <i class="fa-solid fa-envelope input-icon"></i>
              <input type="email" name="email" class="form-input" placeholder="roshan@example.com" required
                     value="<?php echo htmlspecialchars($email); ?>">
            </div>
          </div>

          <div class="form-group">
            <label class="form-label">Message</label>
            <div class="input-wrap">
              <i class="fa-solid fa-message input-icon input-icon--top"></i>
              <textarea name="message" class="form-input form-textarea" rows="4"
                        placeholder="Share your thoughts about projects or collaborations..."
                        required><?php echo htmlspecialchars($message); ?></textarea>
            </div>
          </div>

          <button type="submit" name="submit" class="btn-primary-grad submit-btn">
            <i class="fa-solid fa-paper-plane"></i> Send Message
          </button>

        </form>

      </div>

    </div>

  </div>
</section>

<?php include('../includes/footer.php'); ?>