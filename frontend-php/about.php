<?php
require_once __DIR__ . '/config.php';
$page_title = "About – QuietScan Smart Surveillance";
include __DIR__ . '/includes/header.php';
include __DIR__ . '/includes/navbar.php';
?>

<div class="content">
    <div class="container">
        <h1 class="main-heading">About the Smart Surveillance System</h1>
        <p class="intro">
            The Smart Surveillance System is an innovative monitoring platform designed to enhance community safety through the integration of real-time audio and video analysis. This system actively listens for signs of distress or quarrels and automatically captures evidence using strategically placed cameras.
        </p>

        <h2 class="section-heading"><i class="bi bi-bullseye"></i> Purpose</h2>
        <p>
            Our goal is to enable institutions and local authorities to monitor public areas, hostels, or high-risk zones without the need for constant manual supervision. By combining machine learning and automation, this system detects unusual noise levels and instantly triggers recording mechanisms.
        </p>

        <h2 class="section-heading"><i class="bi bi-stars"></i> Key Features</h2>
        <ul>
            <li>Real-time quarrel detection using noise analysis</li>
            <li>Automated camera activation upon incident detection</li>
            <li>Secure storage of video and audio evidence</li>
            <li>User-friendly interface for monitoring and reviewing events</li>
            <li>Easy deployment in schools, hostels, rural areas, and public spaces</li>
        </ul>

        <h2 class="section-heading"><i class="bi bi-cpu"></i> Technology Stack</h2>
        <ul>
            <li>PHP & Modern Web Architecture for server-side templating and session routing</li>
            <li>Python & Flask with TensorFlow Hub YAMNet for audio event classification</li>
            <li>Microphone-based sound surveillance logic with hardware trigger</li>
            <li>CSV-based authentication and evidence ledger</li>
        </ul>

        <h2 class="section-heading"><i class="bi bi-rocket-takeoff"></i> Future Enhancements</h2>
        <ul>
            <li>Integration with real-time mobile notifications</li>
            <li>Machine learning models for fight vs. normal conversation detection</li>
            <li>Cloud storage and dashboard for remote administrators</li>
        </ul>
    </div>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>
