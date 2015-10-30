$(document).ready(function () {
var position_length = $("#position_length").val();
for(var i = 0;i<position_length;i++){
    $(".d_product_position").append('<span class="d_product_position_item">'+(i+1)+'</span>');
    $(".d_product_position_item").eq(0).addClass("active");
}
$(".details-script .details-stage-item[data-position='1']").each(function (index) {
    var this_data_start = $(".details-script .details-stage-item[data-position='1']").eq(index).attr("data-start");
    var this_data_end = $(".details-script .details-stage-item[data-position='1']").eq(index).attr("data-end");
    var this_data_price = $(".details-script .details-stage-item[data-position='1']").eq(index).attr("data-price");
    var this_data_zprice = $(".details-script .details-stage-item[data-position='1']").eq(index).attr("data-zprice");
    var this_data_priceid = $(".details-script .details-stage-item[data-position='1']").eq(index).attr("data-priceid");
    var this_data_count= $(".details-script .details-stage-item[data-position='1']").eq(index).attr("data-sale-count");
    $(".d_product_time").append('<span class="d_product_time_item" data-priceid="'+this_data_priceid+'" data-price="'+this_data_price+'" data-zprice="'+this_data_zprice+'" data-sale-count="'+this_data_count+'">'+this_data_start+'--'+this_data_end+'</span>');
    $(".d_product_time_item").eq(0).addClass("active");
    $(".d_product_time_item").eq(0).siblings().removeClass("active"); 
});
//            $(".details-script .details-stage-item[data-position='1']").eq(0).attr("data-price");
$(".data-price").text($(".details-script .details-stage-item[data-position='1']").eq(0).attr("data-price"));
$(".data-zprice").text($(".details-script .details-stage-item[data-position='1']").eq(0).attr("data-zprice"));

$(".d_product_position_item").click(function () {

    $(".d_product_time_item").remove();
    var this_index = $(this).index();
    $(this).addClass("active");
    $(this).siblings().removeClass("active");
    $(".details-script .details-stage-item[data-position="+this_index+"]").each(function (index) {
        var this_data_start = $(".details-script .details-stage-item[data-position="+this_index+"]").eq(index).attr("data-start");
        var this_data_end = $(".details-script .details-stage-item[data-position="+this_index+"]").eq(index).attr("data-end");
        var this_data_price = $(".details-script .details-stage-item[data-position="+this_index+"]").eq(index).attr("data-price");
        var this_data_zprice = $(".details-script .details-stage-item[data-position="+this_index+"]").eq(index).attr("data-zprice");
        var this_data_priceid = $(".details-script .details-stage-item[data-position="+this_index+"]").eq(index).attr("data-priceid");
        var this_data_count= $(".details-script .details-stage-item[data-position="+this_index+"]").eq(index).attr("data-sale-count");
        $(".d_product_time").append('<span class="d_product_time_item" data-priceid="'+this_data_priceid+'" data-price="'+this_data_price+'" data-zprice="'+this_data_zprice+'" data-sale-count="'+this_data_count+'">'+this_data_start+'--'+this_data_end+'</span>');
        $(".d_product_time_item").eq(0).addClass("active");
    })
    $(".data-price").text($(".details-script .details-stage-item[data-position="+this_index+"]").eq(0).attr("data-price"));
    $(".data-zprice").text($(".details-script .details-stage-item[data-position="+this_index+"]").eq(0).attr("data-zprice"));
    $(".d_product_time_item").click(function () {
        $(".data-price").text($(this).attr("data-price"));
        $(".data-zprice").text($(this).attr("data-zprice"));
        $(this).addClass("active");
        $(this).siblings().removeClass("active");
    })
});
$(".d_product_time_item").click(function () {
    $(".data-price").text($(this).attr("data-price"));
    $(".data-zprice").text($(this).attr("data-zprice"));
    $(this).addClass("active");
    $(this).siblings().removeClass("active");
})
});
$(document).ready(function(){
    $(".details-amount-plus").click(function () {
        var value = parseInt($(this).parents('.details-amount').find('.details-amount-input input').val());
        value > 100 ? $(this).parents('.details-amount').find('.details-amount-input input').val(100) : $(this).parents('.details-amount').find('.details-amount-input input').val(value + 1);
        //总计价格
    });
    $('.details-amount-minus').click(function(){
        var value = parseInt($(this).parents('.details-amount').find('.details-amount-input input').val());
        value <= 1 ? $(this).parents('details-amount').find('.details-amount-input input').val(1) : $(this).parents('.details-amount').find('.details-amount-input input').val(value - 1);
        //总计价格
    });

    //示意图
    var details_index = 0;
    var itemlength = $(".d_product_small-img .d_product_small_item").length;

    $(".d_product_small-img .d_product_small_item").click(function () {
        var this_index = $(this).index();
        var img_height = $(".d_product_img_line_info a:eq("+this_index+") img").height()+3;
        $(".d_product_img_line_info").animate({"margin-top":-(img_height*this_index)},500);
        $(this).addClass('active');
        $(this).siblings().removeClass('active');
    });


    //点击向右
    $(".d_product_small_down").click(function () {
        var img_height = $(".d_product_small-img .d_product_small_item").height()+10;
        if(itemlength > 5){
            if(details_index >= itemlength-5){
                details_index = itemlength-5;
            }else{
                details_index +=1;
            $(".d_product_small-img").animate({"margin-top":-(img_height*details_index)},500);
            }
        }
    });

    //点击向左
    $(".d_product_small_top").click(function () {
        var img_height = $(".d_product_small-img .d_product_small_item").height()+10;
        if(itemlength > 5){
            if(details_index <= 0){
                details_index = 0;
            }else{
                details_index -= 1;
                $(".d_product_small-img").animate({"margin-top":-(img_height*details_index)},500);
            }
        }
    });

    $(".d_details_title_item:eq(0)").click(function(){
        $(this).addClass('active');
        $(this).siblings().removeClass('active');
        $(".d_details_content_info").show();
        $(".d_comment").hide();
    })
    $(".d_details_title_item:eq(1)").click(function(){
        $(this).addClass('active')
        $(this).siblings().removeClass('active');
        $(".d_details_content_info").hide();
        $(".d_comment").show();
    })


    $(".c_details_side").hover(function(){
        $(".c_details_side_hover").stop().animate({"right":0},10,function(){
            $(".c_details_side").stop().animate({"right":0},200)
        });
    }, function () {
        $(".c_details_side").stop().animate({"right":"-40px"},200,function(){
            $(".c_details_side_hover").stop().animate({"right":"40px"},10)
        });

    });


    //加入购物车
    $(".details-buy-now button,.details-cart button").click(function(event){
        var user_id = $("#user_id").val();
        var data_sale_count = $(".details-stage-item.active").attr('data-sale-count');
        var price_id  = $('.details-stage-block .details-stage-item.active').attr('data-priceid');
        var product_id = $("#ad_space_id_to").val();
        var count = $("#details-amount-count").val();
        if(user_id > 0 && data_sale_count >0){
          $.ajax({
              type:'post',
              url:'/cart/addcart',
              data:{'price_id':price_id,'product_id':product_id,'count':count},
              headers  :{'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')}, 
              success:function(data){
                if(event.target.id == "details_id_now"){
                    window.location.href="/cart";
                }else if(event.target.id == "details_id_cart"){
                    window.location.href="/cart";
                }
              }
          });
       }else{
        window.location.href="/auth/login";
       }
    });

    //收藏
    $(".d_product_star").click(function(){
      $(this).removeClass('no')
    });

    $(".d_product_bt_buy,.d_product_bt_look").click(function(event){
        var user_id = $("#user_id").val();
        var data_sale_count = $('.d_product_time_item.active').attr('data-sale-count');
        var price_id  = $('.d_product_time_item.active').attr('data-priceid');
        var product_id = $("#ad_space_id_to").val();
        var count = $("#details-amount-count2").val();
        if(user_id > 0 && data_sale_count >0){
          $.ajax({
              type:'post',
              url:'/cart/addcart',
              data:{'price_id':price_id,'product_id':product_id,'count':count},
              headers  :{'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')}, 
              success:function(data){
                  window.location.href="/cart";
              }
          });
       }else{
        window.location.href="/auth/login";
       }
    });

});
//加入对比
function addContrast(id){
  $.ajax({
    type:'post',
    url:'/addContrast',
    data:{'id':id},
    success:function(data){
      if(data.state == "0"){
        alert("加入对比失败!");
      }else{
        $(".d_product_bt_contrast").addClass("add");
        $(".d_product_bt_contrast").attr("onclick","delContrast("+id+")");
      }
    }
  })
}



//取消对比
function delContrast(id){
  $.ajax({
    type:'post',
    url:'/delContrast',
    data:{'id':id},
    success:function(data){
      if(data.status == "fail"){
        alert("取消对比失败!");
      }else{
        $(".d_product_bt_contrast").removeClass("add");
        $(".d_product_bt_contrast").attr("onclick","addContrast("+id+")")
      }
    }
  })
}
