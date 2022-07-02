<?php declare(strict_types=1);

namespace DaggerhartLab\Collections;

use Dflydev\DotAccessData\Data;

/**
 * Registry that expects to be multidimensional array.
 */
class TraversableRegistry extends Collection implements RegistryInterface {

  /**
   * Instance of traversable data.
   *
   * @var \Dflydev\DotAccessData\Data
   */
  protected $items;

  /**
   * {@inheritdoc}
   */
  public function all(): array {
    return $this->items->export();
  }

  /**
   * {@inheritdoc}
   */
  public function setAll(array $items = []): CollectionInterface {
    $this->items = new Data($items);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function add($item, string $key = null): CollectionInterface {
    if (!$key) {
      throw new \RuntimeException('Key is required. The "add()" method is for appending items to an array nested within the data.');
    }
    $this->items->append($key, $item);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function has(string $key): bool {
    return $this->items->has($key);
  }

  /**
   * {@inheritdoc}
   */
  public function get(string $key, $default = NULL) {
    return $this->items->get($key, $default);
  }

  /**
   * {@inheritdoc}
   */
  public function set(string $key, $value): self {
    $this->items->set($key, $value);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function remove(string $key): self {
    $this->items->remove($key);
    return $this;
  }

}
