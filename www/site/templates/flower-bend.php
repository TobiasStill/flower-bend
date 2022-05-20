<?php
$images = $page->drawings()->toFiles();
?>
<?php snippet('header') ?>
<main>
  <h1><?= $page->title() ?></h1>
  <section class="text">
    <?= $page->text()->kirbytext() ?>
  </section>
<?php
snippet('grid-images', array('images' => $images, 'width' => 100));
?>
</main>
<?php
snippet('footer');
