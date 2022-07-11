<?php


use DaggerhartLab\Collections\TraversableMap;
use PHPUnit\Framework\TestCase;

class TraversableMapTest extends TestCase {

  protected function getMap() {
    return new TraversableMap([
      'a' => [
        'one' => 1,
        'two' => 2,
      ],
      'b' => [
        'three' => 3,
        'four' => 4,
      ],
      'c' => [
        'deep' => [
          'nested' => [
            'items' => [
              'very' => 'deep',
            ],
          ],
          'address' => [
            'street' => '123 fake st',
            'city' => 'fakesville',
            'state' => 'NC',
            'zip' => 12345,
          ],
        ],
        'items' => range(11, 20),
      ],
    ]);
  }

  /**
   * @return void
   */
  public function testHas() {
    $map = $this->getMap();

    self::assertTrue($map->has('a'));
    self::assertTrue($map->has('b.three'));
    self::assertTrue($map->has('c.deep.nested.items.very'));

    self::assertNotTrue($map->has('d'));
    self::assertNotTrue($map->has('c.deep.nested.missing.not-real'));
  }

  /**
   * @return void
   */
  public function testCount() {
    $map = $this->getMap();

    self::assertEquals(3, $map->count());
  }

  /**
   * @return void
   */
  public function testGet() {
    $map = $this->getMap();

    self::assertEquals([
      'one' => 1,
      'two' => 2,
    ], $map->get('a'));
    self::assertEquals(3, $map->get('b.three'));
    self::assertEquals('deep', $map->get('c.deep.nested.items.very'));
    self::assertEquals('default-value', $map->get('c.deep.nested.missing.not-real', 'default-value'));
  }

  /**
   * @return void
   */
  public function testSet() {
    $map = $this->getMap();

    $map->set('d', [
      'ten' => 10,
      'eleven' => 11,
    ]);

    self::assertEquals(10, $map->get('d.ten'));
    self::assertEquals(11, $map->get('d.eleven'));

    $map->set('c.deep.nested.items.very', [
      'very' => [
        'very' => 'deep',
      ],
    ]);

    self::assertEquals('deep', $map->get('c.deep.nested.items.very.very.very'));
  }

  /**
   * @return void
   */
  public function testAdd() {
    $map = $this->getMap();
    $map->add(21, 'c.items');

    $items = $map->get('c.items');
    self::assertEquals(11, count($items));

    $last = end($items);
    $first = reset($items);
    self::assertEquals(11, $first);
    self::assertEquals(21, $last);
  }

  /**
   * @return void
   */
  public function testRemove() {
    $map = $this->getMap();
    self::assertEquals(3, $map->get('b.three', 'default-value'));

    $map->remove('b.three');
    self::assertEquals('default-value', $map->get('b.three', 'default-value'));
  }

  /**
   * @return void
   */
  public function testFirst() {
    $map = $this->getMap();
    self::assertEquals([
      'one' => 1,
      'two' => 2,
    ], $map->first());
  }

  /**
   * @return void
   */
  public function testLast() {
    $map = $this->getMap();
    $map->set('d', 1);
    $map->set('e', 1);
    $map->set('f', 'new-last-item');

    self::assertEquals('new-last-item', $map->last());
  }


  /**
   * @return void
   */
  public function testAll() {
    $map = $this->getMap();
    self::assertEquals([
      'a' => [
        'one' => 1,
        'two' => 2,
      ],
      'b' => [
        'three' => 3,
        'four' => 4,
      ],
      'c' => [
        'deep' => [
          'nested' => [
            'items' => [
              'very' => 'deep',
            ],
          ],
          'address' => [
            'street' => '123 fake st',
            'city' => 'fakesville',
            'state' => 'NC',
            'zip' => 12345,
          ],
        ],
        'items' => range(11, 20),
      ],
    ], $map->all());
  }

  /**
   * @return void
   */
  public function testSetAll() {
    $map = $this->getMap();
    $map->setAll([
      'z' => 26,
      'y' => 25,
      'x' => 24,
      'w' => [
        'nested' => 23,
      ],
    ]);

    self::assertEquals('default', $map->get('a', 'default'));
    self::assertEquals(null, $map->get('b'));

    self::assertEquals(26, $map->get('z'));
    self::assertEquals(25, $map->get('y'));
    self::assertEquals(23, $map->get('w.nested'));
  }

}
