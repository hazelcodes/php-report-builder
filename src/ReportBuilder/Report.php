<?php

namespace ReportBuilder;

abstract class Report extends Collection {
  abstract protected function process() : Report;

  public function __construct(Row ...$rows) {
    $this->exchangeArray($rows);
    
    parent::__construct();
  }

  public function import(Importer $importer) : Report {
    $this->exchangeArray($importer->process());

    return $this;
  }

  public function export(Exporter $exporter) {
    return $exporter->process($this);
  }
}