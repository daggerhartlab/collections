<?php declare(strict_types=1);

namespace DaggerhartLab\Collections;

/**
 * Collection of type specific data.
 */
class TypedCollection extends Collection implements TypedCollectionInterface {

  /**
   * Collection data type.
   *
   * @var string
   */
  protected string $type;

  /**
   * Construct the typed collection.
   *
   * @param string|NULL $type
   *   Data type name. If a class, fully namespaced.
   * @param array $items
   *   Initial collection items.
   */
  public function __construct(string $type, array $items = []) {
    $this->setType($type);
    parent::__construct($items);
  }

  /**
   * {@inheritdoc}
   */
  public function setAll(array $items = []): CollectionInterface {
    foreach ($items as $item) {
      $this->add($item);
    }

    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function add($item): CollectionInterface {
    // Only allow typed data into the collection.
    if ($this->isType($item)) {
      parent::add($item);
    }

    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function setType(string $type): TypedCollectionInterface {
    $this->type = $type;
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getType(): string {
    return $this->type;
  }

  /**
   * {@inheritdoc}
   */
  public function isType($item): bool {
    if (is_object($item)) {
      return (is_a($item, $this->getType()) || is_subclass_of($item, $this->getType()));
    }

    switch (strtolower($this->getType())) {
      case 'string':
        return is_string($item);

      case 'bool':
      case 'boolean':
        return is_bool($item);

      case 'int':
      case 'integer':
        return is_int($item);

      case 'float':
        return is_float($item);

      case 'numeric':
        return is_numeric($item);

      case 'callable':
      case 'callback':
        return is_callable($item);

      case 'array':
        return is_array($item);

      default:
        return false;

    }
  }

  /**
   * {@inheritdoc}
   */
  public function filter(callable $callable = null, int $mode = 0): CollectionInterface {
    // Maintain the collection type when filtering.
    return new static($this->getType(), call_user_func_array('array_filter', array_filter([
      $this->all(),
      $callable,
      $mode
    ])));
  }

}
