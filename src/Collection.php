<?php declare(strict_types=1);

namespace DaggerhartLab\Collections;

use ArrayIterator;
use Countable;
use IteratorAggregate;

/**
 * Base collection class.
 */
class Collection implements CollectionInterface, IteratorAggregate, Countable {

  /**
   * Items in the collection.
   *
   * @var array
   */
  protected $items = [];

  /**
   * Collection.
   *
   * @param array $items
   *   Initial collection items.
   */
  public function __construct(array $items = []) {
    $this->setAll($items);
  }

  /**
   * {@inheritdoc}
   */
  public function all(): array {
    return $this->items;
  }

  /**
   * {@inheritdoc}
   */
  public function setAll(array $items = []): CollectionInterface {
    $this->items = $items;
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function in($item): bool {
    return in_array($item, $this->all());
  }

  /**
   * {@inheritdoc}
   */
  public function add($item): CollectionInterface {
    $this->items[] = $item;
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getIterator(): ArrayIterator {
    return new ArrayIterator($this->all());
  }

  /**
   * {@inheritdoc}
   */
  public function count(): int {
    return iterator_count($this->getIterator());
  }

  /**
   * {@inheritdoc}
   */
  public function map(callable $callable): CollectionInterface {
    return new Collection(array_map($callable, $this->all()));
  }

  /**
   * {@inheritdoc}
   */
  public function filter(callable $callable = null, int $mode = 0): CollectionInterface {
    return new Collection(array_filter($this->all(), $callable, $mode));
  }

}
