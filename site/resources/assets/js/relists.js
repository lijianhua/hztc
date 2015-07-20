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
        var name  = $('.filter-selected-item').attr('data-name'),
        index = $('.filter-selected-item').attr('data-index');
        if (index)
          key = name + "[" + index + "]";
        else
          key = name;
        url.unset(key);
        $(this).parents('dd').remove()
        url.redirect();
    });
});
