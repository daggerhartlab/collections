<?php

use DaggerhartLab\Collections\Registry;
use PHPUnit\Framework\TestCase;

class RegistryTest extends TestCase {

  /**
   * @return void
   */
  public function testRemove() {
    $registry = new Registry([
      'one' => 1,
      'two' => 2,
      'three' => 3,
      'four' => 4,
    ]);

    $registry->remove('two');
    self::assertEquals(3, $registry->count());
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

    $registry = new Registry();
    foreach ($items as $key => $value) {
      $registry->set($key, $value);
    }

    self::assertEquals(4, $registry->count());
    self::assertEquals(3, $registry->get('three'));
    self::assertEquals(2, $registry->get('two'));
    self::assertEquals(1, $registry->get('one'));
  }

  /**
   * @return void
   */
  public function testGet() {
    $registry = new Registry([
      'one' => 1,
      'two' => 2,
      'three' => 3,
      'four' => 4,
    ]);

    self::assertEquals(4, $registry->get('four'));
    self::assertEquals(3, $registry->get('three'));
    self::assertEquals(2, $registry->get('two'));
    self::assertEquals(1, $registry->get('one'));
  }

  /**
   * @return void
   */
  public function testHas() {
    $registry = new Registry([
      'one' => 1,
      'two' => 2,
      'three' => 3,
      'four' => 4,
    ]);

    self::assertTrue($registry->has('one'));
    self::assertTrue($registry->has('two'));
    self::assertTrue($registry->has('three'));
    self::assertTrue($registry->has('four'));
  }

}
