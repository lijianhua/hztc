/**
 * Created by Administrator on 2015/6/24.
 */
$(document).ready(function(){
    $(".advertisers-add").click(function () {
        $(this).parents('.advertisers-personal-block').append('<div class="advertisers-personal-enter"> <strong>从属公司</strong><br/> <span><input type="text"><span class="advertisers-delete"></span></span> </div>')
    });

    $(".advertisers-personal-block").on("click",".advertisers-delete",function () {
        $(this).parents(".advertisers-personal-enter").remove();
    });


    $(".advertisers-tab a:eq(0)").click(function () {
        $(this).addClass("active");
        $(this).siblings().removeClass("active");
        $(".advertisers-personal").show();
        $(".advertisers-company").hide();
    })
    $(".advertisers-tab a:eq(1)").click(function () {
        $(this).addClass("active");
        $(this).siblings().removeClass("active");
        $(".advertisers-company").show();
        $(".advertisers-personal").hide();
    });


    //$("input[type=file]").change(function () {
    //    var this_id = $(this).attr('id');
    //    var parent_id = $(this).parents('.advertisers-company-bg').find('.advertisers-company-info').attr('id');
    //    var img_id = $(this).parents('.advertisers-company-bg').find('img').attr('id');
    //    new uploadPreview({ UpBtn: this_id, DivShow: parent_id, ImgShow: img_id });
    //})
});
window.onload = function () {
    new uploadPreview({ UpBtn: "up_img", DivShow: "imgdiv", ImgShow: "imgShow" });
    new uploadPreview({ UpBtn: "up_img2", DivShow: "imgdiv2", ImgShow: "imgShow2" });
    new uploadPreview({ UpBtn: "up_img3", DivShow: "imgdiv3", ImgShow: "imgShow3" });
}





