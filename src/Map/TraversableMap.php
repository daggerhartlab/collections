<?php declare(strict_types=1);

namespace DaggerhartLab\Collections\Map;

use DaggerhartLab\Collections\Collection;
use DaggerhartLab\Collections\CollectionInterface;
use Dflydev\DotAccessData\Data;

/**
 * Map that expects to be multidimensional array.
 */
class TraversableMap extends Collection implements MapInterface {

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
  public function add($item, $key = null): CollectionInterface {
    if (!$key) {
      throw new \RuntimeException('Key is required. The "add()" method is for appending items to an array nested within the data.');
    }
    $this->items->append($key, $item);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function has($key): bool {
    return $this->items->has($key);
  }

  /**
   * {@inheritdoc}
   */
  public function get($key, $default = NULL) {
    return $this->items->get($key, $default);
  }

  /**
   * {@inheritdoc}
   */
  public function set($key, $value): MapInterface {
    $this->items->set($key, $value);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function remove($key): MapInterface {
    $this->items->remove($key);
    return $this;
  }

}
