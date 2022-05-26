<section class="drawings-row">
  <?php
  if ($row) {
    foreach ($row as $drawing) {
      $col = $drawing->column()->text();
      ?>
      <figure class="drawing drawings-col-<?=$col?>">
        <?=snippet('clickable-image', array('image' => $drawing->drawing()->toFile(), 'width' => 100));?>
      </figure>
      <?php
    }
  }
  ?>
</section>
