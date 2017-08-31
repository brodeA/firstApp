<?php

define('BASE_DIR', '/var/www/mysql');

require_once '/var/www/mysql/operations/from.php';
require_once '/var/www/mysql/output/console.php';
require_once '/var/www/mysql/operations/select.php';
require_once  '/var/www/mysql/operations/join.php';


$option = getOption();

$fromTable = readFromFile($option['from']);
$fromHeader = extractHeader($fromTable);

$joinTable = readFromFile($option['join']);
$joinHeader = extractHeader($joinTable);
$db = joinx($fromTable,$joinTable, $fromHeader, $joinHeader);
$stringFromSelect=$option["select"];
select($db ,explode(',',$option["select"]));
//echo "<pre>";
//print_r($db);die;
