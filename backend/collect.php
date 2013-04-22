<?php

mysql_connect('localhost', 'root', 'postile123'); //debug ONLY for real use, set ihomedb.ust.hk
mysql_select_db('feedback');
mysql_query('SET NAMES \'utf8\'');
mysql_query('SET time_zone = \'+8:00\'');

$req_fields = array('error_list', 'user_agent', 'location', 'description', 'mail');

$escaped = array();

foreach ($req_fields as $req) {
    if (!isset($_POST[$req])) { die('Data broken.'); }
    $escaped[$req] = mysql_real_escape_string($_POST[$req]);
}

if (!isset($_POST['client_timestamp']) || !ctype_digit($_POST['client_timestamp'])) {
    die('No timestamp.');
}

$escaped['client_timestamp'] = $_POST['client_timestamp'];

if (isset($_POST['image'])) {
    $escaped['image'] = mysql_real_escape_string($_POST['image']);
} else {
    $escaped['image'] = '';
}

mysql_query('INSERT INTO `feedback` VALUES (NOW(), '.$escaped['client_timestamp'].', \''.$escaped['error_list'].'\', \''.$escaped['user_agent'].'\', \''.$escaped['location'].'\', \''.mysql_real_escape_string($_SERVER['REMOTE_ADDR']).'\', \''.$escaped['description'].'\', \''.$escaped['mail'].'\' , \''.$escaped['image'].'\')');

echo 'Done. You can close the window now.';

?>