<?php 

namespace HazelCodes\ReportBuilder;

interface Importer {
  public function process() : Collection;
}