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

  /**
   * @return void
   */
  public function testMap() {
    $type = '\\Big\\Long\\Fqn\\ExampleInterface';
    $collection = new TypedCollection($type, array_map(function($i) {
      return (new \Big\Long\Fqn\ExampleModel())->setId($i);
    }, range(0, 4)));

    $new = $collection->map(function($item) {
      return $item->getId() + 100;
    });

    self::assertTrue($new->in(100));
    self::assertTrue($new->in(101));
    self::assertTrue($new->in(102));
    self::assertTrue($new->in(103));
    self::assertTrue($new->in(104));
  }

  /**
   * @return void
   */
  public function testFilter() {
    $type = 'string';
    $collection = new TypedCollection($type, [
      'one',
      'two',
      null,
      'three',
      0,
      false,
      'four',
    ]);
    $new = $collection->filter();
    self::assertTrue($new->count() === 4);

    $new = $collection->filter(function($item) {
      return substr($item, 0, 1) === 't';
    });
    self::assertTrue($new->count() === 2);
  }

}
