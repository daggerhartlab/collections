<?php

use DaggerhartLab\Collections\TypedCollection;
use PHPUnit\Framework\TestCase;

class TypedCollectionTest extends TestCase {

  /**
   * @return void
   */
  public function testSetAll() {
    $type = '\\Big\\Long\\Fqn\\ExampleInterface';
    $items = [
      new \Big\Long\Fqn\ExampleModel(),
      new \Big\Long\Fqn\ExampleAdvancedModel(),
      new DateTime(),
    ];
    $collection = new TypedCollection($type);
    $collection->setAll($items);

    // We don't expect the DateTime() to get registered.
    self::assertEquals(2, $collection->count());
    foreach ($collection as $item) {
      self::assertInstanceOf($type, $item);
    }
  }

  /**
   * @return void
   */
  public function testGetType() {
    $type = '\\Big\\Long\\Fqn\\ExampleInterface';
    $collection = new TypedCollection($type);
    self::assertEquals($type, $collection->getType());
  }

  /**
   * @return void
   */
  public function testIsType() {
    $type = '\\Big\\Long\\Fqn\\ExampleInterface';
    $items = [
      new \Big\Long\Fqn\ExampleModel(),
      new \Big\Long\Fqn\ExampleAdvancedModel(),
      new DateTime(),
    ];
    $collection = new TypedCollection($type);

    self::assertTrue($collection->isType($items[0]));
    self::assertTrue($collection->isType($items[1]));
    self::assertNotTrue($collection->isType($items[2]));
  }

  /**
   * @return void
   */
  public function testAdd() {
    $type = '\\Big\\Long\\Fqn\\ExampleInterface';
    $items = [
      new \Big\Long\Fqn\ExampleModel(),
      new \Big\Long\Fqn\ExampleAdvancedModel(),
      new DateTime(),
    ];
    $collection = new TypedCollection($type);

    foreach ($items as $item) {
      $collection->add($item);
    }

    // We don't expect the DateTime() to get registered.
    self::assertEquals(2, $collection->count());
    foreach ($collection as $item) {
      self::assertInstanceOf($type, $item);
    }
  }

  /**
   * @return void
   */
  public function testSetType() {
    $type = '\\Big\\Long\\Fqn\\ExampleInterface';
    $collection = new TypedCollection('\\DateTime');
    $collection->setType($type);
    self::assertEquals($type, $collection->getType());
  }

}
