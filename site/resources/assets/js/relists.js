$(function ($) {
  var url = new YuezUrl();

  $('.filter-operate-block .filter-operate, .page:has(a[data-name]) a').click({'url' : url}, function (e) {
    var url   = e.data.url,
        self  = $(this),
        name  = self.attr('data-name'),
        index = self.attr('data-index'),
        value = self.attr('data-value'),
        param = {};

    if (index)
      key = name + "[" + index + "]";
    else
      key = name;

    e.preventDefault();
    param[key] = value;
    url.set(param);
    url.redirect();
  });
    $(".filter-selected dl").on ('click','.filter-delete',function () {
        var item = $(this).closest('.filter-selected-item'),
            name  = item.attr('data-name'),
            index = item.attr('data-index');
        if (index)
          key = name + "[" + index + "]";
        else
          key = name;
        url.unset(key);
        url.redirect();
    });


    //地域
  $('.filter-mark-change button').click({'url' : url}, function (e) {
    var s_province =  $('#s_province').val();
    var s_city = $('#s_city').val();
    var s_county = $('#s_county').val();

    if(s_province != "" && s_county == "" && s_city == ""){
      value = s_province;
      index = document.getElementById('s_province').selectedIndex;
    }else if(s_province != "" && s_city != "" && s_county == ""){
        value = s_city;
        index = document.getElementById('s_province').selectedIndex+"_"+document.getElementById('s_city').selectedIndex;
    }else if(s_county != "" && s_city != "" && s_province != ""){
      value = s_county;
      index = document.getElementById('s_province').selectedIndex+"_"+document.getElementById('s_city').selectedIndex+"_"+document.getElementById('s_county').selectedIndex;
    }else{return false;}

    var url   = e.data.url,
        self  = $(this),
        name  = 'cities';
        param = {};

    if (index)
      key = name + "[" + index + "]";
    else
      key = name;

    e.preventDefault();
    param[key] = value;
    url.set(param);
    url.redirect();
  });
});
