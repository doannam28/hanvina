function getBaseURL () {
    return location.protocol + "//" + location.hostname+(location.port!=""?':'+location.port:'');
}
var pageYOffset = window.scrollY;
var HANVINA = {
    init: function(){
// Get the video
        var video = document.getElementById("myVideo");

// Get the button
        var btn = document.getElementById("myBtn");

// Pause and play the video, and change the button text
        function myFunction() {
            if (video.paused) {
                video.play();
                btn.innerHTML = "Pause";
            } else {
                video.pause();
                btn.innerHTML = "Play";
            }
        }
    },
    scroll:function () {
        function scrolled(event){
            if(pageYOffset > window.scrollY && window.scrollY > 120){
                $(".navbar").addClass('navbar-red');
            }else{
                $(".navbar").removeClass('navbar-red');
            }
            pageYOffset = window.scrollY;
        }
        window.addEventListener('scroll', scrolled);
    }
}
jQuery(document).ready(function(){
    HANVINA.init();
    HANVINA.scroll();
})