<?php 

namespace Reports;

use \HazelCodes\ReportBuilder\Report;
use \HazelCodes\ReportBuilder\Row;
use \HazelCodes\ReportBuilder\Metadata;
use \HazelCodes\ReportBuilder\Importers\CSV;
use \HazelCodes\ReportBuilder\Exporters\HTML;

class FancyNewReport extends Report {
  public $title;
  public $parameters;

  public function __construct(int $rows = 10, int $columns = 3) {
    $this->title = 'New Report, Fancy?';
    $this->paramaters = new Metadata;

    $this->rows($rows);
    $this->columns($columns);
    
    parent::__construct();
  }

  public function rows(int $rows = null) : int {
    return $this->parameters->rows = $rows ?? $this->parameters->rows;
  }

  public function columns(int $columns = null) : int {
    return $this->parameters->columns = $columns ?? $this->parameters->columns;
  }

  public function process() : Report {
    for ($i=1; $i <= $this->rows(); $i++) { 
      $metadata = new Metadata;
      $metadata->header = $i == 1;

      $columns = [];
      for ($x=1; $x <= $this->columns(); $x++) { 
        $columns[] = "$i : $x";
      }

      $this->append(
        new Row($metadata, ...$columns)
      );
    }

    return $this;
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