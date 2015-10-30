$(document).ready(function() {
  $(".bank-code-block").click(function(){
    var this_index = $(this).index();
    $("#bank_index").val(this_index);
  })
});
