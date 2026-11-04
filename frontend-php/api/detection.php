<?php
require_once __DIR__ . '/../config.php';
header('Content-Type: application/json');

$detection = get_sample_detection();
echo json_encode([
    'status' => 'success',
    'active' => isset($_SESSION['detection_running']) ? $_SESSION['detection_running'] : true,
    'detection' => $detection
]);
