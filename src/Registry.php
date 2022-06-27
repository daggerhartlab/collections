<?php declare(strict_types=1);

namespace DaggerhartLab\Collections;

use ArrayAccess;

/**
 * Collection of keyed values.
 */
class Registry extends Collection implements RegistryInterface, ArrayAccess {

  /**
   * {@inheritdoc}
   */
  public function has(string $key): bool {
    return isset($this->all()[$key]);
  }

  /**
   * {@inheritdoc}
   */
  public function get(string $key, $default = NULL) {
    return $this->all()[$key] ?? $default;
  }

  /**
   * {@inheritdoc}
   */
  public function set(string $key, $value): RegistryInterface {
    $this->items[$key] = $value;
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function remove(string $key): self {
    unset($this->items[$key]);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function offsetExists($key): bool {
    return $this->has($key);
  }

  /**
   * {@inheritdoc}
   */
  public function offsetGet($key) {
    return $this->get($key);
  }

  /**
   * {@inheritdoc}
   */
  public function offsetSet($key, $value): void {
    $this->set($key, $value);
  }

  /**
   * {@inheritdoc}
   */
  public function offsetUnset($key): void {
    $this->remove($key);
  }

}
