<?php

require 'Calendar.php';

function h($s) {
  return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}

$cal = new \MyApp\Calendar();

?>
<!DOCTYPE html>
<html lang="ja">
<head>
<link rel="stylesheet" href="normalize.css">
<link rel="stylesheet" href="styles.css">
</head>
<body>
  <table>
    <thead>
      <tr>
        <th><a href="/cal.yo/?t=<?php echo h($cal->prev); ?>">&laquo;</a></th>
        <th colspan="5"><?php echo h($cal->yearMonth); ?></th>
        <th><a href="/cal.yo/?t=<?php echo h($cal->next); ?>">&raquo;</a></th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Sum</td>
        <td>Mon</td>
        <td>Tue</td>
        <td>Wed</td>
        <td>Thu</td>
        <td>Fri</td>
        <td>Sat</td>
      </tr>
      <?php $cal->show(); ?>
    </tbody>
    <tfoot>
      <th colspan="7"><a href="/cal.yo/">Today</a></th>
    </tfoot>
  </table>
</body>
</html>