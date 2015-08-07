$(document).ready(function(){
    var flash = true;

    $('[data-toggle="tooltip"]').tooltip();

    //nav 左侧栏下拉选择
    $(".filter-nav-menu li").click(function(){
        var text = $(this).text();
        $(this).parents(".btn-group").find("button b").text(text)
        $(this).parents(".btn-group").find("button input").val(text)
    });

    $(".nav-search-menu li span").click(function () {
        flash = false;
        var text = $(this).text();
        $(this).parents(".button-classify").find(".nav-classify b").text(text)
        $(this).parents(".button-classify").find(".nav-classify input").val(text)
    })

    // 轮播图
    $(".nav-banner .item").each(function (i) {
        $(this).attr('tag',i)
    })
    $('.carousel').carousel({
        "pause": "false",
        "interval": 5000
    });
    $('.carousel').on('slide.bs.carousel', function (event) {
        var itemIndex = parseInt($(event.relatedTarget).attr("tag"));
        Itempage(itemIndex);
    });


$(".nav-search").click(function () {
        $(this).css({'overflow':'inherit'});
        $(".nav-search").animate({"width":255},500, function () {
            $(this).find('.nav-search-bt button').prop('type','submit');
            $(window).keydown(function (event) {
            if(event.keyCode == 13)
            {
                $(this).find('.nav-search-bt button').click()
            }
    });
        });
});
    //sarch 搜索框隐藏显示
    $(document).bind("click",function(e){
        var target = $(e.target);
        if(target.closest(".nav-search").length == 0){
            $(".nav-search").animate({"width":50},500, function () {
                $(this).find('.nav-search-bt button').prop('type','button')
                $(this).css({'overflow':'hidden'});
            });
        }else{
            $(".nav-search").animate({"width":255},500, function () {
                //$(this).css({'overflow':'inherit'});
            });
        }
    });

    //返回顶部
    $(".float-top").click(function () {
        $("body,html").animate({"scrollTop":0},500);
    });


})

//bootstrap 轮播图
function switchPage(pageIndex){
    $('.carousel').carousel(pageIndex);

}

//轮播图tabt
function Itempage(tag){
    $(".banner-mark .banner-mark-item").eq(tag).addClass('active');
    $(".banner-mark .banner-mark-item").eq(tag).siblings().removeClass('active');
}
