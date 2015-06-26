/**
 * Created by Administrator on 2015/6/18.
 */
$(document).ready(function(){
    $(".shop-number .shop-enter input").attr('readonly','readonly');
    $(".shop-number .shop-add").click(function () {
        var value = parseInt($(this).parents('.shop-number').find('.shop-enter input').val());
        value > 100 ? $(this).parents('.shop-number').find('.shop-enter input').val(100) : $(this).parents('.shop-number').find('.shop-enter input').val(value + 1);
        //总计价格
        var this_number = 0;
        $(".shop-list table tr").each(function (key,value) {
            if(key != 0){
                var this_text = parseInt($(this).find(".shop-price span").text())*parseInt($(this).find('.shop-number .shop-enter input').val());
                $(".shop-submit .shop-submit-total span").text(this_number += this_text)
            }

        })
    });
    $('.shop-number .shop-minus').click(function(){
        var value = parseInt($(this).parents('.shop-number').find('.shop-enter input').val());
        value <= 0 ? $(this).parents('shop-number').find('.shop-enter input').val(0) : $(this).parents('.shop-number').find('.shop-enter input').val(value - 1);
        //总计价格
        var this_number = 0;
        $(".shop-list table tr").each(function (key,value) {
            if(key != 0){
                var this_text = parseInt($(this).find(".shop-price span").text())*parseInt($(this).find('.shop-number .shop-enter input').val());
                $(".shop-submit .shop-submit-total span").text(this_number += this_text)
            }
        })
    });
})
