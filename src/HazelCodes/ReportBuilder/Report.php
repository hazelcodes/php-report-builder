<?php

namespace HazelCodes\ReportBuilder;

abstract class Report extends Collection {

  abstract protected function metadata() : array;

  public function __construct(Row ...$rows) {
    $this->metadata = new Metadata($this->metadata());
    $this->exchangeArray($rows ?? [new Row]);
    
    parent::__construct();
  }

  public function import(Importer $importer) : Report {
    $this->exchangeArray($importer->process());

    return $this;
  }

  public function export(Exporter $exporter) {
    return $exporter->process($this);
  }

  public function title() {
    // if a title isn't set, we generate one based on the class name
    if (!$this->metadata->title)
      $this->metadata->title = $this->generateTitle();
      
    return $this->metadata->title;
  }

  private function generateTitle() : string {
    $parts = preg_split('/(?=[A-Z])/', $this->getClassName(), -1, PREG_SPLIT_NO_EMPTY);
    return implode(' ', $parts);
  }

}