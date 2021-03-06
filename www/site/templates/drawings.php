<?php
$drawings = $page->drawings()->toStructure();
$backgrounds = $page->background()->toFiles();
$bCount = count($backgrounds);
$footerLogos = $page->footerLogos()->toFiles();
?>
<!doctype html>
<html lang="en">
<head>
  <?php snippet('header') ?>
  <?= css(['assets/drawings.css', '@auto']) ?>
  <?= js(['assets/drawings.js', '@auto']) ?>
  <style>
    body::after{
      position:absolute; width:0; height:0; overflow:hidden; z-index:-1;
      content:<?php foreach ($backgrounds as $background) {?> url("<?=$background->url()?>")<?php }?>;
    }
    body{
      animation: changeBg <?=$bCount * 20?>s infinite;
    }
    @keyframes changeBg {
    <?php
    $step = 100 / $bCount;
    $curr = 0;
    foreach ($backgrounds as $background) {?>
    <?=$curr === 0? '0%,100': $curr?>% {background-image: url("<?=$background->url()?>");}
    <?php
    $curr = $curr + $step;
    }?>
  </style>
</head>
<body>
<div class="page">
  <header>
    <div class="title"><h1><span class="xp">Xiaopeng Zhou</span> </br><span
          class="page-title"><?= $page->title() ?></span></h1></div>
    <button onclick="drawings.toggleText(event)">Text</button>
  </header>
  <main>
    <?php
    if ($drawings) {
      foreach ($drawings as $row) {
        snippet('drawings-row', array('row' => $row->row()->toStructure()));
      }
    }
    ?>
    <div id="overlay-image" class="overlay" style="display: none">
      <div class="overly-content"></div>
    </div>
    <div id="overlay-text" class="overlay" style="display: none">
      <div class="overly-content">
        <section class="text">
          <?= $page->text()->kirbytext() ?>
        </section>
      </div>
    </div>
  </main>

  <footer>
    <?php
    if ($footerLogos) {
      ?>
    <div class="logos">
      <?php
      foreach ($footerLogos as $image) {
      ?>
      <picture class="picture" onclick="drawings.showImage(event, '<?= $image->url() ?>')">
        <source media="(min-width: 601px)" srcset="<?= $image->srcset([100]) ?>">
        <source media="(max-width: 600px)" srcset="<?= $image->srcset([50]) ?>">
        <img
          src="<?= $image->url() ?>"
          srcset="<?= $image->srcset([50, 100]) ?>"
          sizes="(max-width: 600px) 540px, (min-width: 600px) <?= 50 ?>px"
          alt="<?= $image->alt() ?>"
        />
      </picture>
      <?php
      } ?>
    </div>
    <?php }
    ?>
    <div class="text"><?= $page->footerText()->kirbytext() ?></div>
    <div class="copy">&copy; Xiaopeng Zhou <?= date("Y");?> | <?= page('impressum')->title()->link() ?></div>
  </footer>
</div>

</body>
