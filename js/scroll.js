// JavaScript Document

$(document).ready(function() {
    var i = 0;
    $(".marqueeElement").each(function() {
          var $this = $(this);
          $this.css("top", i);
          i += 90;
          doScroll($this);
    });
});

    function doScroll($ele) {
        var top = parseInt($ele.css("top"));
        if(top < -20) {
            top = 450;
            $ele.css("top", top);
        }
        $ele.animate({ top: (parseInt(top)-60) },1900,'linear', function() {doScroll($(this))});
    }