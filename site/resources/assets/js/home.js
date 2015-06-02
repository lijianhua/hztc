$(document).ready(function() {

    // 轮播图
    $(".nav-banner .item").each(function (i) {
        $(this).attr('tag',i)
    })
    $('.carousel').carousel({
        "pause": "false",
        "interval": 2000
    });
    $('.carousel').on('slide.bs.carousel', function (event) {
        var itemIndex = parseInt($(event.relatedTarget).attr("tag"));
        Itempage(itemIndex)
    });

     //特色推荐

    $(".lay-tab-item a").hover(function(event){
        var index = $(this).parent().index()*-235;
        event.preventDefault();
        $(this).parent().siblings().find('a').removeClass('active');
        $(this).addClass('active')
        $('.lay-block').animate({'margin-top':index},500);
    })


    //价格点击选择我
    $(".menu-price-item a").click(function(event){
        event.preventDefault();
        $(this).addClass('active');
        $(this).parent().siblings().children('a').removeClass('active')
    });

    //搜索框下拉检索
    $(".search-input #search").focus(function(){
        $(".search-indexes").show();
    })
    $(".search-input #search").blur(function(){
        $(".search-indexes").hide();
    });


    $(".change-menu a").click(function(){
        $(this).addClass('active');
        $(this).parent().siblings().children('a').removeClass('active');
    })
    $(".menu-item").hover(function(){
        $(this).find('.change-menu').show();
        $(this).siblings().find('.change-menu').hide();
    },function(){
        $(".menu-item .change-menu").hide();
    })


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
