    $(document).ready(function() {
        var offset =
            ($(window).width() - $('#right-menu').width() -
             $('.thread:first').width() - 40) / 2;
        $('.thread, .reply').each(function () {
            $(this).animate({marginLeft: '+=' + offset}, 0);
        });
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
            });
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
        $('#postform').hide();
	$('#action').click(
	function(){
	$('#postform').toggle(250);
	});
	
	$('#reply_input').hide();
	$('#reply_hide').toggle(
	function(){
	$('#reply_input').show(250);
	$('#reply_hide > a').text('Hide');
	$('#reply_hide').css('background-color','#334F47');
	},
	function(){
	$('#reply_input').hide(250);
	$('#reply_hide > a').text('Reply');
	$('#reply_hide').css('background-color','#363636');
	});
	});
    
