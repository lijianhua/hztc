$(document).ready(function(){
    $(".filter-nav-menu li").click(function(){
        var text = $(this).text();
        $(this).parents(".btn-group").find("button b").text(text)
    });


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
