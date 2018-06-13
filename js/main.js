jQuery(document).ready(function($){

    $('.meniu-note label').on('click', function(){
        $('.meniu-note label.active').removeClass('active');
        $(this).addClass('active');
    })
});