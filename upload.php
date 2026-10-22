<?php
require_once 'config.php';
session_start();

// VULNERABLE: file upload without validation, triggers multipart/form-data
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $uploadDir = '/var/www/html/uploads/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }
    $filename = $_FILES['file']['name'];
    $tmpName = $_FILES['file']['tmp_name'];
    move_uploaded_file($tmpName, $uploadDir . $filename);
    echo "Uploaded: " . htmlspecialchars($filename);
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
