<?php

// var_dump('Location: http://' . $_SERVER['HTTP_HOST'] . '/upload');
// exit;

define('MAX_FILE_SIZE', 1 * 1024 * 1024); // 1MB
define('THUMBNAIL_WIDTH', 400);
define('IMAGE_DIR', __DIR__ . '/images');
define('THUMBNAIL_DIR', __DIR__ . '/thumbs');

if (!function_exists('imagecreatetruecolor')) {
  echo 'GD not installed';
  exit;
}

function h($s) {
  return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}

require 'ImageUploader.php';

$uploader = new \MyAPP\ImageUploader();


// var_dump($_SERVER['REQUEST_METHOD']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $uploader->upload();
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>Image Uploader</title>
  <style>
  body {
    text-align: center;
    font-family: Arial, sans-serif;
  }
  </style>
</head>
<body>

  <form action="" method="post" enctype="multipart/form-data">
    <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo h(MAX_FILE_SIZE); ?>">
    <input type="file" name="image">
    <input type="submit" value="upload">
  </form>
</body>
</html>