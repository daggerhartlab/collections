<?php declare(strict_types=1);

namespace DaggerhartLab\Collections;

use ArrayAccess;

/**
 * A map is a Dictionary of data. A collection of keyed values.
 */
class Map extends Collection implements MapInterface, ArrayAccess {

  /**
   * {@inheritdoc}
   */
  public function has($key): bool {
    return isset($this->all()[$key]);
  }

  /**
   * {@inheritdoc}
   */
  public function get($key, $default = NULL) {
    return $this->all()[$key] ?? $default;
  }

  /**
   * {@inheritdoc}
   */
  public function set($key, $value): MapInterface {
    $this->items[$key] = $value;
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function remove($key): MapInterface {
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
