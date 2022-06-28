<?php

namespace Big\Long\Fqn;

class ExampleAdvancedModel extends ExampleModel {

  /**
   * @var array
   */
  protected array $extra = [
    'one' => 1,
    'two' => 2,
    'three' => 3,
  ];

  /**
   * @var array
   */
  protected array $parameters;

  /**
   * Test constructor.
   */
  public function __construct() {
    $this->parameters = func_get_args();
  }

  /**
   * @return array
   */
  public function getExtra(): array {
    return $this->extra;
  }

  /**
   * @param array $extra
   *
   * @return ExampleAdvancedModel
   */
  public function setExtra(array $extra): ExampleAdvancedModel {
    $this->extra = $extra;
    return $this;
  }

  /**
   * @return array
   */
  public function getParameters(): array {
    return $this->parameters;
  }

  /**
   * @param array $parameters
   *
   * @return ExampleAdvancedModel
   */
  public function setParameters(array $parameters): ExampleAdvancedModel {
    $this->parameters = $parameters;
    return $this;
  }

}
