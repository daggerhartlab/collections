<?php

namespace DaggerhartLab\Collections;

/**
 * Collection of type specific data.
 */
interface TypedCollectionInterface extends CollectionInterface {

  /**
   * Set the data type for the collection.
   *
   * @param string $type
   *   Data type.
   *
   * @return $this
   *   Fluent setter.
   */
  public function setType(string $type): TypedCollectionInterface;

  /**
   * Get the collection data type name.
   *
   * @return string
   *   Collection datatype.
   */
  public function getType(): string;

  /**
   * Determine if the given item is the correct type.
   *
   * @param mixed $item
   *   Item to test the type.
   *
   * @return bool
   *   Whether the item is of the appropriate type.
   */
  public function isType($item): bool;

}
