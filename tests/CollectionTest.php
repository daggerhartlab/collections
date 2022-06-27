<?php

use DaggerhartLab\Collections\Collection;
use PHPUnit\Framework\TestCase;

class CollectionTest extends TestCase {

  /**
   * @return void
   */
  public function testAdd() {
    $collection = new Collection();
    $collection
      ->add(1)
      ->add(2)
      ->add(3)
      ->add(4);

    self::assertTrue(in_array(1, $collection->all()));
    self::assertTrue(in_array(2, $collection->all()));
    self::assertTrue(in_array(3, $collection->all()));
    self::assertTrue(in_array(4, $collection->all()));
  }

  /**
   * @return void
   */
  public function testCount() {
    $count = mt_rand(10, 100);
    $collection = new Collection(range(1, $count));

    self::assertEquals($count, $collection->count());
  }

  /**
   * @return void
   */
  public function testMap() {
    $collection = new Collection(range(0, 4));
    $new = $collection->map(function($item) {
      return $item + 100;
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
    $collection = new Collection([
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
      return !is_string($item);
    });
    self::assertTrue($new->count() === 3);
  }

  /**
   * @return void
   */
  public function testFirst() {
    $first = mt_rand(1, 100);
    $collection = new Collection(range($first, ($first + 100)));

    self::assertEquals($first, $collection->first());
  }

  /**
   * @return void
   */
  public function testLast() {
    $last = mt_rand(1, 100);
    $collection = new Collection(range(0, $last));

    self::assertEquals($last, $collection->last());
  }

  /**
   * @return void
   */
  public function testSetAll() {
    $collection = new Collection(range(0, 9));
    $collection->setAll(range(10, 20));
    foreach ($collection as $item) {
      self::assertGreaterThanOrEqual(10, $item);
      self::assertLessThanOrEqual(20, $item);
    }
  }

}
