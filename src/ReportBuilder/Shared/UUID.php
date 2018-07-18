<?php 

namespace HazelCodes\ReportBuilder\Shared;

trait UUID {
  use Reflection;

  protected $uuid;

  public function generateUUID() : string {
    return md5(uniqid($this->getClassName(), true));
  }

  protected function setUUID() {
    $this->uuid = $this->generateUUID();
  }

  public function getUUID() : string {
    if (!$this->uuid)
      $this->setUUID();
    
    return $this->uuid;
  }
}