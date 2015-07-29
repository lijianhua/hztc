/**
 * Created by Administrator on 2015/6/17.
 */

$(document).ready(function () {

    

    $(".filter-operate-block dt").click(function () {
        var filter_this = $(this).attr('class');
        if(filter_this == undefined || filter_this == ""){
                $(this).addClass('active_show');
                $(this).find('span').removeClass('filter-mark');
                $(this).find('span').addClass('filter-mark-active');
                $(this).parent().siblings().find('dt span').removeClass('filter-mark-active');
                $(this).parent().siblings().find('dt span').addClass('filter-mark');
                $(this).parent().find('dd').show();
                $(this).parent().siblings().children('dd').hide();
            }else{
              $(this).find('span').addClass('filter-mark');
              $(this).find('span').removeClass('filter-mark-active');
              $(this).removeClass('active_show');
              $(this).parent().find('dd').hide();
        }
    });
    //点击添加筛选

    $(".filter-operate-block dd").click(function () {
        var filter_0 = [];
        var filter_1 = [];
        var filter_2 = [];
        var filter_3 = [];
        var filter_4 = [];
        var filter_5 = [];
        var filter_6 = [];
        var text = $(this).text();
        var index_array = $(this).parents('dl').index();
        var filter = $(this).attr("rel");
        var add_text = true;;
        $(".filter-selected dd").each(function (key,value) {
            if(text == $(this).text()){
                add_text = false;
            }
        })
        if(add_text){
            $(".filter-selected dl").append("<dd rel='"+filter+"' class='filter-selected-item'><i>"+text+"</i><span class='filter-delete'></span></dd>");
         
            $(".filter-selected dl dd").each(function(a,b){
                var this_filter = parseInt($(this).attr('rel'));
                if(this_filter == 0){
                    filter_0.push($(this).text())
                }else if(this_filter == 1){
                    filter_1.push($(this).text())
                }else if(this_filter == 2){
                    filter_2.push($(this).text())
                }else if(this_filter == 3){
                    filter_3.push($(this).text())
                }else if(this_filter == 4){
                    filter_4.push($(this).text())
                }else if(this_filter == 5){
                    filter_5.push($(this).text())
                }else if(this_filter == 6){
                    filter_6.push($(this).text())
                }else{
                    alert("不争取的选项");
                }
                
            })
            // alert(filter_0)
            // alert(filter_1)
            // alert(filter_2)
            // alert(filter_3)
            // alert(filter_4)
            // alert(filter_5)
            // alert(filter_6)
            
        }
    });

    //删除筛选

    // $(".filter-selected dl").on ('click','.filter-delete',function () {
    //     $(this).parents('dd').remove()
    // });

    $(".filter-recommend-item").hover(function () {
        $(this).find('.filter-recommend-item-bg').fadeIn();
    }, function () {
        $(this).find('.filter-recommend-item-bg').fadeOut();
    });

    $('.list-info-item').hover(function(){
        $(this).find('.list-info-item-follow').fadeIn();
    }, function () {
        $(this).find('.list-info-item-follow').fadeOut();
    })


})
