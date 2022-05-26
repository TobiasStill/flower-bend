<picture class="picture" onclick="drawings.showImage(event, '<?= $image->url() ?>')">
  <source media="(min-width: 601px)" srcset="<?= $image->srcset([$width]) ?>">
  <source media="(max-width: 600px)" srcset="<?= $image->srcset([540]) ?>">
  <img
    src="<?= $image->url() ?>"
    srcset="<?= $image->srcset([$width, 540]) ?>"
    sizes="(max-width: 600px) 540px, (min-width: 600px) <?= $width ?>px"
    alt="<?= $image->alt() ?>"
  />
</picture>
