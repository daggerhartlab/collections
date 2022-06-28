<?php

use DaggerhartLab\Collections\TypedRegistry;
use PHPUnit\Framework\TestCase;

class TypedRegistryTest extends TestCase {

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
    $registry = new TypedRegistry($type, $items);

    self::assertTrue($registry->has('example'));
    self::assertTrue($registry->has('advanced'));
    self::assertNotTrue($registry->has('another'));
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
    $registry = new TypedRegistry($type, $items);


    self::assertEquals(2, $registry->count());
    self::assertInstanceOf($type, $registry->get('example'));
    self::assertInstanceOf($type, $registry->get('advanced'));
    self::assertEquals('default-value', $registry->get('another', 'default-value'));
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
    $registry = new TypedRegistry($type);
    foreach ($items as $key => $item) {
      $registry->set($key, $item);
    }

    self::assertTrue($registry->has('example'));
    self::assertTrue($registry->has('advanced'));
    self::assertNotTrue($registry->has('another'));
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
    $registry = new TypedRegistry($type, $items);

    self::assertTrue($registry->has('example'));
    self::assertTrue($registry->has('advanced'));
    self::assertEquals(2, $registry->count());

    $registry->remove('example');
    self::assertNotTrue($registry->has('example'));
    self::assertTrue($registry->has('advanced'));
    self::assertEquals(1, $registry->count());

    $registry->remove('advanced');
    self::assertNotTrue($registry->has('example'));
    self::assertNotTrue($registry->has('advanced'));
    self::assertEquals(0, $registry->count());
  }

}
