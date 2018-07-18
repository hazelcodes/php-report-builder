<?php

namespace ReportBuilder\Shared;

trait Reflection {
  protected function getClassName() : string {
    return (new \ReflectionClass($this))->getShortName();
  }
}