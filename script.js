$(document).ready(function() {
    $('#hide-watcher').toggle(
        function() {
            $('#hide-watcher > a').blur();
            $('#watchlist, #searchlist').hide(250);
            if (!$('#right-menu').attr('old-height')) {
                var h = $('#right-menu').height();
              $('#right-menu').attr('old-height', h);
            }
            $('#hide-watcher > a').text('Show');
            $('#right-menu').animate({
                width: '42px',
                height: '22px'
            }, 250);
        }, function() {
            $('#hide-watcher > a').blur();
            $('#watchlist, #searchlist').show(250);
            var h = $('#right-menu').attr('old-height');
            $('#hide-watcher > a').text('Hide');
            $('#right-menu').animate({
                width: "25%",
                height: h
            }, 250);
    });
});
