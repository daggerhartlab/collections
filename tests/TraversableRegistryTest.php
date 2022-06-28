<?php


use DaggerhartLab\Collections\TraversableRegistry;
use PHPUnit\Framework\TestCase;

class TraversableRegistryTest extends TestCase {

  protected function getRegistry() {
    return new TraversableRegistry([
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
    $registry = $this->getRegistry();

    self::assertTrue($registry->has('a'));
    self::assertTrue($registry->has('b.three'));
    self::assertTrue($registry->has('c.deep.nested.items.very'));

    self::assertNotTrue($registry->has('d'));
    self::assertNotTrue($registry->has('c.deep.nested.missing.not-real'));
  }

  /**
   * @return void
   */
  public function testCount() {
    $registry = $this->getRegistry();

    self::assertEquals(3, $registry->count());
  }

  /**
   * @return void
   */
  public function testGet() {
    $registry = $this->getRegistry();

    self::assertEquals([
      'one' => 1,
      'two' => 2,
    ], $registry->get('a'));
    self::assertEquals(3, $registry->get('b.three'));
    self::assertEquals('deep', $registry->get('c.deep.nested.items.very'));
    self::assertEquals('default-value', $registry->get('c.deep.nested.missing.not-real', 'default-value'));
  }

  /**
   * @return void
   */
  public function testSet() {
    $registry = $this->getRegistry();

    $registry->set('d', [
      'ten' => 10,
      'eleven' => 11,
    ]);

    self::assertEquals(10, $registry->get('d.ten'));
    self::assertEquals(11, $registry->get('d.eleven'));

    $registry->set('c.deep.nested.items.very', [
      'very' => [
        'very' => 'deep',
      ],
    ]);

    self::assertEquals('deep', $registry->get('c.deep.nested.items.very.very.very'));
  }

  /**
   * @return void
   */
  public function testAdd() {
    $registry = $this->getRegistry();
    $registry->add(21, 'c.items');

    $items = $registry->get('c.items');
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
    $registry = $this->getRegistry();
    self::assertEquals(3, $registry->get('b.three', 'default-value'));

    $registry->remove('b.three');
    self::assertEquals('default-value', $registry->get('b.three', 'default-value'));
  }

  /**
   * @return void
   */
  public function testFirst() {
    $registry = $this->getRegistry();
    self::assertEquals([
      'one' => 1,
      'two' => 2,
    ], $registry->first());
  }

  /**
   * @return void
   */
  public function testLast() {
    $registry = $this->getRegistry();
    $registry->set('d', 1);
    $registry->set('e', 1);
    $registry->set('f', 'new-last-item');

    self::assertEquals('new-last-item', $registry->last());
  }


  /**
   * @return void
   */
  public function testAll() {
    $registry = $this->getRegistry();
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
    ], $registry->all());
  }

  /**
   * @return void
   */
  public function testSetAll() {
    $registry = $this->getRegistry();
    $registry->setAll([
      'z' => 26,
      'y' => 25,
      'x' => 24,
      'w' => [
        'nested' => 23,
      ],
    ]);

    self::assertEquals('default', $registry->get('a', 'default'));
    self::assertEquals(null, $registry->get('b'));

    self::assertEquals(26, $registry->get('z'));
    self::assertEquals(25, $registry->get('y'));
    self::assertEquals(23, $registry->get('w.nested'));
  }

}
