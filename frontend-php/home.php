<?php
require_once __DIR__ . '/config.php';
$page_title = "Welcome to QuietScan – Smart Surveillance System";
include __DIR__ . '/includes/header.php';
include __DIR__ . '/includes/navbar.php';
?>

<div class="content">
    <div class="container">
        <h1 class="main-heading">Welcome to QuietScan – Smart Surveillance System</h1>

        <p class="intro">
            QuietScan is a cutting-edge system that combines real-time voice surveillance and smart image capture
            to detect domestic quarrels and ensure safety within your environment.
        </p>

        <div class="features-grid">
            <div class="feature-box">
                <h3><i class="bi bi-mic"></i> Voice & Sound Analysis</h3>
                <p>Continuously analyzes audio streams using Google's YAMNet deep learning model to classify speech, shouting, barking, and glass breakage.</p>
            </div>
            <div class="feature-box">
                <h3><i class="bi bi-camera"></i> Instant Burst Capture</h3>
                <p>Camera is triggered within milliseconds upon detecting critical disturbances, capturing photographic evidence automatically.</p>
            </div>
            <div class="feature-box">
                <h3><i class="bi bi-shield-lock"></i> Secure & Private</h3>
                <p>Includes credential-protected dashboard access, encrypted session tracking, and timestamped forensic evidence logs.</p>
            </div>
        </div>

        <h2 class="section-heading">🔊 Voice Detection + 📸 Smart Capture</h2>
        <p>
            Our system actively monitors for signs of quarrels or loud disturbances. Upon detection,
            it automatically triggers the camera to capture images as evidence, all while logging the
            incident for review. It's a powerful integration of audio analysis and computer vision.
        </p>

        <h2 class="section-heading">👤 User-Friendly and Secure</h2>
        <p>
            With easy-to-use login and registration features, users can securely access the system dashboard,
            monitor real-time alerts, and view historical incident data—all through a sleek and responsive interface.
        </p>

        <h2 class="section-heading">💡 Why Choose QuietScan?</h2>
        <ul>
            <li>AI-powered quarrel detection</li>
            <li>Instant image capture during disturbances</li>
            <li>Real-time monitoring & alert system</li>
            <li>Secure and privacy-aware design</li>
            <li>Simple interface for quick access</li>
        </ul>

        <h2 class="section-heading">🚀 Ready to Get Started?</h2>
        <p>
            Your safety starts here. 
            <a href="register.php">Register now</a> to create your account,
            or <a href="login.php">log in</a> if you're already a user.
        </p>

        <div style="text-align: center; margin-top: 25px;">
            <a href="sound.php" class="btn-nav btn-nav-primary" style="padding: 12px 24px; font-size: 16px; display: inline-block;">
                <i class="bi bi-speedometer2"></i> Open Sound Detection Dashboard
            </a>
        </div>
    </div>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>
