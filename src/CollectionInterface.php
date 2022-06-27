<?php declare(strict_types=1);

namespace DaggerhartLab\Collections;

/**
 * Interface for all collections.
 */
interface CollectionInterface {

  /**
   * Return all items in this collection.
   *
   * @return array
   *   All items in the collection.
   */
  public function all(): array;

  /**
   * Set all items in the collection.
   *
   * @param array $items
   *   Items to set as collection's items.
   *
   * @return $this
   *   Fluent setter.
   */
  public function setAll(array $items = []): self;

  /**
   * Determine if an item is in the collection.
   *
   * @return bool
   *   Whether the item is in the collection.
   */
  public function in($item): bool;

  /**
   * Add an item to the collection.
   *
   * @param mixed $item
   *   Collection item.
   *
   * @return $this
   *   Fluent setter.
   */
  public function add($item): self;

  /**
   * Map each item in the collection to a callback.
   *
   * @param callable $callable
   *   Callback for the mapping.
   *
   * @return \DaggerhartLab\Collections\CollectionInterface
   *   Collection w/ items mapped.
   */
  public function map(callable $callable): CollectionInterface;

  /**
   * Filter the collection to a callback.
   *
   * @param callable|null $callable
   *   Callback for the filtering.
   * @param int $mode
   *   Filtering mode.
   *
   * @return \DaggerhartLab\Collections\CollectionInterface
   *   Collection w/ remaining items after filtering.
   */
  public function filter(callable $callable = null, int $mode = 0): CollectionInterface;

}
