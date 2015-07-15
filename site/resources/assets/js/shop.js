/**
 * Created by Administrator on 2015/6/18.
 */
$(document).ready(function(){
    $(".shop-list table input[type=radio]").click(function () {
        var this_text=  $(this).parents('tr').find('.shop-price').text();
        var value = parseInt($(this).parents('tr').find(' .shop-number .shop-enter input').val());
        $(".shop-submit .shop-submit-total span").text(this_text * value)
    })
    $(".shop-number .shop-enter input").attr('readonly','readonly');
    $(".shop-submit .shop-submit-total span").text($(".shop-list table tr:eq(1) .shop-enter input").val() * $(".shop-list table tr:eq(1) .shop-price").text())
    $(".shop-number .shop-add").click(function () {
        if($(this).parents('tr').find('input[type=radio]:checked').val()==0){
           var this_text=  $(this).parents('tr').find('.shop-price').text();
            var value = parseInt($(this).parents('.shop-number').find('.shop-enter input').val());
            value > 100 ? $(this).parents('.shop-number').find('.shop-enter input').val(100) : $(this).parents('.shop-number').find('.shop-enter input').val(value + 1);
            $(".shop-submit .shop-submit-total span").text(this_text * (value+1))
        }
    });
    $('.shop-number .shop-minus').click(function(){
        if($(this).parents('tr').find('input[type=radio]:checked').val()==0) {
            var value = parseInt($(this).parents('.shop-number').find('.shop-enter input').val());
            var this_text=  $(this).parents('tr').find('.shop-price').text();
            value < 2 ? $(this).parents('shop-number').find('.shop-enter input').val(1) : $(this).parents('.shop-number').find('.shop-enter input').val(value - 1);
            //总计价格
            $(".shop-submit .shop-submit-total span").text(this_text * ((value>1)?value-1:value))
        }
    });
});

$('.shop-submit button').click(function(){
  var value_id = $('input[type=radio]:checked').parents('tr').index();
  var aid = $('.aid').eq(value_id-1).val();
  var quantity= $('.quantity').val();
  $("#aid_value").val(aid);
  $("#quantity_value").val(quantity);
    $("#aid_form").submit();
});
$(".settlement-list-submit-button button").click(function(){
    if($(".checkbox input[type=checkbox]").is(':checked') ==true){
        $("#form_id").submit();
    }else{
      alert("请同意我们的协议!")
    }
})
