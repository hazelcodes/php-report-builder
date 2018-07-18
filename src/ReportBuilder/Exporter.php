<?php 

namespace ReportBuilder;

interface Exporter {
  public function process(Report $report);
}