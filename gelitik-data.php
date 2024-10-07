<?php

require_once('../wayfarer.php');
require_once('../sl.php');

$unique_visitors = Sl::one('SELECT COUNT(DISTINCT track_id) AS unique_visitors FROM gelitik');
$total_visits = Sl::one('SELECT track_id, COUNT(1) AS total_visits FROM gelitik WHERE page_state = "start"');
$urls = Sl::get('SELECT page_url, count(1) AS total FROM gelitik WHERE page_state="start" GROUP BY page_url');

?>

<a href="/">home</a>

<br><br>

unique visitor: <?= $unique_visitors->unique_visitors ?> <br>
total visits: <?= $total_visits->total_visits ?> <br><br>

<?php if ($urls): ?>
  <?php foreach ($urls as $url): ?>
    <div><?= $url->page_url ?> = <?= $url->total ?></div>
  <?php endforeach ?>
<?php endif ?>