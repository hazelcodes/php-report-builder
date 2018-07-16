<?php
error_reporting(E_ERROR);

$loader = require __DIR__ . '/vendor/autoload.php';
$loader->add('HazelCodes\\ReportBuilder', __DIR__ . '/src/');

$report = new Reports\FancyNewReport;
var_dump($report->importCSV('filename.csv')->exportHTML());