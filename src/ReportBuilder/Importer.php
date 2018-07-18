<?php 

namespace ReportBuilder;

interface Importer {
  public function process() : Collection;
}