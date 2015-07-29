$(document).ready(function(){
    $(".order-details-mark-line").width($(".order-details-flow-item.active").offset().left-$(".order-details-flow-info").offset().left);
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
