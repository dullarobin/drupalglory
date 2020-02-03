(function($) {
$(document).ready(function($) {
  // Code that uses jQuery's $ can follow here.

  $('#edit-quick-select-amount input[type="radio"]').click(function(){
    if ($(this).is(':checked'))
    {
      var value_v = $(this).val();
	   var test_l = $("#edit-custom-amount").val(value_v);
    }
  });
});
})(jQuery);
