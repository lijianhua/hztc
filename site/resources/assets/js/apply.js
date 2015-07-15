$(document).ready(function () {
    $(".apply-info-number .apply-enter input").attr('readonly','readonly');
    $(".apply-info-number .apply-add").click(function () {
        var value = parseInt($(this).parents('.apply-info-number').find('.apply-enter input').val());
        value > 100 ? $(this).parents('.apply-info-number').find('.apply-enter input').val(100) : $(this).parents('.apply-info-number').find('.apply-enter input').val(value + 1);
        //总计价格

    });
    $('.apply-info-number .apply-minus').click(function(){
        var value = parseInt($(this).parents('.apply-info-number').find('.apply-enter input').val());
        value <= 1 ? $(this).parents('apply-info-number').find('.apply-enter input').val(1) : $(this).parents('.apply-info-number').find('.apply-enter input').val(value - 1);
        //总计价格
    });
});
