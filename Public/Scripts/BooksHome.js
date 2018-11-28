/**
 * Created by hp on 1/26/2017.
 */

$( document ).ready(function() {
    bookSelect();
});
function bookSelect(){


    $('.bookHomeCardItem').click(function () {
        var handle = $(this).attr('data-handle');
        window.location.href = 'book/'+handle;
    });
}