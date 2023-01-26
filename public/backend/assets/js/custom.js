$(document).ready(function () {

  /*====================================================
                   load-function
   ====================================================*/

  $(window).on('load', function () {
    $('#status').fadeOut() // will first fade out the loading animation 
    $('#preloader').delay(350).fadeOut('slow') // will fade out the white DIV that covers the website. 
    $('body').delay(350).css({ 'overflow': 'visible' })
  })

  // CounterUp Plugin || Toastr
  setTimeout(function () {
    toastr.options = {
      closeButton: true,
      progressBar: true,
      showMethod: 'fadeIn',
      hideMethod: 'fadeOut',
      timeOut: 5000
    }
    if (successNotification) toastr.success(successNotification, 'Success !')
    if (infoNotification) toastr.info(infoNotification, 'Information !')
    if (warningNotification) toastr.warning(warningNotification, 'Warning !')
    if (errorNotification) toastr.error(errorNotification, 'Error !')
  }, 1800)


  var hiddenMailOptions = function () {
    if ($('.checkbox-mail:checked').length) {
      $('.mail-hidden-options').css('display', 'inline-block');
    } else {
      $('.mail-hidden-options').css('display', 'none');
    };
  };

  hiddenMailOptions();

  $('.check-mail-all').click(function () {
    $('.checkbox-mail').click();
  });

  $('.checkbox-mail').each(function () {
    $(this).click(function () {
      if ($(this).closest('tr').hasClass("checked")) {
        $(this).closest('tr').removeClass('checked');
        hiddenMailOptions();
      } else {
        $(this).closest('tr').addClass('checked');
        hiddenMailOptions();
      }
    });
  });

  $('.mailbox-content table tr td').not(":first-child").on('click', function (e) {
    e.stopPropagation();
    e.preventDefault();

    window.location = "message-view.html";
  });

  // Summernote Text Editor

  $('.summernote').summernote({
    height: 250
  });


})


// preview an image when uploading
function previewImage(whereToShow, imageFile) {
  document.getElementById(whereToShow).src = window.URL.createObjectURL(imageFile[0])
}

// Push slug
function pushSlug(text, id) {
  let trimmedText = text.trim()
  if (trimmedText.length > 0) document.getElementById(id).value = trimmedText.replaceAll(' ', '-').toLowerCase();
}

// CKEditor
var options = {
  filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
  filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
  filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
  filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
};

CKEDITOR.replace('my-editor', options);