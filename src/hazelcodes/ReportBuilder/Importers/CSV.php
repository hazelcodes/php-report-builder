<?php

namespace ReportBuilder\Importers;

use ReportBuilder\Importer;
use ReportBuilder\Collection;
use ReportBuilder\Metadata;
use ReportBuilder\Row;

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

          $this->data->append(
            new Row($metadata, ...$data)
          );
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