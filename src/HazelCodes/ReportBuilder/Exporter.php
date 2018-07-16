<?php 

namespace HazelCodes\ReportBuilder;

interface Exporter {
  public function process(Report $report);
}