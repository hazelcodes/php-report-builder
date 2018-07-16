<?php 

namespace Reports;

use \HazelCodes\ReportBuilder\Report;
use \HazelCodes\ReportBuilder\Importers\CSV;
use \HazelCodes\ReportBuilder\Exporters\HTML;

class FancyNewReport extends Report {
  protected function metadata() : array {
    return [
      'title'       => 'Fancy New Report', 
      'author'      => 'Jason Hazel <jason@hazel.codes>', 
      'version'     => '0.0.1',
      'start_time'  => date('Y-m-d', strtotime('-1 weeks')), 
      'end_time'    => date('Y-m-d')
    ];
  }

  public function importCSV($filename) : Report {
    $importer = new CSV($filename);
    return parent::import($importer);
  }

  public function exportHTML() {
    $exporter = new HTML;
    return parent::export($exporter);
  }
}