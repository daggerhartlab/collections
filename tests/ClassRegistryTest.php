<?php

use DaggerhartLab\Collections\ClassRegistry;
use PHPUnit\Framework\TestCase;

class ClassRegistryTest extends TestCase {

  /**
   * @return void
   */
  public function testGetReflection() {
    $registry = new ClassRegistry([
      'example' => '\\Big\\Long\\Fqn\\ExampleModel',
      'advanced' => '\\Big\\Long\\Fqn\\ExampleAdvancedModel',
    ]);

    $reflection = $registry->getReflection('example');
    self::assertInstanceOf('ReflectionClass', $reflection);
  }

  /**
   * @return void
   */
  public function testCreateInstance() {
    $registry = new ClassRegistry([
      'example' => '\\Big\\Long\\Fqn\\ExampleModel',
      'advanced' => '\\Big\\Long\\Fqn\\ExampleAdvancedModel',
    ]);

    /**
     * @var \Big\Long\Fqn\ExampleModel $example
     * @var \Big\Long\Fqn\ExampleAdvancedModel $advanced
     */
    $example = $registry->createInstance('example');
    self::assertInstanceOf('\\Big\\Long\\Fqn\\ExampleModel', $example);
    $advanced = $registry->createInstance('advanced', ['param1', 'param2', null, 'param3' => ['is_an_array' => true]]);
    self::assertInstanceOf('\\Big\\Long\\Fqn\\ExampleAdvancedModel', $advanced);
  }

}
