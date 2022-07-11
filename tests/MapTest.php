<?php

use DaggerhartLab\Collections\Map;
use PHPUnit\Framework\TestCase;

class MapTest extends TestCase {

  /**
   * @return void
   */
  public function testRemove() {
    $map = new Map([
      'one' => 1,
      'two' => 2,
      'three' => 3,
      'four' => 4,
    ]);

    $map->remove('two');
    self::assertEquals(3, $map->count());
  }

  /**
   * @return void
   */
  public function testSet() {
    $items = [
      'one' => 1,
      'two' => 2,
      'three' => 3,
      'four' => 4,
    ];

    $map = new Map();
    foreach ($items as $key => $value) {
      $map->set($key, $value);
    }

    self::assertEquals(4, $map->count());
    self::assertEquals(3, $map->get('three'));
    self::assertEquals(2, $map->get('two'));
    self::assertEquals(1, $map->get('one'));
  }

  /**
   * @return void
   */
  public function testGet() {
    $map = new Map([
      'one' => 1,
      'two' => 2,
      'three' => 3,
      'four' => 4,
    ]);

    self::assertEquals(4, $map->get('four'));
    self::assertEquals(3, $map->get('three'));
    self::assertEquals(2, $map->get('two'));
    self::assertEquals(1, $map->get('one'));
  }

  /**
   * @return void
   */
  public function testHas() {
    $map = new Map([
      'one' => 1,
      'two' => 2,
      'three' => 3,
      'four' => 4,
    ]);

    self::assertTrue($map->has('one'));
    self::assertTrue($map->has('two'));
    self::assertTrue($map->has('three'));
    self::assertTrue($map->has('four'));
  }

}
