$(function() {
  'use strict';

  // update
  $('#todos').on('click', '.update_todo', function() {
    // idを取得
    var id = $(this).parents('li').data('id');
    // console.log(id);

    // ajax処理
    $.post('_ajax.php', {
      id: id,
      mode: 'update'
    }, function(res) {

      console.log(res);
      
      if (res.state === '1') {
        $('#todo_' + id).find('.todo_title').addClass('done');
      } else {
        $('#todo_' + id).find('.todo_title').removeClass('done');
      }
    });

  });


  // delete
  $('#todos').on('click', '.delete_todo', function() {
    // idを取得
    var id = $(this).parents('li').data('id');
    // console.log(id);

    // ajax処理
    if (confirm('are you sure?')) {
      $.post('_ajax.php', {
        id: id,
        mode: 'delete'
      }, function() {
        $('#todo_' + id).fadeOut(800);
      });
    }

  });
});