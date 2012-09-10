$(document).ready(function() {
    $('#hide-watcher').toggle(
        function() {
            $('#watchlist, #searchlist').hide(250);
            if (!$('#right-menu').attr('old-height')) {
                var h = $('#right-menu').height();
              $('#right-menu').attr('old-height', h);
            }
            $('#hide-watcher > a').text('Show');
            $('#right-menu').animate({
                width: '35px',
                height: '20px'
            }, 250);
        }, function() {
            $('#watchlist, #searchlist').show(250);
            var h = $('#right-menu').attr('old-height');
            $('#hide-watcher > a').text('Hide');
            $('#right-menu').animate({
                width: "25%",
                height: h
            }, 250);
    });
});
