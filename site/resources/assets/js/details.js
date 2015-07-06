$(document).ready(function () {
    $(".details-info-amount .details-amount-input input").attr('readonly','readonly');
    var details_index = 0;
    var itemwidth = $(".details-picture-tab-item").width()+20;
    var itemlength = $(".details-picture-tab-item").length;


    $(".details-picture-tab-item").click(function(){
        var index = $(this).index();
        $(this).addClass('active');
        $(this).siblings().removeClass('active');
        $(".details-picture-img span").eq(index).show();
        $(".details-picture-img span").eq(index).siblings().hide();
    });

    //点击向右
    $(".details-picture-tab .details-picture-tab-right").click(function () {
        if(itemlength > 6){
            if(details_index <= -(itemlength-6)){
                details_index = -(itemlength-6);
            }else{
                details_index -=1;
                $(".details-picture-tab-line").animate({"margin-left":itemwidth*details_index},500);
            }
        }
    });

    //点击向左
    $(".details-picture-tab .details-picture-tab-left").click(function () {
        if(itemlength > 6){
            if(details_index >= 0){
                details_index = 0;
            }else{
                details_index += 1;
                $(".details-picture-tab-line").animate({"margin-left":itemwidth*details_index},500);
            }
        }
    });




    $(".details-info-amount .details-amount-plus").click(function () {
        var value = parseInt($(this).parents('.details-info-amount').find('.details-amount-input input').val());
        value > 100 ? $(this).parents('.details-info-amount').find('.details-amount-input input').val(100) : $(this).parents('.details-info-amount').find('.details-amount-input input').val(value + 1);
        //总计价格

    });
    $('.details-info-amount .details-amount-minus').click(function(){
        var value = parseInt($(this).parents('.details-info-amount').find('.details-amount-input input').val());
        value <= 1 ? $(this).parents('details-info-amount').find('.details-amount-input input').val(1) : $(this).parents('.details-info-amount').find('.details-amount-input input').val(value - 1);
        //总计价格
    });

    //点击关注
    $(".details-info-concerned").one('click',function () {
        var concerned = parseInt($(this).find(".details-info-concerned-number span").text());
        $(this).find(".details-info-concerned-number span").text(concerned+1)
    });

    //点击收藏
    $(".details-info-collection").one('click', function () {
        $(this).find('i').removeClass('fa-star-o');
        $(this).find('i').addClass('fa-star');
    })

    $(".introduction-list-title span:eq(0)").click(function(){
        $(this).addClass('active');
        $(this).siblings().removeClass('active');
        $(".introduction-advert").show();
        $(".introduction-consumer").hide();
    });
    $(".introduction-list-title span:eq(1)").click(function(){
        $(this).addClass('active');
        $(this).siblings().removeClass('active');
        $(".introduction-consumer").show();
        $(".introduction-advert").hide();
    });
})