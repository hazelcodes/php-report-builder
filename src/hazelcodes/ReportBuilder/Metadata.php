<?php 

namespace ReportBuilder;

use HazelCodes\ReportBuilder\Shared\UUID;

class Metadata extends \ArrayObject {
  use UUID;

  public function __construct(...$arguments) {
    $this->setUUID();

    parent::__construct(...$arguments);
  }

  public function __get($attribute) {
    return $this[$attribute] ?? null;
  }

  public function __set($attribute, $value) : Metadata {
    $this[$attribute] = $value;

    return $this;
  }

  public function __toString() : string {
    return $this->value;
  }
}