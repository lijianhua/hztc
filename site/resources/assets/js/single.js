$(document).ready(function () {
    $(".single-star-click i").click(function () {
        $(this).addClass('active');
        $(this).prevAll().addClass('active');
        $(this).nextAll().removeClass('active');
        $("#single-heart-index").val($(this).index()+1);
    });

    $(".single-tag .single-tag-item").click(function(){
        $(this).toggleClass('active')
    });
})
