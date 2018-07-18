<?php

namespace ReportBuilder;

use ReportBuilder\Collection;

class Row extends Collection {
  /**
   * return header boolean
   * if $newValue provided, sets header value before return
   */

  public function isHeader(bool $newValue = null) : bool {
    $this->metadata->header = $newValue ?? $this->metadata->header;

    return $this->metadata->header == true;
  }
}