<?php

use DaggerhartLab\Collections\ClassMap;
use PHPUnit\Framework\TestCase;

class ClassMapTest extends TestCase {

  /**
   * @return void
   */
  public function testGetReflection() {
    $map = new ClassMap([
      'example' => '\\Big\\Long\\Fqn\\ExampleModel',
      'advanced' => '\\Big\\Long\\Fqn\\ExampleAdvancedModel',
    ]);

    $reflection = $map->getReflection('example');
    self::assertInstanceOf('ReflectionClass', $reflection);
  }

  /**
   * @return void
   */
  public function testCreateInstance() {
    $map = new ClassMap([
      'example' => '\\Big\\Long\\Fqn\\ExampleModel',
      'advanced' => '\\Big\\Long\\Fqn\\ExampleAdvancedModel',
    ]);

    $params = [
      'param1',
      'param2',
      null,
      [
        'is_an_array' => true,
      ],
    ];

    /**
     * @var \Big\Long\Fqn\ExampleModel $example
     * @var \Big\Long\Fqn\ExampleAdvancedModel $advanced
     */
    $example = $map->createInstance('example');
    self::assertInstanceOf('\\Big\\Long\\Fqn\\ExampleModel', $example);

    $params[] = $example;
    $advanced = $map->createInstance('advanced', $params);
    self::assertInstanceOf('\\Big\\Long\\Fqn\\ExampleAdvancedModel', $advanced);
    self::assertEquals($params, $advanced->getParameters());
  }

}
