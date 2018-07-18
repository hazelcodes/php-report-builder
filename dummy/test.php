<?php
// error_reporting(E_ERROR);

$loader = require __DIR__ . '/vendor/autoload.php';

$report = new Reports\FancyNewReport(1,2);

var_dump($report->process()->exportHTML());
var_dump($report->title);