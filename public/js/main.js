function readURL(input) {

    if (input.files && input.files[0]) {
      var reader = new FileReader();
  
      reader.onload = function(e) {
        $('#imagePreview').attr('src', e.target.result);
      };
  
      reader.readAsDataURL(input.files[0]);
    }
  }
  

$('document').ready(function () {
    $('#hamburger').click( function () {
        if($('.category').css('display') === 'none')
            $('.category').css('display', 'block');
        else $('.category').css('display', 'none');
    });

    $('.description_edit').on('keyup change drop paste focusin focusout',function(){
        $(this)
        .attr('rows','1')
        .css('height','auto')
        .css('height',$(this)[0].scrollHeight+'px');
    });

      $("#input__file").change(function() {
        readURL(this);
      });
});