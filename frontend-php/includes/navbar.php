<?php
$currentPage = basename($_SERVER['PHP_SELF']);
$user = isset($_SESSION['user']) ? $_SESSION['user'] : null;
?>
<nav>
    <div class="nav-wrapper">
        <a href="./home.php" class="brand">
            <i class="bi bi-shield-check"></i> QuietScan
        </a>
        <ul class="navbar">
            <li><a href="./home.php" class="<?php echo ($currentPage === 'home.php' || $currentPage === 'index.php') ? 'active' : ''; ?>">Home</a></li>
            <li><a href="./about.php" class="<?php echo ($currentPage === 'about.php') ? 'active' : ''; ?>">About</a></li>
            <li><a href="./team.php" class="<?php echo ($currentPage === 'team.php') ? 'active' : ''; ?>">Team</a></li>
            <li><a href="./contact.php" class="<?php echo ($currentPage === 'contact.php') ? 'active' : ''; ?>">Contact</a></li>
            <li><a href="./sound.php" class="<?php echo ($currentPage === 'sound.php') ? 'active' : ''; ?>">Dashboard</a></li>
        </ul>
        <div class="nav-actions">
            <?php if ($user): ?>
                <span class="user-greeting" style="display: inline-flex; align-items: center; gap: 6px; font-size: 14px; font-weight: 600; color: #495057; background: #e9ecef; padding: 5px 12px; border-radius: 20px;">
                    <i class="bi bi-person-circle"></i> <?php echo htmlspecialchars($user); ?>
                </span>
                <a href="./logout.php" class="btn-nav btn-nav-outline">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </a>
            <?php else: ?>
                <a href="./login.php" class="btn-nav btn-nav-outline">Log In</a>
                <a href="./register.php" class="btn-nav btn-nav-primary">Register</a>
            <?php endif; ?>
        </div>
    </div>
</nav>
