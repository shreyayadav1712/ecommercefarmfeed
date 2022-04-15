window.addEventListener("load", function() {
  //   var load_screen = document.getElementById("load_screen");
  //   document.body.removeChild(load_screen);
  // });
    function removeFadeOut(el, speed) {
        var seconds = speed / 1000;
        el.style.transition = "opacity " + seconds + "s ease";

        el.style.opacity = 0;
        setTimeout(function() {
            el.parentNode.removeChild(el);
        }, speed);
    }

    removeFadeOut(document.getElementById('load_screen'), 500);
});
