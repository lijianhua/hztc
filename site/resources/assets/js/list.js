/**
 * Created by Administrator on 2015/6/17.
 */

$(document).ready(function () {
    $(".filter-operate dt").click(function () {
        $(this).find('span').removeClass('filter-mark');
        $(this).find('span').addClass('filter-mark-active');
        $(this).parent().siblings().find('dt span').removeClass('filter-mark-active');
        $(this).parent().siblings().find('dt span').addClass('filter-mark');
        $(this).parent().find('dd').show();
        $(this).parent().siblings().children('dd').hide()
    });

    //������ɸѡ

    $(".filter-operate dd").click(function () {
        var text = $(this).text();
        var add_text = true;;
        $(".filter-selected dd").each(function (key,value) {
            if(text == $(this).text()){
                add_text = false;
            }
        })
        if(add_text){
            $(".filter-selected dl").append("<dd class='filter-selected-item'><i>"+text+"</i><span class='filter-delete'></span></dd>")
        }
    });

    //ɾ��ɸѡ

    $(".filter-selected dl").on ('click','.filter-delete',function () {
        $(this).parents('dd').remove()
    })


})