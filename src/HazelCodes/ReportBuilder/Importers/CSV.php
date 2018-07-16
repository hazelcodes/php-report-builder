<?php

namespace HazelCodes\ReportBuilder\Importers;

use HazelCodes\ReportBuilder\Importer;
use HazelCodes\ReportBuilder\Collection;
use HazelCodes\ReportBuilder\Metadata;
use HazelCodes\ReportBuilder\Row;

class CSV implements Importer {
  private $filename;
  private $data;

  public function __construct($filename) {
    $this->filename = $filename;
    $this->data = new Collection;
  }

  public function process() : Collection {
    if (file_exists($this->filename) && $this->data->isEmpty()) {
      if (($file = fopen($this->filename, 'r')) !== false) {
        $firstRow = true;
        while (($data = fgetcsv($file, 1000, ',')) !== false) {
          $metadata = new Metadata;

          if ($firstRow) {
            $metadata->header = $firstRow;
            $firstRow = false;
          }

          $row = (new Row($metadata))->append(...$data);
          $this->data->append($row);
        }
      } else {
        throw new \Exception('Error reading ' . $this->filename);
      }
    } else {
      throw new \Exception($this->filename . " not found.");
    }

    return $this->data;
  }
}