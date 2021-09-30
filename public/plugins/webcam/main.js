(function(undefined) {
    "use strict";
    function Q(el) {
        if (typeof el === "string") {
            var els = document.querySelectorAll(el);
            return typeof els === "undefined" ? undefined : els.length > 1 ? els : els[0];
        }
        return el;
    }
    var play = Q("#play"),
    args = {
        resultFunction: function(res) {
            console.log(res.code);
             // Write Ajax Here...
        }
        
    };
    var decoder = new WebCodeCamJS("#webcodecam-canvas").buildSelectMenu("#camera-select", "environment|back").init(args);
    play.addEventListener("click", function() {
        decoder.play();
    }, false);
  
    document.querySelector("#camera-select").addEventListener("change", function() {
        if (decoder.isInitialized()) {
            decoder.stop().play();
        }
    });
}).call(window.Page = window.Page || {});