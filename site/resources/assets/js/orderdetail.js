$(document).ready(function(){
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
