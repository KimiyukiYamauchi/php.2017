$(function() {
  'use strict';

  $('.answer').on('click', function() {
    var $selected = $(this);
    var answer = $selected.text();
    // alert(answer);
    $.post('_answer.php', {

    }, function(res) {
      if (answer === res.correct_answer) {
        // correct
        $selected.text(answer + '... CORRECT!');
      } else {
        // wrong
        $selected.text(answer + '... WRONG!');
      }
    });
  });
});