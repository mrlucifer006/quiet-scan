<?php
require_once __DIR__ . '/config.php';
$page_title = "Login – QuietScan Surveillance System";

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    if (verify_credentials($username, $password)) {
        $_SESSION['user'] = $username;
        $_SESSION['detection_running'] = true;
        header('Location: sound.php');
        exit;
    } else {
        $error = "Invalid credentials.";
    }
}

include __DIR__ . '/includes/header.php';
include __DIR__ . '/includes/navbar.php';
?>

<div class="content">
    <div class="auth-container">
        <h2 class="auth-title"><i class="bi bi-person-lock"></i> Login</h2>

        <?php if (!empty($error)): ?>
            <div class="error-message">
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>

        <form class="auth-form" method="POST" action="login.php">
            <input type="text" id="username" name="username" placeholder="Username" required autocomplete="username">
            <input type="password" id="password" name="password" placeholder="Password" required autocomplete="current-password">
            <input type="submit" value="Login">
        </form>

        <div class="auth-footer">
            <p>Don't have an account? <a href="register.php">Register</a></p>
        </div>

        <details class="demo-credentials" open>
            <summary><i class="bi bi-key"></i> Quick Demo Accounts (from users.csv)</summary>
            <p style="font-size: 12px; margin: 6px 0; color: #666;">Click any user below to auto-fill credentials:</p>
            <ul>
                <li onclick="fillCredentials('Sanjai', '06122006')"><strong>Sanjai</strong> : <code>06122006</code></li>
                <li onclick="fillCredentials('Pon', '19102006')"><strong>Pon</strong> : <code>19102006</code></li>
                <li onclick="fillCredentials('Rishapthi', '19052007')"><strong>Rishapthi</strong> : <code>19052007</code></li>
                <li onclick="fillCredentials('Reshekumar', '17112006')"><strong>Reshekumar</strong> : <code>17112006</code></li>
            </ul>
        </details>
    </div>
</div>

<script>
function fillCredentials(u, p) {
    document.getElementById('username').value = u;
    document.getElementById('password').value = p;
}
</script>

<?php include __DIR__ . '/includes/footer.php'; ?>
