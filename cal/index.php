<?php

$t = '2018-01';
$thisMonth = new DateTime($t);  // 2020-08-01
$yearMonth = $thisMonth->format('F Y');

// var_dump($yearMonth);
// exit;

$tail = '';
$lastDayOfPrevMonth = 
  new DateTime('last day of ' . $yearMonth . '-1 month');
while($lastDayOfPrevMonth->format('w') < 6) {
  $tail  = sprintf('<td class="gray">%d</td>',
            $lastDayOfPrevMonth->format('d')) . $tail;
  $lastDayOfPrevMonth->sub(new DateInterval('P1D'));
}

$body = '';

$perid = new DatePeriod(
  new DateTime('first day of ' . $yearMonth),
  new DateInterval('P1D'),
  new DateTime('first day of ' . $yearMonth . '+1 month')
);

$today = new DateTime('today'); // 今日の日付値を取得

foreach ($perid as $day) {
  if( $day->format('w') === '0') {
    $body .= '</tr><tr>';
  }
  // 追加する日が今日だったら「today」クラスを追加
  $todayClass = ($day->format('Y-m-d') === $today->format('Y-m-d')) ? 'today' : '';
  $body .= sprintf('<td class="youbi_%d %s">%d</td>',
    $day->format('w'), $todayClass, $day->format('d'));
}

$head = '';

$firstDayOfNextMonth = 
  new DateTime('first day of ' . $yearMonth . ' +1 month');
while ($firstDayOfNextMonth->format('w') > 0) {
  $head .= sprintf('<td class="gray">%d</td>',
              $firstDayOfNextMonth->format('d'));
  $firstDayOfNextMonth->add(new DateInterval('P1D'));
}

$html = '<tr>' . $tail . $body . $head . '</tr>';

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>Calendar</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <table>
    <thead>
      <tr>
        <th><a href="">&laquo;</a></th>
        <th colspan="5"><?php echo $yearMonth; ?></th>
        <th><a href="">&raquo;</a></th>
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
        <?php echo $html; ?>
    </tbody>
    <tfoot>
      <tr>
        <th colspan="7"><a href="">TODAY</a></th>
      </tr>
    </tfoot>

  </table>

</body>
</html>