<?php
// QuietScan PHP Configuration & Authentication Helper
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

define('CSV_FILE', __DIR__ . '/users.csv');

// Initialize users.csv if missing
if (!file_exists(CSV_FILE)) {
    $fp = fopen(CSV_FILE, 'w');
    fputcsv($fp, ['username', 'password']);
    fputcsv($fp, ['Sanjai', '06122006']);
    fputcsv($fp, ['Pon', '19102006']);
    fputcsv($fp, ['Rishapthi', '19052007']);
    fputcsv($fp, ['Reshekumar', '17112006']);
    fclose($fp);
}

function get_all_users() {
    $users = [];
    if (($handle = fopen(CSV_FILE, "r")) !== FALSE) {
        $header = fgetcsv($handle); // skip header
        while (($data = fgetcsv($handle)) !== FALSE) {
            if (!empty($data[0])) {
                $users[] = [
                    'username' => trim($data[0]),
                    'password' => isset($data[1]) ? trim($data[1]) : ''
                ];
            }
        }
        fclose($handle);
    }
    return $users;
}

function verify_credentials($username, $password) {
    $users = get_all_users();
    foreach ($users as $user) {
        if (strcasecmp($user['username'], trim($username)) === 0 && $user['password'] === $password) {
            return true;
        }
    }
    return false;
}

function register_user($username, $password) {
    $username = trim($username);
    if (empty($username) || empty($password)) {
        return ['success' => false, 'message' => 'Please provide username and password.'];
    }

    $users = get_all_users();
    foreach ($users as $user) {
        if (strcasecmp($user['username'], $username) === 0) {
            return ['success' => false, 'message' => 'Username already exists!'];
        }
    }

    if (($fp = fopen(CSV_FILE, 'a')) !== FALSE) {
        fputcsv($fp, [$username, $password]);
        fclose($fp);
        return ['success' => true, 'message' => 'Registration successful!'];
    }

    return ['success' => false, 'message' => 'Failed to write to database.'];
}

function is_logged_in() {
    return !empty($_SESSION['user']);
}

function require_login() {
    if (!is_logged_in()) {
        header('Location: login.php');
        exit;
    }
}

// Sample detections pool for simulation
function get_sample_detection() {
    $samples = [
        [
            'sound' => 'Speech',
            'time' => date('Y-m-d H:i:s'),
            'location' => 'Classroom / Hallway A',
            'image' => 'images/2025-10-30_12_06_56.jpg'
        ],
        [
            'sound' => 'Noise',
            'time' => date('Y-m-d H:i:s'),
            'location' => 'Hostel Corridor North',
            'image' => 'images/2025-10-30_12_06_48.jpg'
        ],
        [
            'sound' => 'Glass',
            'time' => date('Y-m-d H:i:s'),
            'location' => 'Laboratory Entrance',
            'image' => 'images/2025-10-30_12_06_39.jpg'
        ],
        [
            'sound' => 'Dog',
            'time' => date('Y-m-d H:i:s'),
            'location' => 'Campus Perimeter Gate',
            'image' => 'images/2025-12-20_15_05_22.jpg'
        ]
    ];
    return $samples[array_rand($samples)];
}
