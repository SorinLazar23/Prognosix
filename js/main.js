jQuery(document).ready(function($){

    $('.meniu-note label').on('click', function(){
        $('.meniu-note label.active').removeClass('active');
        $(this).addClass('active');
    });

    $('.refreshNews').click(function(){

        $.ajax({
            'url': 'http://localhost/Prognosix/newsFeed.php',
            'type': 'post',
            'success': function(data, textStatus, jqXHR){
                $('.newsfeed').html(data);
            },
            error: function(jqXHR, textStatus, error){
                $('.newsfeed').html('<p>Service is unavailable.</p>');
            }
        });
    });

    $.ajax({
        'url': 'http://localhost/Prognosix/newsFeed.php',
        'type': 'post',
        'success': function(data, textStatus, jqXHR){
            $('.newsfeed').html(data);
        },
        error: function(jqXHR, textStatus, error){
            $('.newsfeed').html('<p>Service is unavailable.</p>');
        }
    });
});