$(document).ready(function() {
    $('#hide-watcher').toggle(
        function() {
            $('#watchlist, #searchlist').hide(250);
            var h = $('#right-menu').height();
            $('#right-menu').attr('old-height', h);
            $('#right-menu').animate({
                width: '35px',
                height: '20px'
            }, 250);
        }, function() {
            $('#watchlist, #searchlist').show(250);
            var h = $('#right-menu').attr('old-height');
            $('#right-menu').animate({
                width: "25%",
                height: h
            }, 250);
    });
});
