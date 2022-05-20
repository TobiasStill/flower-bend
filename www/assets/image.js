var enlargeImage = (function () {
  var startZIndex = 2;
  var visibleOverlays = {};

  function resetZ() {
    var i = 0;
    for (var src in visibleOverlays) {
      if (Object.prototype.hasOwnProperty.call(visibleOverlays, src)) {
        visibleOverlays[src].style.zIndex = startZIndex + i;
      }
      i++;
    }
  }

  function traverseToContainer(element) {
    var parent = element.parentNode;
    if (!parent) {
      return element;
    }
    if (/image/.test(parent.className)) {
      return parent;
    } else return traverseToContainer(parent);
  }

  function rePosition(div) {
    var offset = getPageOffset(traverseToContainer(div));
    var width = div.getBoundingClientRect().width;
    var viewport = document.body.clientWidth;
    var left = 0;
    if (offset.left + width > viewport) {
      left = viewport - offset.left - width;
    }
    div.style.top = 0;
    div.style.left = left + 'px';
  }

  function isVisible(src) {
    return !!visibleOverlays[src];
  }

// reposition overlays on resize
  document.addEventListener('resize', function (e) {
    for (var src in visibleOverlays) {
      if (Object.prototype.hasOwnProperty.call(visibleOverlays, src)) {
        rePosition(visibleOverlays[src]);
      }
    }
  });

  return function (e, src) {
    if (window.innerWidth <= cssBreakPoint) {
      return; // prevent on mobile
    }
    if (isVisible(src)) {
      return; // prevent redundant instances
    }
    var pictureContainer = traverseToContainer(e.target);
    var overlay = document.createElement('div');
    overlay.className = "overlay-image";
    visibleOverlays[src] = overlay;
    resetZ();
    pictureContainer.appendChild(overlay);
    overlay.style.width = '100%';
    overlay.style.height = '100%';
    var img = document.createElement("img");
    img.onload = function () {
      overlay.style.width = 'auto';
      overlay.style.height = 'auto';
      rePosition(overlay);
    };
    overlay.appendChild(img);
    img.src = src;
    overlay.addEventListener('click', function () {
      pictureContainer.removeChild(overlay);
      delete visibleOverlays[src];
      resetZ();
    });
  }
})();
