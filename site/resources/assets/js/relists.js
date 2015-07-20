$(function ($) {
  var url = new YuezUrl();

  $('.filter-operate-block .filter-operate, .page a').click({'url' : url}, function (e) {
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
});
