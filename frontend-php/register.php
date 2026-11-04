<?php
require_once __DIR__ . '/config.php';
$page_title = "Register – QuietScan Surveillance System";

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    $res = register_user($username, $password);
    if ($res['success']) {
        header('Location: success.php');
        exit;
    } else {
        $message = $res['message'];
    }
}

include __DIR__ . '/includes/header.php';
include __DIR__ . '/includes/navbar.php';
?>

<div class="content">
    <div class="auth-container">
        <h2 class="auth-title"><i class="bi bi-person-plus"></i> Register</h2>

        <?php if (!empty($message)): ?>
            <div class="error-message">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>

        <form class="auth-form" method="POST" action="register.php">
            <input type="text" name="username" placeholder="Username" required autocomplete="username">
            <input type="password" name="password" placeholder="Password" required autocomplete="new-password">
            <input type="submit" value="Register">
        </form>

        <div class="auth-footer">
            <p>Already have an account? <a href="login.php">Login</a></p>
        </div>
    </div>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>
