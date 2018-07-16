<?php

namespace HazelCodes\ReportBuilder\Shared;

trait Reflection {
  protected function getClassName() : string {
    $reflection = new \ReflectionClass($this);
    return $reflection->getShortName();
  }
}