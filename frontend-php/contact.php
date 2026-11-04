<?php
require_once __DIR__ . '/config.php';
$page_title = "Contact Us – QuietScan";

$success_msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $message = isset($_POST['message']) ? trim($_POST['message']) : '';

    if (!empty($name) && !empty($email) && !empty($message)) {
        $success_msg = "Thank you, " . htmlspecialchars($name) . "! Your message has been received. Our team will contact you shortly.";
    }
}

include __DIR__ . '/includes/header.php';
include __DIR__ . '/includes/navbar.php';
?>

<div class="content">
    <div class="contact-container">
        <h1 class="main-heading" style="text-align: left; margin-bottom: 10px;">Contact Us</h1>
        <p class="intro" style="margin-bottom: 20px;">
            We're here to help and answer any questions you might have. Reach out to us through the following channels or send us a message directly using the form below.
        </p>

        <div class="contact-grid">
            <div class="contact-details">
                <div class="contact-card">
                    <h3><i class="bi bi-envelope-at text-primary"></i> Email</h3>
                    <p><a href="mailto:pponprathakshana@gmail.com">pponprathakshana@gmail.com</a></p>
                </div>

                <div class="contact-card">
                    <h3><i class="bi bi-telephone text-success"></i> Phone</h3>
                    <p><a href="tel:+917305235212">+91 7305235212</a></p>
                </div>

                <div class="contact-card">
                    <h3><i class="bi bi-geo-alt text-danger"></i> Address</h3>
                    <p>
                        <strong>QuietScan - IQ Holders Team</strong><br>
                        KPR Institute of Engineering and Technology,<br>
                        Coimbatore, Tamil Nadu – 641407, India
                    </p>
                </div>
            </div>

            <div class="contact-form">
                <h3 style="margin-top: 0; color: var(--text-dark);"><i class="bi bi-chat-dots"></i> Send Us a Message</h3>

                <?php if (!empty($success_msg)): ?>
                    <div class="success-message">
                        <?php echo $success_msg; ?>
                    </div>
                <?php endif; ?>

                <form method="POST" action="contact.php">
                    <div class="form-group">
                        <label for="name">Your Name</label>
                        <input type="text" id="name" name="name" placeholder="e.g. John Doe" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Your Email</label>
                        <input type="email" id="email" name="email" placeholder="e.g. john@example.com" required>
                    </div>

                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea id="message" name="message" placeholder="Type your message or inquiry here..." rows="5" required></textarea>
                    </div>

                    <button type="submit" class="btn-submit">
                        <i class="bi bi-send"></i> Send Message
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>
