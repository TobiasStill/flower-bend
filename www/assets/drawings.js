

var drawings = (function () {

  let overlay;

  function hideOverlay() {
    if (overlay) {
      overlay.style.display = 'none'
    }
    overlay = false;
  }

  function showOverlay(div) {
    hideOverlay();
    overlay = div;
    overlay.style.display = 'inline-block';
    rePosition(overlay);
    var listener = function () {
      overlay && overlay.removeEventListener('click', listener);
      hideOverlay();
    }
    overlay.addEventListener('click', listener);
  }

  function rePosition(div) {
    var offset = getPageOffset(div);
    var width = div.getBoundingClientRect().width;
    var height = div.getBoundingClientRect().height;
    var vw = document.body.clientWidth;
    var vh = window.innerHeight;
    var scrollY = window.scrollY;
    var left = (vw - width) / 2;
    var top = Math.max(0, (vh - height) / 2) + scrollY;
    div.style.top = top + 'px';
    div.style.left = left + 'px';
  }

  // reposition overlays on resize
  document.addEventListener('resize', function (e) {
    if (overlay) {
      rePosition(overlay);
    }
  });

  const showImage = (e, src) => {
    var img = document.createElement("img");
    img.src = src;
    img.onload = function () {
      showOverlay(document.getElementById('overlay-image'));
      var content = overlay.querySelector('div');
      content.innerHTML = '';
      content.appendChild(img);
      rePosition(overlay);
    };
  }

  const toggleText = (e, src) => {
    var text = document.getElementById('overlay-text');
    if(overlay === text) {
      hideOverlay();
    } else {
      showOverlay(text);
    }
  }

  return {
    showImage,
    toggleText
  }
})();

function cycleBg(images) {
  var l = images.length - 1;
  var props = 'fixed top/100%';
  images.forEach((src) => {
    var preload = new Image();
    preload.src = src;
  })
  document.body.style.background =  `${props} url(${images[0]})`;
  var x = 0;
  window.setInterval(() => {
    x = (x+1) % l;
    var image = images[x];
    document.body.style.backgroundImage = 'url("")';
    window.setTimeout(() => {
      document.body.style.background =  `${props} url(${image})`;
    }, 3000)
  }, 20000)
}
