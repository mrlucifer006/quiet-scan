<?php
require_once __DIR__ . '/config.php';
require_login();
$_SESSION['detection_running'] = false;
header('Location: sound.php');
exit;
