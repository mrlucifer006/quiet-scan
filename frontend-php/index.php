<?php
require_once __DIR__ . '/config.php';

if (is_logged_in()) {
    header('Location: sound.php');
} else {
    header('Location: home.php');
}
exit;
