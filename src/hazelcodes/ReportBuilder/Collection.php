<?php 
/**
 * Collection
 */

namespace ReportBuilder;

use ReportBuilder\Shared\UUID;

class Collection extends \ArrayObject {
  use UUID;

  public $metadata;

  /**
   * Creates a new Collection, sets a UUID, sets metadata and sets defaults
   * 
   * @param Metadata $metadata Additional data about the collection
   * @param mixed[] ...$arguments List of collection items 
   */

  public function __construct(Metadata $metadata = null, ...$arguments) {
    $this->setUUID();

    $this->metadata = $metadata ?? $this->metadata ?? new Metadata;

    $this->append(...$arguments);
  }

  /**
   * Clears the collection, but maintains metadata.
   *
   * @return Collection 
   */

  public function reset() : Collection {
    $this->exchangeArray([]);
    return $this;
  }

  /**
   * Check to see if collection has any elements
   * 
   * @return bool true if collection has any elements
   */
  public function isEmpty() : bool {
    return $this->count() == 0;
  }

  /**
   * Magic method for getting collection items by uuid
   * 
   * @param string $attribute UUID to find
   * 
   * @return mixed
   */
  public function __get($attribute) {
    return $this[$attribute] ?? null;
  }

  /**
   * adds new items to the end of the collection list
   * 
   * @param mixed[] ...$items List of items to append 
   * 
   * @return Collection collection object (for method chaining)
   */
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

  /**
   * adds new items to the begining of the collection list 
   * 
   * @param mixed[] ...$items List of items to prepend 
   * 
   * @return Collection collection object (for method chaining)
   */

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