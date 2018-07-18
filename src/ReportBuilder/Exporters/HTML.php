<?php 

namespace HazelCodes\ReportBuilder\Exporters;

use HazelCodes\ReportBuilder\Report;
use HazelCodes\ReportBuilder\Exporter;

class HTML implements Exporter {
  private $data = '';

  // clearly not the best way to generate HTML, but works for now
  public function process(Report $report) {
    if (empty($this->data)) {
      $this->data = "<table>";
        foreach ($report as $row) {
          $this->data .= "<tr>";

          $template = $row->isHeader() ? "<th>%s</th>" : "<td>%s</td>";

          foreach ($row as $column) {
            $this->data .= sprintf($template, $column->value);
          }
          $this->data .= "</tr>";
        }
      $this->data .= "</table>";
    }

    return $this->data;
  }
}