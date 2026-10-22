<?php
require_once 'config.php';
session_start();

$action = $_GET['action'] ?? 'home';

if ($action === 'status') {
    echo "ok\n";
    echo "PHP version: " . PHP_VERSION . "\n";
    echo "Session upload progress: " . ini_get('session.upload_progress.enabled') . "\n";
    exit;
}

echo "php2shell-critical app\n";
echo "PHP version: " . PHP_VERSION . "\n";
echo "Upload endpoint: /upload.php\n";
