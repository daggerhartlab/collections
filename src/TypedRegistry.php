<?php declare(strict_types=1);

namespace DaggerhartLab\Collections;

/**
 * Typed collection with keyed values.
 */
class TypedRegistry extends TypedCollection implements RegistryInterface {

  /**
   * {@inheritdoc}
   */
  public function setAll(array $items = []): CollectionInterface {
    foreach ($items as $key => $item) {
      $this->set($key, $item);
    }
    return $this;
  }

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
  public function set($key, $value): RegistryInterface {
    // Only allow typed data into the collection.
    if ($this->isType($value)) {
      $this->items[$key] = $value;
    }

    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function remove($key): RegistryInterface {
    unset($this->items[$key]);
    return $this;
  }

}
