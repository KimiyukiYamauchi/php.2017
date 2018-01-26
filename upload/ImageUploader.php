<?php

namespace MyAPP;

class ImageUploader {

  private $_imageFileName;
  private $_imageType;

  public function upload() {
    try {
      // error check
      $this->_validateUpload();

      // type check
      $ext = $this->_validateImageType();
      // var_dump($ext);
      // exit;

      // save
      $savePath = $this->_save($ext);

      // create thumnail
      $this->_createThumbnail($savePath);

    } catch (\Exception $e) {
      echo $e->getMessage();
      exit;
    }

    // redirect
    header('Location: http://' . $_SERVER['HTTP_HOST'] . '/upload');
    exit;

  }

  private function _createThumbnail($savePath) {
    $imageSize = getimagesize($savePath);
    $width = $imageSize[0];
    $height = $imageSize[1];

    // var_dump($width, $height);
    // exit;

    if ($width > THUMBNAIL_WIDTH) {
      $this->_createThumbnailMain($savePath, $width, $height);
    }
  }

  private function _createThumbnailMain($savePath, $width, $height) {

    // var_dump('_createThumbnailMain');
    // exit;

    switch ($this->_imageType) {
      case IMAGETYPE_GIF:
        $srcImage = imagecreatefromgif($savePath);
        break;
      case IMAGETYPE_JPEG:
        $srcImage = imagecreatefromjpeg($savePath);
        break;
      case IMAGETYPE_PNG:
        $srcImage = imagecreatefrompng($savePath);
        break;
    }
    $thumbHeight = round($height * THUMBNAIL_WIDTH / $width);
    $thumbImage = imagecreatetruecolor(THUMBNAIL_WIDTH, $thumbHeight);

    // var_dump($thumbImage);
    // exit;

    $res = imagecopyresampled($thumbImage, $srcImage, 0, 0, 0, 0, THUMBNAIL_WIDTH, $thumbHeight, $width, $height);

    // var_dump($res);
    // exit;

    switch ($this->_imageType) {
      case IMAGETYPE_GIF:
        imagegif($thumbImage, THUMBNAIL_DIR . '/' . $this->_imageFileName);
        break;
      case IMAGETYPE_JPEG:
        imagejpeg($thumbImage, THUMBNAIL_DIR . '/' . $this->_imageFileName);
        break;
      case IMAGETYPE_PNG:
        imagepng($thumbImage, THUMBNAIL_DIR . '/' . $this->_imageFileName);
        break;
    }


  }

  private function _save($ext) {
    $this->_imageFileName = sprintf(
      '%s_%s.%s',
      time(),
      sha1(uniqid(mt_rand(), true)),
      $ext
    );

    // var_dump($this->_imageFileName);
    // exit;
    
    $savePath = IMAGE_DIR . '/' . $this->_imageFileName;
    $res = move_uploaded_file(
            $_FILES['image']['tmp_name'],$savePath);
    if($res === false) {
      throw new \Exception('Could not upload!');
    }

    return $savePath;
  }

  private function _validateImageType() {
    $this->_imageType = exif_imagetype($_FILES['image']['tmp_name']);

    switch($this->_imageType) {
      case IMAGETYPE_GIF:
        return 'gif';
      case IMAGETYPE_JPEG:
        return 'jpg';
      case IMAGETYPE_PNG:
        return 'png';
      default:
        throw new \Exception('PNG/JPEG/GIF only');

    }
  }

  private function _validateUpload() {
    // var_dump($_FILES);
    // exit;
    
    if (!isset($_FILES['image']) || !isset($_FILES['image']['error'])) {
      throw new \Exception('Upload Error');
    }

    switch($_FILES['image']['error']) {
      case UPLOAD_ERR_OK:
        return true;
      case UPLOAD_ERR_INI_SIZE:
      case UPLOAD_ERR_FORM_SIZE:
        throw new \Exception('File to large!');
      default:
        throw new \Exception('Err: ' . $_FILES['image']['error']);
    }
  }


}