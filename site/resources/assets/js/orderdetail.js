$(document).ready(function(){

  if($(".order-new-line .order-details-flow-item").attr('class') != undefined){
     $(".order-new-line .order-details-mark-line").width($(".order-new-line .order-details-flow-item.active").offset().left-$(".order-new-line .order-details-flow-info").offset().left);
  }
    $(".order-over a").click(function(event){
        var this_id = $(this).attr('href');
        $.ajax({
            url:'/users/endorder',
            type:'POST',
            data:{oid:this_id},
            success:function(data){
              location.reload();
            }
        })
        event.preventDefault();

    })
});
