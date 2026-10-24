<?php
require_once 'config.php';
session_start();

// Input validation for uploads
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $uploadDir = '/var/www/html/uploads/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    $filename = basename($_FILES['file']['name']);
    $tmpName = $_FILES['file']['tmp_name'];
    $maxSize = 2 * 1024 * 1024; // 2 MB
    $allowedExts = ['txt', 'pdf', 'png', 'jpg', 'jpeg', 'gif'];

    if ($_FILES['file']['error'] !== UPLOAD_ERR_OK) {
        http_response_code(400);
        echo "Upload error.";
        exit;
    }
    if ($_FILES['file']['size'] > $maxSize) {
        http_response_code(400);
        echo "File too large.";
        exit;
    }
    $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    if (!in_array($ext, $allowedExts, true)) {
        http_response_code(400);
        echo "File type not allowed.";
        exit;
    }
    $safeName = preg_replace('/[^A-Za-z0-9._-]/', '_', $filename);
    if ($safeName === '' || $safeName === '.' || $safeName === '..') {
        http_response_code(400);
        echo "Invalid filename.";
        exit;
    }

    move_uploaded_file($tmpName, $uploadDir . $safeName);
    echo "Uploaded: " . htmlspecialchars($safeName);
    exit;
}
?>
<!DOCTYPE html>
<html>
<body>
    <h1>File Upload</h1>
    <form method="POST" enctype="multipart/form-data">
        <input type="file" name="file">
        <button type="submit">Upload</button>
    </form>
</body>
</html>
