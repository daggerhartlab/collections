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
    return (is_a($item, $this->getType()) || is_subclass_of($item, $this->getType()));
  }

}
