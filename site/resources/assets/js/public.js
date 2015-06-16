$(document).ready(function(){
    $(".filter-nav-menu li").click(function(){
        var text = $(this).text();
        $(this).parents(".btn-group").find("button b").text(text)
    });


    // ÂÖ²¥Í¼
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
})

//bootstrap ÂÖ²¥Í¼
function switchPage(pageIndex){
    $('.carousel').carousel(pageIndex);

}

//ÂÖ²¥Í¼tabt
function Itempage(tag){
    $(".banner-mark .banner-mark-item").eq(tag).addClass('active');
    $(".banner-mark .banner-mark-item").eq(tag).siblings().removeClass('active');
}
