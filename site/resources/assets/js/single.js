$(document).ready(function () {
    $(".single-star-click i").click(function () {
        $(this).addClass('active');
        $(this).prevAll().addClass('active');
        $(this).nextAll().removeClass('active');
    });

    $(".single-tag .single-tag-item").click(function(){
        $(this).toggleClass('active')
    });
})