<?php

mysql_connect('localhost', 'root', 'postile123'); //debug ONLY for real use, set ihomedb.ust.hk
mysql_select_db('feedback');
mysql_query('SET NAMES \'utf8\'');
mysql_query('SET time_zone = \'+8:00\'');

function parseJson($i) {
    $l = json_decode(stripslashes($i), true);
    if (!count($l)) { return ''; }
    $r = array();
    foreach($l as $sg) {
        $r[]= '<b>'.$sg['filename'].':'.$sg['lineno'].'</b> - '.$sg['message'];
    }
    return implode('<br />', $r);
}

$result = mysql_query('SELECT * FROM feedback WHERE `resolved` = 0 ORDER BY `server_timestamp` DESC');
?>
Resolved items will NOT be shown. To see client TS and IP, go PhpMyAdmin. For screenshots, you can right click to view large.
<table cellspacing="0" border="1">
<?php
while($line = mysql_fetch_assoc($result)) {
    echo '<tr>';
    echo '<td>'.$line['server_timestamp'].'</td>';
    echo '<td>'.parseJson($line['error_list']).'</td>';
    echo '<td>'.$line['user_agent'].'</td>';
    echo '<td>'.$line['location'].'</td>';
    echo '<td>'.$line['description'].'</td>';
    echo '<td>'.$line['mail'].'</td>';
    echo '<td>'.(strlen($line['image']) ? '<img src="'.$line['image'].'" width="200" />' : '').'</td>';
    echo '</tr>';
}
?>
</table>