$(document).ready(function() {
  if($('#tire-data').length > 0 || $('#rim-data').length > 0) {
    var showProductData = function() {
      $('#rim-data').hide();
      $('#tire-data').hide();
      var type = $('#type-selector').val();
      if(type == 'rim') {
        $('#rim-data').show();
      } else if(type == 'tire') {
        $('#tire-data').show();
      }
    }

    showProductData();
    $('#type-selector').change(showProductData);
  }
});
