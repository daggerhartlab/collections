<?php

use DaggerhartLab\Collections\Map\TypedMap;
use PHPUnit\Framework\TestCase;

class TypedMapTest extends TestCase {

  /**
   * @return void
   */
  public function testHas() {
    $type = '\\Big\\Long\\Fqn\\ExampleInterface';
    $items = [
      'example' => new \Big\Long\Fqn\ExampleModel(),
      'advanced' => new \Big\Long\Fqn\ExampleAdvancedModel(),
      'another' => new DateTime(),
    ];
    $map = new TypedMap($type, $items);

    self::assertTrue($map->has('example'));
    self::assertTrue($map->has('advanced'));
    self::assertNotTrue($map->has('another'));
  }

  /**
   * @return void
   */
  public function testGet() {
    $type = '\\Big\\Long\\Fqn\\ExampleInterface';
    $items = [
      'example' => new \Big\Long\Fqn\ExampleModel(),
      'advanced' => new \Big\Long\Fqn\ExampleAdvancedModel(),
      'another' => new DateTime(),
    ];
    $map = new TypedMap($type, $items);


    self::assertEquals(2, $map->count());
    self::assertInstanceOf($type, $map->get('example'));
    self::assertInstanceOf($type, $map->get('advanced'));
    self::assertEquals('default-value', $map->get('another', 'default-value'));
  }

  /**
   * @return void
   */
  public function testSet() {
    $type = '\\Big\\Long\\Fqn\\ExampleInterface';
    $items = [
      'example' => new \Big\Long\Fqn\ExampleModel(),
      'advanced' => new \Big\Long\Fqn\ExampleAdvancedModel(),
      'another' => new DateTime(),
    ];
    $map = new TypedMap($type);
    foreach ($items as $key => $item) {
      $map->set($key, $item);
    }

    self::assertTrue($map->has('example'));
    self::assertTrue($map->has('advanced'));
    self::assertNotTrue($map->has('another'));
  }

  /**
   * @return void
   */
  public function testRemove() {
    $type = '\\Big\\Long\\Fqn\\ExampleInterface';
    $items = [
      'example' => new \Big\Long\Fqn\ExampleModel(),
      'advanced' => new \Big\Long\Fqn\ExampleAdvancedModel(),
      'another' => new DateTime(),
    ];
    $map = new TypedMap($type, $items);

    self::assertTrue($map->has('example'));
    self::assertTrue($map->has('advanced'));
    self::assertEquals(2, $map->count());

    $map->remove('example');
    self::assertNotTrue($map->has('example'));
    self::assertTrue($map->has('advanced'));
    self::assertEquals(1, $map->count());

    $map->remove('advanced');
    self::assertNotTrue($map->has('example'));
    self::assertNotTrue($map->has('advanced'));
    self::assertEquals(0, $map->count());
  }

}
