function getBaseURL () {
    return location.protocol + "//" + location.hostname+(location.port!=""?':'+location.port:'');
}
var pageYOffset = window.scrollY;
var HANVINA = {
    strip_tags: function(input, allowed) {
        input=input.trim();
        allowed = (((allowed || '') + '')
            .toLowerCase()
            .match(/<[a-z][a-z0-9]*>/g) || [])
            .join(''); // making sure the allowed arg is a string containing only tags in lowercase (<a><b><c>)
        var tags = /<\/?([a-z][a-z0-9]*)\b[^>]*>/gi,
            commentsAndPhpTags = /<!--[\s\S]*?-->|<\?(?:php)?[\s\S]*?\?>/gi;
        return input.replace(commentsAndPhpTags, '')
            .replace(tags, function($0, $1) {
                return allowed.indexOf('<' + $1.toLowerCase() + '>') > -1 ? $0 : '';
            });
    },
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
        $('input,textarea').change(function(){
            $(this).val(HANVINA.strip_tags($(this).val()));
        });
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
    },
    submitPhone: function(){
        $('#btn-phone').click(function(){
            if($('#input-phone').val() == ""){
                $('#input-phone').focus();
            }
        });
    }
}
jQuery(document).ready(function(){
    HANVINA.init();
    HANVINA.scroll();
    HANVINA.submitPhone();
})