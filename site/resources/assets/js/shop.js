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
    if($(".shop-list table tr").length <=1){
      $(".shop-submit .shop-submit-total span").text("0");
    }else{
    $(".shop-submit .shop-submit-total span").text($(".shop-list table tr:eq(1) .shop-enter input").val() * $(".shop-list table tr:eq(1) .shop-price").text())
    $('.shop-submit button').click(function(){
      //alert($('.shop-list input[type=radio]:checked').parents('tr').index());
      var value_id = $('input[type=radio]:checked').parents('tr').index();
      var aid = $('.aid').eq(value_id-1).val();
      var quantity= $('.quantity').val();
      $("#aid_value").val(aid);
      $("#quantity_value").val(quantity);
      var value = parseInt($('.shop-number').eq(value_id).find('.shop-enter input').val());
      var pro_id = $('tr').eq(value_id).find("input[name=adspaceid]").val();
      var pro_from = $('tr').eq(value_id).find("input[name=pro_from]").val();
      var pro_to = $('tr').eq(value_id).find("input[name=to]").val();
    
      $.ajax({
        url:'/spacesale',
        type:'POST',
        data:{value_number:value,pro_from:pro_from,pro_to:pro_to,pro_id:pro_id},
        success:function(data){
            
            if(data > 0){
            $("#aid_form").submit();
            }else{
              alert("库存只有"+(parseInt(data)+value));
            }
         }
      });
      //$("#aid_form").submit();
  });};
  $('.shop-number .shop-minus').click(function(){
          if($(this).parents('tr').find('input[type=radio]:checked').val()==0) {
              var value = parseInt($(this).parents('.shop-number').find('.shop-enter input').val());
              var this_text=  $(this).parents('tr').find('.shop-price').text();
              value < 2 ? $(this).parents('shop-number').find('.shop-enter input').val(1) : $(this).parents('.shop-number').find('.shop-enter input').val(value - 1);
              //总计价格
               $(".shop-submit .shop-submit-total span").text(this_text * ((value>1)?value-1:value))
           }
  });
      $(".shop-number .shop-add").click(function () {
        var _this = $(this);
          if(_this.parents('tr').find('input[type=radio]:checked').val()==0){
            var this_text=  _this.parents('tr').find('.shop-price').text();
              var value = parseInt(_this.parents('.shop-number').find('.shop-enter input').val());
              var pro_id = _this.parents('tr').find("input[name=adspaceid]").val();
              var pro_from = _this.parents('tr').find("input[name=pro_from]").val();
              var pro_to = _this.parents('tr').find("input[name=to]").val();
            
              $.ajax({
                url:'/spacesale',
                type:'POST',
                data:{value_number:value,pro_from:pro_from,pro_to:pro_to,pro_id:pro_id},
                success:function(data){
                    var sucess_data = parseInt(data);
                    if(sucess_data < 0){
                     if(value == -sucess_data){
                          _this.parents('.shop-number').find('.shop-enter input').val(0);
                          $(".shop-submit .shop-submit-total span").text(0);
                      }else{
                      value >= (sucess_data+value) ? _this.parents('.shop-number').find('.shop-enter input').val(sucess_data+value) : _this.parents('.shop-number').find('.shop-enter input').val(value + 1);
                      $(".shop-submit .shop-submit-total span").text(this_text * (value+1))
                      } 
                    }else{
                      if(value >= (sucess_data+value)){
                        _this.parents('.shop-number').find('.shop-enter input').val(sucess_data+value);
                        alert("库存只有"+(sucess_data+value));
                      }else{
                        _this.parents('.shop-number').find('.shop-enter input').val(value + 1);
                        $(".shop-submit .shop-submit-total span").text(this_text * (value + 1));
                      }
                     // $(".shop-submit .shop-submit-total span").text(this_text * (value+1));
                  }
              }});
          }
     });
});

//$('.shop-submit button').click(function(){
//  var value_id = $('input[type=radio]:checked').parents('tr').index();
//  var aid = $('.aid').eq(value_id-1).val();
//  var quantity= $('.quantity').val();
//  $("#aid_value").val(aid);
//  $("#quantity_value").val(quantity);
//    $("#aid_form").submit();
//});
$(".settlement-list-submit-button button").click(function(){
    if($(".checkbox input[type=checkbox]").is(':checked') ==true){
        $("#agree_checked").val("1");
        $("#form_id").submit();
    }else{
      $("#agree_checked").val("");
      alert("请同意我们的协议!")
    }
})
