<?php
if ($images) {
  foreach ($images as $image) {
    snippet('clickable-image', array('image' => $image, 'width' => $width));
  }
}
?>
