$(document).ready(function () {
    $(".spike .filter-recommend-item").hover(function () {
        $(this).find('.filter-recommend-item-bg').fadeIn();
    }, function () {
        $(this).find('.filter-recommend-item-bg').fadeOut();
    });
    $(".spike-item .spike-picture").hover(function () {
        $(this).find(".spike-bottom").animate({bottom:0},500);
        $(this).parents('.spike-item').siblings().find('.spike-bottom').animate({bottom:-($(this).height())},0);
    },function(){
        $(this).find(".spike-bottom").animate({bottom:-($(this).height())},500);
    })

    spike();
    setInterval(spike,1000);
})

function spike(){
    $(".spike-item").each(function(a,b){
        //获取当前日期，以及秒杀开始，截止时期
        var now = new Date();
            //var st = $(this).attr('date-start').split(/[\s:-]/g);
            //var ed = $(this).attr('date-end').split(/[\s:-]/g);
            //var st_date = new Date(st[0],st[1],st[2],st[3],st[4],st[5]);
            //var ed_date = new Date(ed[0],ed[1],ed[2],ed[3],ed[4],ed[5]);
        if((Date.parse($(this).attr('date-start').replace(/-/g,"/")) - Date.parse(now)) > 0){
            $(this).find(".spike-mark").addClass('spike-wait');
            var time_diff = Date.parse($(this).attr('date-start').replace(/-/g,"/")) - Date.parse(now);

            var total_seconds = parseInt(time_diff/1000);
            var ed_day = Math.floor(total_seconds/(60*60*24));

            var ed_hour=Math.floor((total_seconds-ed_day*24*60*60)/3600);

            var ed_minute=Math.floor((total_seconds-ed_day*24*60*60-ed_hour*3600)/60);
            var ed_second=Math.floor(total_seconds-ed_day*24*60*60-ed_hour*3600-ed_minute*60);
            $(this).find(".spike-info-date-day i").text(ed_day);
            $(this).find(".spike_hour").text(ed_hour);
            $(this).find(".spike_minute").text(ed_minute);
            $(this).find(".spike_second").text(ed_second);
            $(this).find(".spike-bt a").attr("href","#");
        }else if(Date.parse($(this).attr('date-start').replace(/-/g,"/")) - Date.parse(now) < 0 && Date.parse($(this).attr('date-end').replace(/-/g,"/")) - Date.parse(now) > 0){
            $(this).find(".spike-mark").removeClass('spike-wait');
            var time_diff = Date.parse($(this).attr('date-end').replace(/-/g,"/")) - Date.parse(now);

            var total_seconds = parseInt(time_diff/1000);
            var ed_day = Math.floor(total_seconds/(60*60*24));

            var ed_hour=Math.floor((total_seconds-ed_day*24*60*60)/3600);

            var ed_minute=Math.floor((total_seconds-ed_day*24*60*60-ed_hour*3600)/60);
            var ed_second=Math.floor(total_seconds-ed_day*24*60*60-ed_hour*3600-ed_minute*60);
            $(this).find(".spike-info-date-day i").text(ed_day);
            $(this).find(".spike_hour").text(ed_hour);
            $(this).find(".spike_minute").text(ed_minute);
            $(this).find(".spike_second").text(ed_second);
        }

    });
}




