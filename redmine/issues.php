<?php
require_once ('ActiveResource.php');

class Issue extends ActiveResource {
var $site = 'http://magun.htw-berlin.de/redmine/';
var $request_format = 'xml';
var $extra_params = '&key=613d046e9f53f8346fdd64aacc959b3c06d31b7b';
}

$issue = new Issue ();
$options = array('project_id' => 4, 'limit' => 100);
// find issues
$issues = $issue->find ('all', $options);
echo count($issues);
echo "</br>";
//var_dump($issues);
for ($i=0; $i < count($issues); $i++) {
echo $issues[$i]->subject;
echo $issues[$i]->priority['id'];
echo "</br>";
}