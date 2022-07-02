<?php declare(strict_types=1);

namespace DaggerhartLab\Collections;

/**
 * Registry is a collection that cares about the item keys.
 */
interface RegistryInterface extends CollectionInterface {

  /**
   * Determine if the value exists in the store by name.
   *
   * @param string $key
   *   The name of the item in the registry.
   *
   * @return bool
   *   Whether the collection has the item.
   */
  public function has(string $key): bool;

  /**
   * Get a specific item in the registry.
   *
   * @param string $key
   *   The name of the item in the registry.
   * @param mixed $default
   *   Default value if item does not exist in registry.
   *
   * @return mixed
   *   Item from the registry if found, otherwise the default value.
   */
  public function get(string $key, $default = null);

  /**
   * Set a specific item in the registry.
   *
   * @param string $key
   *   The name of the item in the registry.
   * @param mixed $value
   *   The new value that should represent the item in the registry.
   *
   * @return $this
   *   Fluent setter.
   */
  public function set(string $key, $value): RegistryInterface;

  /**
   * Remove a value from the store by name by using the unset() function.
   *
   * @param string $key
   *   The name of the item in the registry.
   *
   * @return $this
   *   Fluent.
   */
  public function remove(string $key): RegistryInterface;

}
