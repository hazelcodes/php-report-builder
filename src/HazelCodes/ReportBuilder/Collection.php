<?php 

namespace HazelCodes\ReportBuilder;

use HazelCodes\ReportBuilder\Shared\UUID;

class Collection extends \ArrayObject {
  use UUID;

  public $metadata;

  public function __construct(Metadata $metadata = null, ...$arguments) {
    $this->setUUID();

    $this->metadata = $metadata ?? $this->metadata ?? new Metadata;

    $this->append(...$arguments);
  }

  public function empty() : bool {
    return $this->count() == 0;
  }

  public function __get($attribute) {
    return $this[$attribute] ?? null;
  }

  public function append(...$items) : Collection {
    foreach ($items as $item) {
      if (method_exists($item, 'getUUID')) {
        $this[$item->getUUID()] = $item;
      } else {
        $metadata = new Metadata([ 'value' => $item ]);
        $this[$metadata->getUUID()] = $metadata;
      }
    }
    return $this;
  }

  public function prepend(...$items) : Collection {
    foreach (array_reverse($items) as $item) {
      if (!method_exists($item, 'getUUID')) 
        $item = new Metadata([ 'value' => $item ]);
      
      $sourceArray = $this->getArrayCopy();
      array_unshift($sourceArray, [ $item->getUUID() => $item ]);
      $this->exchangeArray($sourceArray);
    }

    return $this;
  }
}