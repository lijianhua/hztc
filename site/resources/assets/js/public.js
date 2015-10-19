$(document).ready(function(){
    var flash = true;

    $('[data-toggle="tooltip"]').tooltip();
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
    $('.m_nav_search_bt').click(function(){
        $('.m_nav_search_info_bg').show();
        $('.m_nav_search_bt').css('visibility','hidden');
    });

    $(document).bind("click",function(e){
        var target = $(e.target);
        if(target.closest(".m_nav_search").length == 0){
            $(".m_nav_search_info_bg").hide();
            $('.m_nav_search_bt').css('visibility','visible');
        }
    })

    //×ó²à
    $(".left_nav_change_option li").click(function(){
        var text = $(this).text();
        $(this).parents(".btn-group").find("button").text(text)
    });

    //ÂÖ²¥Í¼
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

    //·µ»Ø¶¥²¿
    var win_height = $(window).height();
    $(document).scroll(function(){
        if($(window).scrollTop() > win_height){
            $(".right-float").fadeIn(700);
        }else{
            $(".right-float").hide();
        }
    })
    $(".float-top").click(function () {
        $("body,html").animate({"scrollTop":0},500);
    });

    $(".m_nav_search_info .dropdown-menu li a").click(function(){
        $(this).parents(".m_nav_search_info").find("button b").text($(this).text())
    })

});

//bootstrap ÂÖ²¥Í¼
function switchPage(pageIndex){
    $('.carousel').carousel(pageIndex);

}

//ÂÖ²¥Í¼tabt
function Itempage(tag){
    $(".banner-mark .banner-mark-item").eq(tag).addClass('active');
    $(".banner-mark .banner-mark-item").eq(tag).siblings().removeClass('active');
}
