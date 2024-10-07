<?php

require_once('../wayfarer.php');
require_once('../sl.php');

if (isset($_POST['url']) && isset($_POST['track_id'])) {
  Sl::save('gelitik', [
    'track_id' => $_POST['track_id'],
    'page_url' => $_POST['url'],
    'page_state' => $_POST['state'],
    'created_at' => date('Y-m-d H:i:s'),
  ]);
}
