<?php

$today = date('Y-m-d');
$day_of_week = date('w');
$week = [
  '日', //0
  '月', //1
  '火', //2
  '水', //3
  '木', //4
  '金', //5
  '土', //6
];

$two_days_later = date("Y/m/d",strtotime("+2 day", strtotime($today)));
$two_days_later_week = date("w",strtotime("+2 day", strtotime($today)));
$three_days_later = date("Y/m/d",strtotime("+3 day", strtotime($today)));
$three_days_later_week = date("w",strtotime("+3 day", strtotime($today)));
$four_days_later = date("Y/m/d",strtotime("+4 day", strtotime($today)));
$four_days_later_week = date("w",strtotime("+4 day", strtotime($today)));
$five_days_later = date("Y/m/d",strtotime("+5 day", strtotime($today)));
$five_days_later_week = date("w",strtotime("+5 day", strtotime($today)));
$six_days_later = date("Y/m/d",strtotime("+6 day", strtotime($today)));
$six_days_later_week = date("w",strtotime("+6 day", strtotime($today)));
$seven_days_later = date("Y/m/d",strtotime("+7 day", strtotime($today)));
$seven_days_later_week = date("w",strtotime("+7 day", strtotime($today)));
$eight_days_later = date("Y/m/d",strtotime("+8 day", strtotime($today)));
$eight_days_later_week = date("w",strtotime("+8 day", strtotime($today)));

return [
  'delivery_date' => [
    '指定なし' => '指定なし',
    $two_days_later => date('Y年m月d日', strtotime($two_days_later)) . ' （' . $week[$two_days_later_week] . '）',
    $three_days_later => date('Y年m月d日', strtotime($three_days_later)) . ' （' . $week[$three_days_later_week] . '）',
    $four_days_later => date('Y年m月d日', strtotime($four_days_later)) . ' （' . $week[$four_days_later_week] . '）',
    $five_days_later => date('Y年m月d日', strtotime($five_days_later)) . ' （' . $week[$five_days_later_week] . '）',
    $six_days_later => date('Y年m月d日', strtotime($six_days_later)) . ' （' . $week[$six_days_later_week] . '）',
    $seven_days_later => date('Y年m月d日', strtotime($seven_days_later)) . ' （' . $week[$seven_days_later_week] . '）',
    $eight_days_later => date('Y年m月d日', strtotime($eight_days_later)) . ' （' . $week[$eight_days_later_week] . '）',
  ],

  'delivery_time' => [
    '指定なし',
    '14時から16時',
    '16時から18時',
    '18時から20時',
    '19時から21時',
  ],

  'week' => [
    '日', //0
    '月', //1
    '火', //2
    '水', //3
    '木', //4
    '金', //5
    '土', //6
  ],
];
