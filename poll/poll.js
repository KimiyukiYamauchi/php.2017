$(function() {
  'use strict';

  $('.box').on('click', function() {
    $('.box').removeClass('selected');
    $(this).addClass('selected');
    $('#answer').val($(this).data('id'));
  });

  $('#btn').on('click', function() {
    if ($('#answer').val() === '') {
      alert('Choose one!');
    } else {
      $('form').submit();
    }
  });

});