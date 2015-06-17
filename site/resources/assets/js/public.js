$(document).ready(function(){
    var flash = true;

    //nav ���������ѡ��
    $(".filter-nav-menu li").click(function(){
        var text = $(this).text();
        $(this).parents(".btn-group").find("button b").text(text)
    });

    $(".nav-search-menu li span").click(function () {
        flash = false;
        var text = $(this).text();
        $(this).parents(".button-classify").find(".nav-classify b").text(text)
    })

    // �ֲ�ͼ
    $(".nav-banner .item").each(function (i) {
        $(this).attr('tag',i)
    })
    $('.carousel').carousel({
        "pause": "false",
        "interval": 2000
    });
    $('.carousel').on('slide.bs.carousel', function (event) {
        var itemIndex = parseInt($(event.relatedTarget).attr("tag"));
        Itempage(itemIndex);
    });




    $(".nav-search").click(function () {
        $(".nav-search").animate({"width":255},500, function () {
            $(this).css({'overflow':'inherit'});
        });
    })

    //search ������������ʾ
    $(document).bind("click",function(e){
        var target = $(e.target);
        if(target.closest(".nav-search").length == 0){
            $(".nav-search").animate({"width":50},500, function () {
                $(this).css({'overflow':'hidden'});
            });
        }else{
            $(".nav-search").animate({"width":255},500, function () {
                $(this).css({'overflow':'inherit'});
            });
        }
    });

    //���ض���
    $(".float-top").click(function () {
        $("body,html").animate({"scrollTop":0},500);
    });
})

//bootstrap �ֲ�ͼ
function switchPage(pageIndex){
    $('.carousel').carousel(pageIndex);

}

//�ֲ�ͼtabt
function Itempage(tag){
    $(".banner-mark .banner-mark-item").eq(tag).addClass('active');
    $(".banner-mark .banner-mark-item").eq(tag).siblings().removeClass('active');
}
