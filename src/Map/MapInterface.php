<?php declare(strict_types=1);

namespace DaggerhartLab\Collections\Map;

use DaggerhartLab\Collections\CollectionInterface;

/**
 * Map is a collection that cares about the item keys.
 */
interface MapInterface extends CollectionInterface {

  /**
   * Determine if the value exists in the store by name.
   *
   * @param string|int $key
   *   The name of the item in the map.
   *
   * @return bool
   *   Whether the collection has the item.
   */
  public function has($key): bool;

  /**
   * Get a specific item in the map.
   *
   * @param string|int $key
   *   The name of the item in the map.
   * @param mixed $default
   *   Default value if item does not exist in map.
   *
   * @return mixed
   *   Item from the map if found, otherwise the default value.
   */
  public function get($key, $default = null);

  /**
   * Set a specific item in the map.
   *
   * @param string|int $key
   *   The name of the item in the map.
   * @param mixed $value
   *   The new value that should represent the item in the map.
   *
   * @return $this
   *   Fluent setter.
   */
  public function set($key, $value): MapInterface;

  /**
   * Remove a value from the store by name by using the unset() function.
   *
   * @param string|int $key
   *   The name of the item in the map.
   *
   * @return $this
   *   Fluent.
   */
  public function remove($key): MapInterface;

}
