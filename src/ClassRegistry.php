<?php declare(strict_types=1);

namespace DaggerhartLab\Collections;

use ReflectionClass;

/**
 * Collection of keyed class names.
 */
class ClassRegistry extends Registry implements ClassRegistryInterface {

  /**
   * {@inheritdoc}
   */
  public function getReflection(string $key): ReflectionClass {
    return new ReflectionClass($this->get($key));
  }

  /**
   * {@inheritdoc}
   */
  public function createInstance(string $key, array $parameters = []) {
    $reflection = $this->getReflection($key);
    if ( null === $reflection->getConstructor() ) {
      return $reflection->newInstanceWithoutConstructor();
    }

    return $reflection->newInstanceArgs($parameters);
  }

}
