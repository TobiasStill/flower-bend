<?php
$drawings = $page->drawings()->toStructure();
$backgrounds = $page->background()->toFiles();
?>
<?php snippet('header') ?>
<?php foreach ($backgrounds as $background) {
}?>
  </head>
  <body>
  <main>
    <div class="title"><h1><?= $page->title() ?></h1></div>
    <div class="xp">Zhou Xiaopeng</div>
    <div class="xp"><button onclick="overlays.toggleText(event)">Text</button></div>

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
<script>
  var backgrounds = [
    <?php foreach ($backgrounds as $background) {
      ?>'<?=$background->url()?>',<?php
    }?>
  ];
  cycleBg(backgrounds);
</script>
<?php
snippet('footer');
