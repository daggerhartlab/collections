<?php

namespace Big\Long\Fqn;

class ExampleModel implements ExampleInterface {

  /**
   * @var int
   */
  protected int $id;

  /**
   * @var string
   */
  protected string $title;

  /**
   * @var bool
   */
  protected bool $published = FALSE;

  /**
   * @return int
   */
  public function getId(): int {
    return $this->id;
  }

  /**
   * @param int $id
   *
   * @return ExampleModel
   */
  public function setId(int $id): ExampleModel {
    $this->id = $id;
    return $this;
  }

  /**
   * @return string
   */
  public function getTitle(): string {
    return $this->title;
  }

  /**
   * @param string $title
   *
   * @return ExampleModel
   */
  public function setTitle(string $title): ExampleModel {
    $this->title = $title;
    return $this;
  }

  /**
   * @return bool
   */
  public function isPublished(): bool {
    return $this->published;
  }

  /**
   * @param bool $published
   *
   * @return ExampleModel
   */
  public function setPublished(bool $published): ExampleModel {
    $this->published = $published;
    return $this;
  }

}
