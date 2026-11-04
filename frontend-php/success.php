<?php
require_once __DIR__ . '/config.php';
$page_title = "Registration Successful – QuietScan";
include __DIR__ . '/includes/header.php';
include __DIR__ . '/includes/navbar.php';
?>

<div class="content">
    <div class="auth-container">
        <h2 class="auth-title" style="color: #2e7d32;"><i class="bi bi-check-circle-fill"></i> Registration Successful!</h2>
        <p style="text-align: center; font-size: 16px; color: #555; margin: 20px 0;">
            Your account has been registered into the database. You can now login to access the system dashboard.
        </p>
        <div style="margin-top: 25px;">
            <a href="login.php" class="btn-submit" style="display: inline-block; text-decoration: none; padding: 12px 28px;">
                <i class="bi bi-box-arrow-in-right"></i> Proceed to Login
            </a>
        </div>
    </div>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>
